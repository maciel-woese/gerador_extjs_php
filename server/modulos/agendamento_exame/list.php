<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'agendamento_exame';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_exame, '%H:%i:%s') as data_exame_time, 
					DATE_FORMAT(data_exame, '%Y-%m-%d') as data_exame_date, 
					DATE_FORMAT(data_entrega, '%H:%i:%s') as data_entrega_time, 
					DATE_FORMAT(data_entrega, '%Y-%m-%d') as data_entrega_date 
				FROM agendamento_exame
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
			$buscar->setBusca(array('filial_id', 'agendamento_exame.filial_id'), $user->filial_id);
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('data_exame', 'agendamento_exame.data_exame'), implode('-', array_reverse(explode('/', $_POST['data_exame_date']))), 'like');
				$buscar->setBusca(array('data_entrega', 'agendamento_exame.data_entrega'), implode('-', array_reverse(explode('/', $_POST['data_entrega_date']))), 'like');
				$buscar->setBusca(array('usuario_id', 'agendamento_exame.usuario_id'), $_POST['usuario_id']);
				$buscar->setBusca(array('paciente_id', 'agendamento_exame.paciente_id'), $_POST['paciente_id']);
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
				FROM agendamento_exame INNER JOIN usuarios ON
					(agendamento_exame.usuario_id=usuarios.id) INNER JOIN pacientes ON
					(agendamento_exame.paciente_id=pacientes.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT agendamento_exame.*, 
					DATE_FORMAT(agendamento_exame.data_exame, '%H:%i:%s') as data_exame_time, 
					DATE_FORMAT(agendamento_exame.data_exame, '%Y-%m-%d') as data_exame_date, 
					DATE_FORMAT(agendamento_exame.data_entrega, '%H:%i:%s') as data_entrega_time, 
					DATE_FORMAT(agendamento_exame.data_entrega, '%Y-%m-%d') as data_entrega_date, usuarios.nome, pacientes.paciente 
				FROM agendamento_exame INNER JOIN usuarios ON
					(agendamento_exame.usuario_id=usuarios.id) INNER JOIN pacientes ON
					(agendamento_exame.paciente_id=pacientes.id) 
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