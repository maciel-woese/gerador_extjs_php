<?php
require_once('../../autoLoad.php');
require_once('../../lib/prepareDir.php');

try{
	if(isset($_SESSION['TESTE'])){
		$id = $_SESSION['id_usuario'];
		$class = new prepareDir(array('id_usuario'=> $id));
		
		@$class->remove("zipeds/{$_SESSION['id_usuario']}/teste/", true);
		$class->copyModel("class/generated/{$_SESSION['id_usuario']}/{$_SESSION['tipo_layout']}/", "zipeds/{$_SESSION['id_usuario']}/teste/");
		if($_SESSION['tipo_layout']=='touch'){
			@$class->copyModel("class/sencha_libs/sencha_touch/", "zipeds/{$_SESSION['id_usuario']}/teste/touch/");
		}
		else{
			@$class->copyModel("class/sencha_libs/extjs/", "zipeds/{$_SESSION['id_usuario']}/teste/ext/");
		}
		
		unset($_SESSION['TESTE']);
	}
	echo '{success: true}';
}
catch(Exception $e){
	echo '{success: false}';
}
?>