<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'perfil';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM perfil
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			if($user->administrador!=true){
				$filtro = "";
				if($user->filial_id_admin==0){
					$filtro .= "WHERE id != 2";
				}
			}
			else{
				$filtro = " ";
			}
			$pdo = $connection->prepare("
				SELECT id as id, perfil as descricao 
				FROM perfil {$filtro}
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
			if($user->administrador!=true){
				$buscar->setBusca(array('id', 'perfil.id'), 1, 'diff');
				if($user->filial_id_admin==0){
					$buscar->setBusca(array('id2', 'perfil.id'), 2, 'diff');
					$buscar->setBusca(array('id3', 'perfil.id'), $user->perfil_id, 'diff');
				}
				else{
					$buscar->setBusca(array('id2', 'perfil.id'), 2, 'diff');
				}
			}
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('perfil', 'perfil.perfil'), $_POST['perfil'], 'like');
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
				FROM perfil 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				
				SELECT perfil.* 
				FROM perfil 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit}
			;
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