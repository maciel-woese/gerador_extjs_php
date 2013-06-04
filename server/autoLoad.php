<?php

require_once('../../lib/Connection.class.php');
require_once('../../lib/Buscar.class.php');
require_once('../../lib/Paginar.class.php');
require_once('../../lib/funcoes.php');
require_once('../../lib/Usuarios.class.php');
$user = new Usuarios();
if(!$user->isLogado()){
	die(json_encode(array('success'=> false, 'logout'=> true)));
}
$connection = new Connection;
?>
