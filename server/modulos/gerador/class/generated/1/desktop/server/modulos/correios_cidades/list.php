<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'correios_cidades';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM correios_cidades
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT id as id, loc_nome as descricao 
				FROM correios_cidades
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
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('loc_nome_abreviado', 'correios_cidades.loc_nome_abreviado'), $_POST['loc_nome_abreviado'], 'like');
				$buscar->setBusca(array('loc_nome', 'correios_cidades.loc_nome'), $_POST['loc_nome'], 'like');
				$buscar->setBusca(array('cep', 'correios_cidades.cep'), $_POST['cep'], 'like');
				$buscar->setBusca(array('uf_sigla', 'correios_cidades.uf_sigla'), $_POST['uf_sigla'], 'like');
				$buscar->setBusca(array('loc_tipo', 'correios_cidades.loc_tipo'), $_POST['loc_tipo'], 'like');
				$buscar->setBusca(array('ativo', 'correios_cidades.ativo'), $_POST['ativo'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'correios_cidades.cadastrado_por'), $_POST['cadastrado_por']);
				$buscar->setBusca(array('data_cadastro', 'correios_cidades.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'], 'like');
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
				FROM correios_cidades 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT correios_cidades.*, 
					DATE_FORMAT(correios_cidades.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(correios_cidades.data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM correios_cidades 
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