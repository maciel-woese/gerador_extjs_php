<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		if(($user->filial_id_admin!=1) and ($user->administrador!=true)){
			die(json_encode(array(
				'success'	=> false,
				'msg'		=> utf8_encode("Permissões Insuficientes!"),
				'dados'		=> array()
			)));
		}
		if(isset($_POST['action']) AND $_POST['action'] == 'ALTERAR'){
			$sessao = unserialize($_SESSION['SESSION_USUARIO']);
			$sessao['filial_id'] = $_POST['id'];
			$sessao['filial_nome'] = $_POST['nome'];
			$_SESSION['SESSION_USUARIO'] = serialize($sessao);
			echo json_encode(array('success'=>true));
		}
	} 
	catch (Exception $e) {
		echo json_encode(array('success'=>false));
	}	
}

?>