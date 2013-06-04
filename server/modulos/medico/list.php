<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'medico';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM medico
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			$buscar->setBusca(array('filial_id', "{$tabela}.filial_id"), $user->filial_id);
			$filtro = $buscar->getSql();
			$pdo = $connection->prepare("
				SELECT id as id, medico as descricao 
				FROM medico {$filtro};
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
			$buscar->setBusca(array('filial_id', "{$tabela}.filial_id"), $user->filial_id);
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('medico', 'medico.medico'), $_POST['medico'], 'like');
				$buscar->setBusca(array('crm', 'medico.crm'), $_POST['crm'], 'like');
				$buscar->setBusca(array('especialidade_id', 'medico.especialidade_id'), $_POST['especialidade_id']);
				$buscar->setBusca(array('uf_id', 'medico.uf_id'), $_POST['uf_id']);
				$buscar->setBusca(array('cidade_id', 'medico.cidade_id'), $_POST['cidade_id']);
				$buscar->setBusca(array('bairro', 'medico.bairro'), $_POST['bairro'], 'like');
				$buscar->setBusca(array('endereco', 'medico.endereco'), $_POST['endereco'], 'like');
				$buscar->setBusca(array('cep', 'medico.cep'), $_POST['cep'], 'like');
				$buscar->setBusca(array('telefone', 'medico.telefone'), $_POST['telefone'], 'like');
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
				FROM medico INNER JOIN especialidades ON
					(medico.especialidade_id=especialidades.id) INNER JOIN estados ON
					(medico.uf_id=estados.id) INNER JOIN cidades ON
					(medico.cidade_id=cidades.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT medico.*, especialidades.especialidade, estados.descricao, cidades.cidade 
				FROM medico INNER JOIN especialidades ON
					(medico.especialidade_id=especialidades.id) INNER JOIN estados ON
					(medico.uf_id=estados.id) INNER JOIN cidades ON
					(medico.cidade_id=cidades.id) 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			
			$result["total"] = $countRow;
			$res = array();
			foreach($query as $row){
				$row->descricao = utf8_encode($row->descricao);
				$res[] = $row;
			}
			$result["dados"] = $res;
			
			echo json_encode($result);
		}
	} 
	catch (PDOException $e) {
		echo json_encode(array('dados'=>array(),'total'=>0, 'erro'=>$e->getMessage()));
	}	
}
?>