<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'entrada_produtos';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM entrada_produtos
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else{
			$pag = new Paginar($_POST);
			
			//$page 	= $pag->getPage();
			//$start	= $pag->getStart();
			//$limit	= $pag->getLimit();
			$sort 	= $pag->getSort();
			$order 	= $pag->getOrder();
			
			$result = array();
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('entrada_id', 'entrada_produtos.entrada_id'), $_POST['entrada_id']);
				$buscar->setBusca(array('medicamento_id', 'entrada_produtos.medicamento_id'), $_POST['medicamento_id']);
				$buscar->setBusca(array('quantidade', 'entrada_produtos.quantidade'), $_POST['quantidade']);
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
				FROM entrada_produtos INNER JOIN entrada_medicamento ON
					(entrada_produtos.entrada_id=entrada_medicamento.id) INNER JOIN medicamento ON
					(entrada_produtos.medicamento_id=medicamento.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT entrada_produtos.*, entrada_medicamento.nota, medicamento.medicamento 
				FROM entrada_produtos INNER JOIN entrada_medicamento ON
					(entrada_produtos.entrada_id=entrada_medicamento.id) INNER JOIN medicamento ON
					(entrada_produtos.medicamento_id=medicamento.id) 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				-- LIMIT {$start}, {$limit};
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