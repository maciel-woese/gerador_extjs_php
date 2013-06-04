<?php
	session_start();
	require_once("../../locale/{$_SESSION['language']}.php");
	
	if(isset($_GET['action']) and $_GET['action']=='SQL'){
		$arquivo = "zipeds/{$_SESSION['id_usuario']}/sqlUsuarios.sql";
		
		if(file_exists($arquivo)){
			header("Content-Type: application/x-sql");
			header("Content-Length: ".filesize($arquivo));
			header("Content-Disposition: attachment; filename=".basename($arquivo));
			readfile($arquivo);
		}
		else{
			echo NO_EXIST_FILE;
		}
	}
	else if(isset($_GET['action']) and $_GET['action']=='EXPORT_GET'){
		if(isset($_SESSION['exportar_usuario']) and $_SESSION['exportar_usuario']==true){
			$arquivo = $_GET['nome_projeto'];
			
			if(file_exists($arquivo)){
				header("Content-Type: application/x-sql");
				header("Content-Length: ".filesize($arquivo));
				header("Content-Disposition: attachment; filename=".basename($arquivo));
				readfile($arquivo);
			}
			else{
				echo NO_EXIST_FILE;
			}
		}
		else{
			
		}
	}
	else if(isset($_SESSION['exportar_usuario']) and $_SESSION['exportar_usuario']==true){
		if(file_exists($_SESSION['project_zip'])){
			header("Content-Type: application/zip");
			header("Content-Length: ".filesize($_SESSION['project_zip']));
			header("Content-Disposition: attachment; filename=".basename($_SESSION['project_zip']));
			readfile($_SESSION['project_zip']);
		}
		else{
			echo NO_EXIST_FILE;
		}
	}
?>