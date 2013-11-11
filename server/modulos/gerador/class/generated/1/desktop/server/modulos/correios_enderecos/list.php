<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'correios_enderecos';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM correios_enderecos
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
				$buscar->setBusca(array('uf_sigla', 'correios_enderecos.uf_sigla'), $_POST['uf_sigla'], 'like');
				$buscar->setBusca(array('localidade_id', 'correios_enderecos.localidade_id'), $_POST['localidade_id']);
				$buscar->setBusca(array('nome', 'correios_enderecos.nome'), $_POST['nome'], 'like');
				$buscar->setBusca(array('bairro_id_inicial', 'correios_enderecos.bairro_id_inicial'), $_POST['bairro_id_inicial']);
				$buscar->setBusca(array('bairro_id_final', 'correios_enderecos.bairro_id_final'), $_POST['bairro_id_final']);
				$buscar->setBusca(array('cep', 'correios_enderecos.cep'), $_POST['cep'], 'like');
				$buscar->setBusca(array('complemento', 'correios_enderecos.complemento'), $_POST['complemento'], 'like');
				$buscar->setBusca(array('tipo', 'correios_enderecos.tipo'), $_POST['tipo'], 'like');
				$buscar->setBusca(array('ativo', 'correios_enderecos.ativo'), $_POST['ativo'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'correios_enderecos.cadastrado_por'), $_POST['cadastrado_por']);
				$buscar->setBusca(array('data_cadastro', 'correios_enderecos.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'], 'like');
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
				FROM correios_enderecos 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT correios_enderecos.*, 
					DATE_FORMAT(correios_enderecos.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(correios_enderecos.data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM correios_enderecos 
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