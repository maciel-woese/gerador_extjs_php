<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'usuarios';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM usuarios
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
				FROM usuarios 
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
	
		else{
			$pag = new Paginar($_POST);
			
			$page 	= $pag->getPage();
			$start	= $pag->getStart();
			$limit	= $pag->getLimit();
			$sort 	= $pag->getSort();
			$order 	= $pag->getOrder();
			
			$result = array();
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('nome', 'usuarios.nome'), $_POST['nome'], 'like');
				$buscar->setBusca(array('data_cadastro', 'usuarios.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro']))), 'like');
				$buscar->setBusca(array('email', 'usuarios.email'), $_POST['email'], 'like');
				$buscar->setBusca(array('login', 'usuarios.login'), $_POST['login'], 'like');
				$buscar->setBusca(array('id_grupo', 'usuarios.id_grupo'), $_POST['id_grupo']);
				$buscar->setBusca(array('status', 'usuarios.status'), $_POST['status'], 'like');
				$buscar->setBusca(array('exportar', 'usuarios.exportar'), $_POST['exportar'], 'like');
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
				FROM usuarios INNER JOIN grupo ON
					(usuarios.id_grupo=grupo.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT usuarios.*, grupo.grupo 
				FROM usuarios INNER JOIN grupo ON
					(usuarios.id_grupo=grupo.id) 
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