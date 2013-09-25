<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'verification';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(date_start, '%H:%i:%s') as date_start_time, 
					DATE_FORMAT(date_start, '%Y-%m-%d') as date_start_date, 
					DATE_FORMAT(date_finish, '%H:%i:%s') as date_finish_time, 
					DATE_FORMAT(date_finish, '%Y-%m-%d') as date_finish_date 
				FROM verification
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
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
				$buscar->setBusca(array('user_id', 'verification.user_id'), $_POST['user_id']);
				$buscar->setBusca(array('date_start', 'verification.date_start'), implode('-', array_reverse(explode('/', $_POST['date_start_date'])))." ".$_POST['date_start_time'], 'like');
				$buscar->setBusca(array('date_finish', 'verification.date_finish'), implode('-', array_reverse(explode('/', $_POST['date_finish_date'])))." ".$_POST['date_finish_time'], 'like');
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
				FROM verification 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT verification.*, 
					DATE_FORMAT(verification.date_start, '%H:%i:%s') as date_start_time, 
					DATE_FORMAT(verification.date_start, '%Y-%m-%d') as date_start_date, 
					DATE_FORMAT(verification.date_finish, '%H:%i:%s') as date_finish_time, 
					DATE_FORMAT(verification.date_finish, '%Y-%m-%d') as date_finish_date 
				FROM verification 
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