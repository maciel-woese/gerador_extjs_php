<?php
session_start();
if($_SESSION['CADASTRO_CONFIRM_NOW']){
	require_once('../../lib/Connection.class.php');
	require_once("../../locale/{$_SESSION['language']}.php");
	$connection = new Connection;
	$tabela = 'usuarios';
	try {
		$pdo = $connection->prepare("
			UPDATE usuarios SET
				status = '1'
			WHERE id = ?	
		");
		$pdo->execute(array(
			$_SESSION['ID_CONFIRM']
		));
		unset($_SESSION['CADASTRO_CONFIRM_NOW']);
		echo MSG_EMAIL_4;
	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}
}