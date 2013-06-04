<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'entrada_medicamento';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM entrada_medicamento
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT id as id, nota as descricao 
				FROM entrada_medicamento
			");
			$pdo->execute();
			
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
				$buscar->setBusca(array('data_cadastro', 'entrada_medicamento.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date']))), 'like');
				$buscar->setBusca(array('usuario_id', 'entrada_medicamento.usuario_id'), $_POST['usuario_id']);
				$buscar->setBusca(array('fornecedor_id', 'entrada_medicamento.fornecedor_id'), $_POST['fornecedor_id']);
				$buscar->setBusca(array('nota', 'entrada_medicamento.nota'), $_POST['nota'], 'like');
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
				FROM entrada_medicamento INNER JOIN usuarios ON
					(entrada_medicamento.usuario_id=usuarios.id) INNER JOIN fornecedor ON
					(entrada_medicamento.fornecedor_id=fornecedor.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT entrada_medicamento.*, 
					DATE_FORMAT(entrada_medicamento.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(entrada_medicamento.data_cadastro, '%Y-%m-%d') as data_cadastro_date, usuarios.nome, fornecedor.fornecedor 
				FROM entrada_medicamento INNER JOIN usuarios ON
					(entrada_medicamento.usuario_id=usuarios.id) INNER JOIN fornecedor ON
					(entrada_medicamento.fornecedor_id=fornecedor.id) 
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