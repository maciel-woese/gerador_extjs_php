<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'filial';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM filial 
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			$filtro = $buscar->getSql();
			$pdo = $connection->prepare("
				SELECT id as id, filial as descricao 
				FROM filial
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
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('filial', 'filial.filial'), $_POST['filial'], 'like');
				$buscar->setBusca(array('uf_id', 'filial.uf_id'), $_POST['uf_id']);
				$buscar->setBusca(array('cidade_id', 'filial.cidade_id'), $_POST['cidade_id']);
				$buscar->setBusca(array('bairro', 'filial.bairro'), $_POST['bairro'], 'like');
				$buscar->setBusca(array('endereco', 'filial.endereco'), $_POST['endereco'], 'like');
				$buscar->setBusca(array('cep', 'filial.cep'), $_POST['cep'], 'like');
				$buscar->setBusca(array('telefone', 'filial.telefone'), $_POST['telefone'], 'like');
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
				FROM filial 
				INNER JOIN estados ON (filial.uf_id=estados.id) 
				INNER JOIN cidades ON (filial.cidade_id=cidades.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT filial.*, estados.descricao, cidades.cidade 
				FROM filial 
				INNER JOIN estados ON (filial.uf_id=estados.id) 
				INNER JOIN cidades ON (filial.cidade_id=cidades.id) 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			$res = array();
			foreach($query as $row){
				$row->descricao = utf8_encode($row->descricao);
				$res[] = $row;
			}
			$result["total"] = $countRow;
			$result["dados"] = $res;
			
			echo json_encode($result);
		}
	} 
	catch (PDOException $e) {
		echo json_encode(array('dados'=>array(),'total'=>0, 'erro'=>$e->getMessage()));
	}	
}
?>