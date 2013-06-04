<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'agendamento_transporte';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM agendamento_transporte
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
			
			$buscar->setBusca(array('filial_id', 'agendamento_transporte.filial_id'), $user->filial_id);
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('data', 'agendamento_transporte.data'), implode('-', array_reverse(explode('/', $_POST['data']))), 'like');
				$buscar->setBusca(array('hora_saida', 'agendamento_transporte.hora_saida'), $_POST['hora_saida'], 'like');
				$buscar->setBusca(array('usuario_id', 'agendamento_transporte.usuario_id'), $_POST['usuario_id']);
				$buscar->setBusca(array('veiculo_id', 'agendamento_transporte.veiculo_id'), $_POST['veiculo_id']);
				$buscar->setBusca(array('destino', 'agendamento_transporte.destino'), $_POST['destino'], 'like');
				$buscar->setBusca(array('obs', 'agendamento_transporte.obs'), $_POST['obs'], 'like');
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
				FROM agendamento_transporte 
					INNER JOIN usuarios ON
						(agendamento_transporte.usuario_id=usuarios.id) 
					INNER JOIN veiculos ON
						(agendamento_transporte.veiculo_id=veiculos.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT 	agendamento_transporte.*, usuarios.nome, 
						veiculos.veiculo,  veiculos.passageiros
				FROM agendamento_transporte 
					INNER JOIN usuarios ON
						(agendamento_transporte.usuario_id=usuarios.id) 
					INNER JOIN veiculos ON
						(agendamento_transporte.veiculo_id=veiculos.id) 
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