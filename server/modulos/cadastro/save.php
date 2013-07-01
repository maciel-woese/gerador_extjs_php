<?php
session_start();
if($_POST){
	$_SESSION['language'] = $_POST['language'];
	require_once('../../lib/Connection.class.php');
	require_once("../../locale/{$_SESSION['language']}.php");
	$connection = new Connection;
	$tabela = 'usuarios';
	try {
		if ($_POST['action'] == 'INSERIR'){
			$pdo = $connection->prepare("
				INSERT INTO usuarios 
					(nome, data_cadastro, email, login, senha, id_grupo, exportar, status) 
				VALUES 
					(?, NOW(), ?, ?, ?, 2, '0', '0')
			");
			$email = explode('@', $_POST['email_user']);
			
			if (!checkdnsrr($email[1])){
				throw new PDOException(utf8_encode(EMAIL_INVALID));
			} 
			
			$pdo->execute(array(
				$_POST['nome_user'],
				$_POST['email_user'],
				$_POST['login_user'],
				md5($_POST['senha_user'])
			));
			
			echo json_encode(array('success'=>true, 'msg'=>SALVED));
			
			$_SESSION['EMAIL_CONFIRM'] = $_POST['email_user'];
			$_SESSION['CADASTRO_CONFIRM'] = true;
			$_SESSION['ID_CONFIRM'] = $connection->lastInsertId();
		}
		
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
	}
}