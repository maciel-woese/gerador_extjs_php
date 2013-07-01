<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

if($_POST){
	error_reporting(0);
	require_once('../lib/Connection.class.php');
	require_once('../lib/Usuarios.class.php');
	$user = new Usuarios();
	if($_POST['action']=='LOGIN'){
		echo $user->setLogar($_POST['login'], $_POST['senha']);
	}
}

?>