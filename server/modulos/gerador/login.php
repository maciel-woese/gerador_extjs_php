<?php
if($_POST){
	try {
		require_once('../../autoLoad.php');
		if(isset($_POST['action']) and $_POST['action']=='LOGIN_BANCO'){
			if($_POST['tipo']=='pgsql'){
				$_SESSION['CLASS'] = 'pgsql';
				$_SESSION['CLASS_SERVER'] = 'banco/pgsql.php';
			}
			else if($_POST['tipo']=='mysql'){
				$_SESSION['CLASS'] = 'mysql';
				$_SESSION['CLASS_SERVER'] = 'banco/mysql.php';
			}
			
			require_once($_SESSION['CLASS_SERVER']);
			
			$_SESSION['HOST_SERVER'] = $_POST['servidor'];
			$_SESSION['USER_SERVER'] = $_POST['usuario'];
			$_SESSION['PASS_SERVER'] = $_POST['senha'];
			$_SESSION['DATABASE_SERVER'] = $_POST['banco'];
			$_SESSION['SCHEMA_SERVER'] = isset($_POST['schema']) ? $_POST['schema'] : '';
			$z = new banco($_SESSION['HOST_SERVER'], $_SESSION['USER_SERVER'], $_SESSION['PASS_SERVER'], $_SESSION['DATABASE_SERVER']);
			if($z){
				echo '{success: true}';
			}
			exit();
		}
	}
	catch (PDOException $e) {
		echo json_encode(array(
			'success'=>true, 
			'msg'=>$e->getMessage()
		));
	}
}
?>