<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

	require('../../autoLoad.php');
	require('../../lib/Permissoes.class.php');
	$p = new Permissoes();
	if($_POST){
		$json = stripcslashes('{ "dados": ['.$_POST['json'].'] }');
		$json = json_decode($json, true);
		
		if(isset($_POST['action']) and $_POST['action']=='USUARIO'){
			echo $p->setModulosUsuario($json, $_POST['usuario_id']);
		}
		else if(isset($_POST['action']) and $_POST['action']=='PERFIL'){
			echo $p->setModulosPerfil($json, $_POST['perfil_id']);
		}
	}
?>