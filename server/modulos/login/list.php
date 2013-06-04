<?php
require_once('../../lib/Connection.class.php');
require_once('../../lib/Usuarios.class.php');

$usuarios = new Usuarios();
	
try {
	if($_POST['action']=='LOGIN_USER'){
		if($usuarios->setLogar($_POST['login_user'], $_POST['senha_user'], $_POST['tipo'])){
			$_SESSION['locale'] = $_POST['locale'];
			$_SESSION['language'] = $_POST['locale'];
			echo json_encode( array('success'=>true) );
		}
		else{
			
			echo json_encode( array('success'=>false, 'msg'=>utf8_encode(USER_PASS_INVALID)) );
		}
	}
	else if($_POST['action']=='SET_TEMPO'){
		$usuarios->setTempo($_SESSION['id_usuario']);
		echo json_encode( array('success'=>true) );
	}
	
}
catch(Exception $e){
	if($_POST['action']=='SET_TEMPO'){
		echo json_encode( array('success'=>false, 'msg'=>$e->getMessage(), 'logout'=> true) );
	}
	else{
		echo json_encode( array('success'=>false, 'msg'=>$e->getMessage()));
	}
}
?>