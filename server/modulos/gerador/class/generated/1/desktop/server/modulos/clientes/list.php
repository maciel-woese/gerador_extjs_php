<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'clientes';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date, 
					DATE_FORMAT(data_alteracao, '%H:%i:%s') as data_alteracao_time, 
					DATE_FORMAT(data_alteracao, '%Y-%m-%d') as data_alteracao_date 
				FROM clientes
				WHERE cod_cliente=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT cod_cliente as id, nome_completo as descricao 
				FROM clientes
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
				$buscar->setBusca(array('tipo_cliente', 'clientes.tipo_cliente'), $_POST['tipo_cliente'], 'like');
				$buscar->setBusca(array('nome_completo', 'clientes.nome_completo'), $_POST['nome_completo'], 'like');
				$buscar->setBusca(array('razao_social', 'clientes.razao_social'), $_POST['razao_social'], 'like');
				$buscar->setBusca(array('nome_fantasia', 'clientes.nome_fantasia'), $_POST['nome_fantasia'], 'like');
				$buscar->setBusca(array('pessoa_contato', 'clientes.pessoa_contato'), $_POST['pessoa_contato'], 'like');
				$buscar->setBusca(array('data_nascimento', 'clientes.data_nascimento'), implode('-', array_reverse(explode('/', $_POST['data_nascimento']))), 'like');
				$buscar->setBusca(array('sexo', 'clientes.sexo'), $_POST['sexo'], 'like');
				$buscar->setBusca(array('cpf', 'clientes.cpf'), $_POST['cpf'], 'like');
				$buscar->setBusca(array('cnpj', 'clientes.cnpj'), $_POST['cnpj'], 'like');
				$buscar->setBusca(array('ie', 'clientes.ie'), $_POST['ie'], 'like');
				$buscar->setBusca(array('im', 'clientes.im'), $_POST['im'], 'like');
				$buscar->setBusca(array('identidade', 'clientes.identidade'), $_POST['identidade'], 'like');
				$buscar->setBusca(array('profissao', 'clientes.profissao'), $_POST['profissao'], 'like');
				$buscar->setBusca(array('data_cadastro', 'clientes.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'clientes.cadastrado_por'), $_POST['cadastrado_por'], 'like');
				$buscar->setBusca(array('data_alteracao', 'clientes.data_alteracao'), implode('-', array_reverse(explode('/', $_POST['data_alteracao_date'])))." ".$_POST['data_alteracao_time'], 'like');
				$buscar->setBusca(array('situacao_cadastral', 'clientes.situacao_cadastral'), $_POST['situacao_cadastral'], 'like');
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
				FROM clientes 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT clientes.*, 
					DATE_FORMAT(clientes.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(clientes.data_cadastro, '%Y-%m-%d') as data_cadastro_date, 
					DATE_FORMAT(clientes.data_alteracao, '%H:%i:%s') as data_alteracao_time, 
					DATE_FORMAT(clientes.data_alteracao, '%Y-%m-%d') as data_alteracao_date 
				FROM clientes 
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