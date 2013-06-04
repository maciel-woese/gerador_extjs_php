<?php
if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'grupo';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("SELECT grupo.* 
				FROM grupo  WHERE grupo.id=:id");
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("SELECT id as id, grupo as descricao FROM grupo");
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
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
					$buscar->setBusca(array('grupo'), $_POST['grupo'], 'like');				
			}
			
			$filtro = $buscar->getSql();
			
			$pdo = $connection->prepare("SELECT count(*) as total FROM grupo {$filtro};");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT grupo.* 
				FROM grupo 
				{$filtro} ORDER BY {$sort} {$order} LIMIT {$start}, {$limit};");
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