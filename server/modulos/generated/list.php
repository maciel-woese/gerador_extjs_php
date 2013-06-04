<?php
if($_POST){
	extract($_POST);
	try {
		require('../../autoLoad.php');
		$tabela = 'generated';
		if(isset($_POST['action']) AND $_POST['action'] == 'LIST_CHART'){
			$result = array();
			$pdo = $connection->prepare("
				SELECT count(*) as numero, MONTH(data) as mes
				FROM {$tabela}
				WHERE usuario_id = ? AND YEAR(data) = YEAR(NOW())
				GROUP BY MONTH(data)
			");
			
			$pdo->execute(array($_SESSION['id_usuario']));
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			$result = array(
				'1'=> array('mes'=> MES_1, 'numero'=> 0),
				'2'=> array('mes'=> MES_2, 'numero'=> 0),
				'3'=> array('mes'=> utf8_encode(MES_3), 'numero'=> 0),
				'4'=> array('mes'=> MES_4, 'numero'=> 0),
				'5'=> array('mes'=> MES_5, 'numero'=> 0),
				'6'=> array('mes'=> MES_6, 'numero'=> 0),
				'7'=> array('mes'=> MES_7, 'numero'=> 0),
				'8'=> array('mes'=> MES_8, 'numero'=> 0),
				'9'=> array('mes'=> MES_9, 'numero'=> 0),
				'10'=> array('mes'=> MES_10, 'numero'=> 0),
				'11'=> array('mes'=> MES_11, 'numero'=> 0),
				'12'=> array('mes'=> MES_12, 'numero'=> 0)
			);
			
			foreach($query as $row){
				$result[$row->mes]['numero'] = (int) $row->numero;
			}
			
			echo json_encode(array('dados'=>array_values($result)));
			
		}
		else{
			$result = array();
			
			$pdo = $connection->prepare("
				SELECT count(*) as total FROM {$tabela} as g  WHERE g.usuario_id = ?
			");
			
			$pdo->execute(array($_SESSION['id_usuario']));
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT g.*, u.nome as usuario,
					DATE_FORMAT(g.data, '%Y-%m-%d') as data
				FROM {$tabela} as g 
				INNER JOIN usuarios u ON (g.usuario_id=u.id)
				WHERE g.usuario_id = ?
				ORDER BY g.id DESC LIMIT {$start}, {$limit};
			");
			$pdo->execute(array($_SESSION['id_usuario']));
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			
			$result["total"] = $countRow;
			$result["dados"] = $query;
			
			echo json_encode($result);
		}
	} 
	catch (PDOException $e) {
		echo json_encode(array('dados'=>array(),'total'=>0, 'msg'=>$e->getMessage()));
	}	
}
?>