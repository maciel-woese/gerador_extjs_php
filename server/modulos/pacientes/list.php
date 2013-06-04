<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'pacientes';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(data_cadastro, '%Y-%m-%d') as data_cadastro_date 
				FROM pacientes
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
				FROM pacientes 
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
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT id as id, paciente as descricao 
				FROM pacientes
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
				$buscar->setBusca(array('data_cadastro', 'pacientes.data_cadastro'), implode('-', array_reverse(explode('/', $_POST['data_cadastro_date']))), 'like');
				$buscar->setBusca(array('paciente', 'pacientes.paciente'), $_POST['paciente'], 'like');
				$buscar->setBusca(array('data_nascimento', 'pacientes.data_nascimento'), implode('-', array_reverse(explode('/', $_POST['data_nascimento']))), 'like');
				$buscar->setBusca(array('sexo', 'pacientes.sexo'), $_POST['sexo'], 'like');
				$buscar->setBusca(array('tipo_sanguineo', 'pacientes.tipo_sanguineo'), $_POST['tipo_sanguineo'], 'like');
				$buscar->setBusca(array('rg', 'pacientes.rg'), $_POST['rg'], 'like');
				$buscar->setBusca(array('cpf', 'pacientes.cpf'), $_POST['cpf'], 'like');
				$buscar->setBusca(array('uf_id', 'pacientes.uf_id'), $_POST['uf_id']);
				$buscar->setBusca(array('cidade_id', 'pacientes.cidade_id'), $_POST['cidade_id']);
				$buscar->setBusca(array('bairro', 'pacientes.bairro'), $_POST['bairro'], 'like');
				$buscar->setBusca(array('endereco', 'pacientes.endereco'), $_POST['endereco'], 'like');
				$buscar->setBusca(array('cep', 'pacientes.cep'), $_POST['cep'], 'like');
				$buscar->setBusca(array('trabalho', 'pacientes.trabalho'), $_POST['trabalho'], 'like');
				$buscar->setBusca(array('telefone', 'pacientes.telefone'), $_POST['telefone'], 'like');
				$buscar->setBusca(array('pai', 'pacientes.pai'), $_POST['pai'], 'like');
				$buscar->setBusca(array('mae', 'pacientes.mae'), $_POST['mae'], 'like');
				$buscar->setBusca(array('obs', 'pacientes.obs'), $_POST['obs'], 'like');
				$buscar->setBusca(array('status', 'pacientes.status'), $_POST['status'], 'like');
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
				FROM pacientes INNER JOIN estados ON
					(pacientes.uf_id=estados.id) INNER JOIN cidades ON
					(pacientes.cidade_id=cidades.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT pacientes.*, 
					DATE_FORMAT(pacientes.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(pacientes.data_cadastro, '%Y-%m-%d') as data_cadastro_date, estados.descricao, cidades.cidade 
				FROM pacientes INNER JOIN estados ON
					(pacientes.uf_id=estados.id) INNER JOIN cidades ON
					(pacientes.cidade_id=cidades.id) 
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