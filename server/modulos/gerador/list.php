<?php
if($_POST){
	require_once('../../autoLoad.php');
	extract($_POST);
	
	if(isset($_SESSION['CLASS_SERVER'])){
		require_once($_SESSION['CLASS_SERVER']);
	}
	else{
		die(json_encode(array('success'=>false,'msg'=>ERRO_CLASS_LOAD)));
	}
	
	if(isset($_POST['action']) and $_POST['action']=='LIST_COLUMNS'){
		$z = new banco($_SESSION['HOST_SERVER'], $_SESSION['USER_SERVER'], $_SESSION['PASS_SERVER'], $_SESSION['DATABASE_SERVER']);
		echo $z->getGridDados();
	}
	else if($_POST['action']=='JSON_GRID_CRUD'){
		$json = '{"dados": ['.$_POST['json'].']}';
		$foreign = '{"dados": ['.$_POST['foreign'].']}';
	
		$arq = fopen('bkps/'.$_SESSION['HOST_SERVER'].'-'.$_SESSION['USER_SERVER'].'-'.$_SESSION['DATABASE_SERVER'].'-backupJson.json',"w");
		fwrite($arq, $json);
		fclose($arq);
		
		$z = new banco($_SESSION['HOST_SERVER'], $_SESSION['USER_SERVER'], $_SESSION['PASS_SERVER'], $_SESSION['DATABASE_SERVER']);
		
		$_SESSION['tipo_layout'] = $_POST['tipo'];
		if($_POST['tipo']=='touch'){
			$_SESSION['touch_tela'] = $_POST['touch_tela'];
		}
		else{
			unset($_SESSION['touch_tela']);
		}
		
		require_once('class/gerarCrud.php');
		$tabelas = isset($_POST['tabelas']) ? $_POST['tabelas'] : '';
		$x = new ExtMVC(array(
				'autor'   		=> $_POST['autor'],
				'app'     		=> $_POST['class'],
				'tipo'    		=> $_POST['tipo'],
				'titulo'  		=> $_POST['titulo'],
				'pdf'			=> $tabelas,
				'permissoes'	=> $_POST['permissoes_usuarios'],
				'tipo_banco' 	=> $_SESSION['CLASS'],
				'host' 			=> $_SESSION['HOST_SERVER'],
				'user' 			=> $_SESSION['USER_SERVER'],
				'banco' 		=> $_SESSION['DATABASE_SERVER'],
				'senha' 		=> $_SESSION['PASS_SERVER'],
				'versao'  		=> $_POST['version']
		));
		
		$jsons = $z->createCrudSystem($json, $foreign);
		
		if($jsons){
			$p=0;
			for($i=0;$i<count($jsons);$i++){
				if(!$x->init($jsons[$i])){
					$p++;
				}
			}
			
			$x->app->createAplication();
			
			if($p==0){
				require_once("../../lib/zip.lib.php");
				$nome_project = md5(date(time()));
				
				if(!file_exists("zipeds/{$_SESSION['id_usuario']}")){
					mkdir("zipeds/{$_SESSION['id_usuario']}");
				}
				
				$archive = new PclZip("zipeds/{$_SESSION['id_usuario']}/{$nome_project}.zip");
				$list = $archive->add($_SESSION['caminho_project']);
				
				$_SESSION['project_zip'] = "zipeds/{$_SESSION['id_usuario']}/{$nome_project}.zip";
				
				if ($list == 0) {
					die(json_encode(array('success'=> false, 'msg'=> ERROR_ZIP_FILE)));
				}
				
				$pdo = $connection->prepare("
					INSERT INTO generated 
						(project, project_zip, data, versao, ip, layout, server, usuario_id)
					 VALUES 
						(?, ?, NOW(), ?, ?, ?, 'php', ?)		
				");
				
				$pdo->execute(array(
					$_POST['titulo'],
					$_SESSION['project_zip'],
					$_POST['version'],
					getIp(),
					$_POST['tipo'],
					$_SESSION['id_usuario']
				));
				
				if($_POST['permissoes_usuarios']=='sim'){
					@copy("class/generated/{$_SESSION['id_usuario']}/{$_SESSION['tipo_layout']}/sqlUsuarios.sql", "zipeds/{$_SESSION['id_usuario']}/sqlUsuarios.sql");
				}
				
				$_SESSION['TESTE'] = true;
				$_SESSION['CLEAR_LAYOUT'] = $_SESSION['tipo_layout'];
				
				echo json_encode(array('success'=> true, 'msg'=> utf8_encode(APP_GERADA)));
			}
			else echo json_encode(array('success'=> false, 'msg'=> utf8_encode(ERRO_GERAR_APP)));
		}
		else{
			echo json_encode(array('success'=> false, 'msg'=> ERROR_INTERNO));
		}
	}	
}
?>