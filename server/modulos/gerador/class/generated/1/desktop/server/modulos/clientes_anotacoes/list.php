<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'clientes_anotacoes';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM clientes_anotacoes
				WHERE controle=:id
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
				$buscar->setBusca(array('cod_cliente', 'clientes_anotacoes.cod_cliente'), $_POST['cod_cliente']);
				$buscar->setBusca(array('anotacao', 'clientes_anotacoes.anotacao'), $_POST['anotacao'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'clientes_anotacoes.cadastrado_por'), $_POST['cadastrado_por']);
				$buscar->setBusca(array('data_cadastro', 'clientes_anotacoes.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'], 'like');
				$buscar->setBusca(array('ativo', 'clientes_anotacoes.ativo'), $_POST['ativo'], 'like');
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
				FROM clientes_anotacoes INNER JOIN clientes ON
					(clientes_anotacoes.cod_cliente=clientes.cod_cliente) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT clientes_anotacoes.*, 
					DATE_FORMAT(clientes_anotacoes.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(clientes_anotacoes.data_cadastro, '%Y-%m-%d') as data_cadastro_date, clientes.nome_completo 
				FROM clientes_anotacoes INNER JOIN clientes ON
					(clientes_anotacoes.cod_cliente=clientes.cod_cliente) 
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