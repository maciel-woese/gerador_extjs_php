<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'clientes_endereco';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM clientes_endereco
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
				$buscar->setBusca(array('cod_cliente', 'clientes_endereco.cod_cliente'), $_POST['cod_cliente']);
				$buscar->setBusca(array('estado', 'clientes_endereco.estado'), $_POST['estado']);
				$buscar->setBusca(array('cidade', 'clientes_endereco.cidade'), $_POST['cidade']);
				$buscar->setBusca(array('bairro', 'clientes_endereco.bairro'), $_POST['bairro']);
				$buscar->setBusca(array('logradouro', 'clientes_endereco.logradouro'), $_POST['logradouro'], 'like');
				$buscar->setBusca(array('num_end', 'clientes_endereco.num_end'), $_POST['num_end'], 'like');
				$buscar->setBusca(array('complemento', 'clientes_endereco.complemento'), $_POST['complemento'], 'like');
				$buscar->setBusca(array('cep', 'clientes_endereco.cep'), $_POST['cep'], 'like');
				$buscar->setBusca(array('cx_postal', 'clientes_endereco.cx_postal'), $_POST['cx_postal'], 'like');
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
				FROM clientes_endereco INNER JOIN clientes ON
					(clientes_endereco.cod_cliente=clientes.cod_cliente) INNER JOIN correios_estados ON
					(clientes_endereco.estado=correios_estados.id) INNER JOIN correios_cidades ON
					(clientes_endereco.cidade=correios_cidades.id) INNER JOIN correios_bairros ON
					(clientes_endereco.bairro=correios_bairros.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT clientes_endereco.*, clientes.nome_completo, correios_estados.descricao, correios_cidades.loc_nome, correios_bairros.bairro_nome 
				FROM clientes_endereco INNER JOIN clientes ON
					(clientes_endereco.cod_cliente=clientes.cod_cliente) INNER JOIN correios_estados ON
					(clientes_endereco.estado=correios_estados.id) INNER JOIN correios_cidades ON
					(clientes_endereco.cidade=correios_cidades.id) INNER JOIN correios_bairros ON
					(clientes_endereco.bairro=correios_bairros.id) 
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