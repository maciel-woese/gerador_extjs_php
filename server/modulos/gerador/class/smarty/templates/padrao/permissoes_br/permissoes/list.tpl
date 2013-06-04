<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

	require('../../autoLoad.php');
	require('../../lib/Permissoes.class.php');
	$p = new Permissoes();
	if($_POST){
		if(isset($_POST['action']) and $_POST['action']=='USUARIO'){
			echo $p->getTreeUsuario($_POST['perfil_id'], $_POST['usuario_id']);
		}
		else if(isset($_POST['action']) and $_POST['action']=='PERFIL'){
			echo $p->getTreePerfil($_POST['perfil_id']);
		}	
	}
?>