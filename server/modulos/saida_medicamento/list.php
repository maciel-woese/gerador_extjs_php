<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'saida_medicamento';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM saida_medicamento
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			$buscar->setBusca(array('filial_id', "{$tabela}.filial_id"), $user->filial_id);
			$filtro = $buscar->getSql();
			
			$pdo = $connection->prepare("
				SELECT id as id, data_cadastro as descricao 
				FROM saida_medicamento {$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$linhas = $pdo->fetchAll(PDO::FETCH_OBJ);
			echo json_encode( array('dados'=>$linhas) );
		}
		else{
			$pag = new Paginar($_POST);
			
			$page 	= $pag->getPage();
			$start	= $pag->getStart();
			$limit	= $pag->getLimit();
			$sort 	= $pag->getSort();
			$order 	= $pag->getOrder();
			
			$result = array();
			$buscar->setBusca(array('filial_id', "{$tabela}.filial_id"), $user->filial_id);
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('data_cadastro', 'saida_medicamento.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date']))), 'like');
				$buscar->setBusca(array('usuario_id', 'saida_medicamento.usuario_id'), $_POST['usuario_id']);
				$buscar->setBusca(array('paciente_id', 'saida_medicamento.paciente_id'), $_POST['paciente_id']);
			}
			
			if (isset($_POST['sort']))
			{
				$sortJson = json_decode( $_POST['sort'] );
				$sort = trim(rtrim(addslashes($sortJson[0]->property )));
				$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
			}
			
			$filtro = $buscar->getSql();
			
			$pdo = $connection->prepare("
				SELECT count(*) as total 
				FROM saida_medicamento INNER JOIN usuarios ON
					(saida_medicamento.usuario_id=usuarios.id) INNER JOIN pacientes ON
					(saida_medicamento.paciente_id=pacientes.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT saida_medicamento.*, 
					DATE_FORMAT(saida_medicamento.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(saida_medicamento.data_cadastro, '%Y-%m-%d') as data_cadastro_date, usuarios.nome, pacientes.paciente 
				FROM saida_medicamento INNER JOIN usuarios ON
					(saida_medicamento.usuario_id=usuarios.id) INNER JOIN pacientes ON
					(saida_medicamento.paciente_id=pacientes.id) 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			
			$result["total"] = $countRow;
			$result["dados"] = $query;
			
			echo json_encode($result);
		}
	} 
	catch (PDOException $e) {
		echo json_encode(array('dados'=>array(),'total'=>0, 'erro'=>$e->getMessage()));
	}	
}
?>