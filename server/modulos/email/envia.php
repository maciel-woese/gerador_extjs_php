<?php
session_start();
require_once('email.php');
require_once("../../locale/{$_SESSION['language']}.php");
if($_POST){
	try {
		if($_POST['action']=='ENVIAR'){
			$msg = "
				Nome: {$_POST['nome']} <br>
				Email: {$_POST['email']} <br>
				Msg: {$_POST['message']}
			";
			if(enviar_email($_POST['assunto'], $msg)){
				echo json_encode(array('success'=>true, 'msg'=>EMAIL_SEND));
			}
		}
		else{
			throw new Exception(utf8_encode(ACTION_NOT_FOUND));
		}
	}
	catch (Exception $e) {
		echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
	}
}

?>