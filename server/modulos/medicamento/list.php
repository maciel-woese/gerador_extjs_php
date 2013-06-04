<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'medicamento';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM medicamento
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
				SELECT id as id, medicamento as descricao, quantidade
				FROM medicamento {$filtro};
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
				$buscar->setBusca(array('medicamento', 'medicamento.medicamento'), $_POST['medicamento'], 'like');
				$buscar->setBusca(array('codigo_barras', 'medicamento.codigo_barras'), $_POST['codigo_barras'], 'like');
				$buscar->setBusca(array('laboratorio_id', 'medicamento.laboratorio_id'), $_POST['laboratorio_id']);
				$buscar->setBusca(array('quantidade', 'medicamento.quantidade'), $_POST['quantidade']);
				$buscar->setBusca(array('quantidade_minima', 'medicamento.quantidade_minima'), $_POST['quantidade_minima']);
				$buscar->setBusca(array('obs', 'medicamento.obs'), $_POST['obs'], 'like');
				$buscar->setBusca(array('status', 'medicamento.status'), $_POST['status'], 'like');
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
				FROM medicamento INNER JOIN laboratorio ON
					(medicamento.laboratorio_id=laboratorio.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT medicamento.*, laboratorio.laboratorio 
				FROM medicamento INNER JOIN laboratorio ON
					(medicamento.laboratorio_id=laboratorio.id) 
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