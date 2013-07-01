<?php
	session_start();
	$arquivo = "info_{$_SESSION['language']}.doc";
	if(file_exists($arquivo)){
		header("Content-Type: application/vnd.ms-word");
		header("Content-Length: ".filesize($arquivo));
		header("Content-Disposition: attachment; filename=".basename($arquivo));
		readfile($arquivo);
	}
	else{
		"Error!";
	}
?>