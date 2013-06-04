<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

	require('../../autoLoad.php');
	if(!$user->isLogado()){
		die(json_encode(array('success'=> false, 'logout'=> true)));
	}
	echo $user->getMenuInicializar();
	
?>