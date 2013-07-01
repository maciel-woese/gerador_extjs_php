<?php
if($_POST){
	require('../../autoLoad.php');
	$tabela = 'grupo';
	try {
		$pdo = $connection->prepare("DELETE FROM generated WHERE id = :id");
		$pdo->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
		$pdo->execute();
		@unlink("../gerador/".$_POST['zip']);
		echo json_encode(array('success'=>true, 'msg'=>REMOVED));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'erro'=>$e->getMessage()));
	}
}

?>