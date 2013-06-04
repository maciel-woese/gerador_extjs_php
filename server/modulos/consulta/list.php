<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'consulta';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *, 
					DATE_FORMAT(data_hora, '%H:%i:%s') as data_hora_time, 
					DATE_FORMAT(data_hora, '%Y-%m-%d') as data_hora_date 
				FROM consulta
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
			$buscar->setBusca(array('filial_id', "{$tabela}.filial_id"), $user->filial_id);
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('data_hora', 'consulta.data_hora'), implode('-', array_reverse(explode('/', $_POST['data_hora_date'])))." ".$_POST['data_hora_time'], 'like');
				$buscar->setBusca(array('faltou', 'consulta.faltou'), $_POST['faltou'], 'like');
				$buscar->setBusca(array('medico_id', 'consulta.medico_id'), $_POST['medico_id']);
				$buscar->setBusca(array('paciente_id', 'consulta.paciente_id'), $_POST['paciente_id']);
				$buscar->setBusca(array('senha', 'consulta.senha'), $_POST['senha']);
				$buscar->setBusca(array('queixa_principal', 'consulta.queixa_principal'), $_POST['queixa_principal'], 'like');
				$buscar->setBusca(array('exame_fisico', 'consulta.exame_fisico'), $_POST['exame_fisico'], 'like');
				$buscar->setBusca(array('hipotese_diagnostica', 'consulta.hipotese_diagnostica'), $_POST['hipotese_diagnostica'], 'like');
				$buscar->setBusca(array('tratamento', 'consulta.tratamento'), $_POST['tratamento'], 'like');
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
				FROM consulta INNER JOIN medico ON
					(consulta.medico_id=medico.id) INNER JOIN pacientes ON
					(consulta.paciente_id=pacientes.id) 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT consulta.*, 
					DATE_FORMAT(consulta.data_hora, '%H:%i:%s') as data_hora_time, 
					DATE_FORMAT(consulta.data_hora, '%Y-%m-%d') as data_hora_date, medico.medico, pacientes.paciente 
				FROM consulta INNER JOIN medico ON
					(consulta.medico_id=medico.id) INNER JOIN pacientes ON
					(consulta.paciente_id=pacientes.id) 
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