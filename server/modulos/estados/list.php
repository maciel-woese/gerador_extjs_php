<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'estados';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM estados
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
		else if( isset($_POST['action']) AND $_POST['action'] == 'VALID_UNIQUE' ){
			
			$pdo = $connection->prepare("
				SELECT COUNT(*) as total 
				FROM estados 
				WHERE {$_POST['param']} = :valor 
			");
			$pdo->bindParam(':valor', $_POST['valor']);
			$pdo->execute();
		
			$total = $pdo->fetch(PDO::FETCH_OBJ)->total;
			
			if($total > 0){
				$success = false;
			} else{ $success = true; }
			
			echo json_encode( array('success'=>$success) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT id as id, descricao as descricao 
				FROM estados
			");
			$pdo->execute();
			
			$linhas = $pdo->fetchAll(PDO::FETCH_OBJ);
			$res = array();
			foreach($linhas as $row){
				$row->descricao = utf8_encode($row->descricao);
				$res[] = $row;
			}
			echo json_encode( array('success'=>true, 'dados'=>$res) );
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
				$buscar->setBusca(array('sigla', 'estados.sigla'), $_POST['sigla'], 'like');
				$buscar->setBusca(array('descricao', 'estados.descricao'), $_POST['descricao'], 'like');
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
				FROM estados 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT estados.* 
				FROM estados 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			
			$result["total"] = $countRow;
			$res = array();
			foreach($query as $row){
				$row->descricao = utf8_encode($row->descricao);
				$res[] = $row;
			}
			$result["dados"] = $res;
			
			echo json_encode($result);
		}
	} 
	catch (PDOException $e) {
		echo json_encode(array('dados'=>array(),'total'=>0, 'erro'=>$e->getMessage()));
	}	
}
?>