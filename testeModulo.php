<?php
	session_start();
	header("Location: server/modulos/gerador/zipeds/{$_SESSION['id_usuario']}/teste/");
?>