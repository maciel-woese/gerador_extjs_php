<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'correios_bairros';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM correios_bairros
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT id as id, bairro_nome as descricao 
				FROM correios_bairros
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
				$buscar->setBusca(array('uf_sigla', 'correios_bairros.uf_sigla'), $_POST['uf_sigla'], 'like');
				$buscar->setBusca(array('localidade_id', 'correios_bairros.localidade_id'), $_POST['localidade_id']);
				$buscar->setBusca(array('bairro_nome', 'correios_bairros.bairro_nome'), $_POST['bairro_nome'], 'like');
				$buscar->setBusca(array('bairro_nome_abreviado', 'correios_bairros.bairro_nome_abreviado'), $_POST['bairro_nome_abreviado'], 'like');
				$buscar->setBusca(array('ativo', 'correios_bairros.ativo'), $_POST['ativo'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'correios_bairros.cadastrado_por'), $_POST['cadastrado_por']);
				$buscar->setBusca(array('data_cadastro', 'correios_bairros.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'], 'like');
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
				FROM correios_bairros 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT correios_bairros.*, 
					DATE_FORMAT(correios_bairros.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(correios_bairros.data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM correios_bairros 
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