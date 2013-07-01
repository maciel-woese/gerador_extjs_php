<?php
session_start();
require_once('../../lib/Connection.class.php');
require_once('../../lib/Usuarios.class.php');

$usuarios = new Usuarios();

if($usuarios->isLogado() === false){
	echo json_encode(array('success'=>false,'logout'=>true));
	exit;
}
require_once("../../locale/{$_SESSION['language']}.php");
require_once('../../lib/Paginar.class.php');
require_once('../../lib/Buscar.class.php');

$connection = new Connection;
?>
