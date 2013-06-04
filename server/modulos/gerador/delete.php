<?php
require_once('../../autoLoad.php');
require_once('../../lib/prepareDir.php');

if($_GET){
	$id = $_SESSION['id_usuario'];
	$class = new prepareDir(array('id_usuario'=> $id));
	
	if($_GET['action']=='CLEAR_MODEL'){
		$class->clearModels();
	}
	else if($_GET['action']=='PREPARE_MODEL'){
		$class->prepare();
		echo '{success: true}';
	}
}

?>