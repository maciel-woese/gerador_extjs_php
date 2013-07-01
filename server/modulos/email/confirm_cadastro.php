<?php
session_start();
require_once('email.php');
require_once("../../locale/{$_SESSION['language']}.php");
if($_SESSION['CADASTRO_CONFIRM']){
	try {
		$timer = time();
		$mensagem = MSG_EMAIL_1;
		$mensagem .= 'http://www.shsolutions.com.br/framework/server/modulos/cadastro/confirmar.php';
		
		if(enviar_email(MSG_EMAIL_3, $mensagem, $_SESSION['EMAIL_CONFIRM'])){
			$_SESSION['CADASTRO_CONFIRM_NOW'] = true;
			unset($_SESSION['CADASTRO_CONFIRM']);
			echo json_encode(array('success'=>true, 'msg'=>EMAIL_SEND_CONFIRM));
		}
		else{
			throw new Exception('Erro send Email');
		}
	}
	catch (Exception $e) {
		echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
	}
}
else{
	echo json_encode(array('success'=>false, 'msg'=>"Error!"));
}

?>