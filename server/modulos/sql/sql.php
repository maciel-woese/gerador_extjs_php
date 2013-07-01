<?php
require('../../autoLoad.php');
	
try {
	if($_SESSION['id_grupo_usuario']=='1'){
		$pdo = $connection->prepare($_POST['sql']);
		$pdo->execute();
		echo json_encode(array('success'=>true, 'msg'=>"Execultado com Sucesso!"));
	}
	else{
		throw new PDOException(utf8_encode("Sem Acesso a esta aчуo"));
	}
}
catch(PDOException $e){
	echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
}
?>