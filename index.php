<?php
	//session_start();
	//header("Content-Type: text/html; charset=utf-8");
	$sistema = "Framework ShSolutions";
	$versao = "2.3.2";

	require_once('server/lib/Connection.class.php');
	require_once('server/lib/Usuarios.class.php');
	$usuarios = new Usuarios();

	if($usuarios->isLogado() === false){
		header('location: login.php');
		exit;
	}
	else{
		if(!isset($_SESSION['language'])){
			$_SESSION['language'] = 'br';
		}
		require_once("server/locale/{$_SESSION['language']}.php");
	}

	if (!is_writable('./') and !@chmod('./', 0777)){
		die(json_encode(array('success' => false, 'msg'=> PLEASE_PERMISSION)));
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo "{$sistema} {$versao}"; ?></title>
	<noscript>
	  <meta http-equiv="Refresh" content="1; url=javascript.html">
	</noscript>
    <link rel="stylesheet" href="extjs/resources/css/ext-all.css">
	<link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div class="loading-indicator">
			<img src="resources/images/loading.gif" style="margin-right:8px;float:left;vertical-align:top;"/>
			<div id="txt-indicator" style=" padding-top:30px;">
				<? echo "{$sistema} {$versao}"; ?><br>
				<span id="loading-msg"><?=LOAD_STYLES?></span>
			</div>
		</div>
	</div>
	<div style="display:none!important;">
		<iframe width="1" height="1" id="removeOlds" name="removeOlds" src="server/modulos/gerador/delete.php?action=PREPARE_MODEL"></iframe>
	</div>
</body>

<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?=LOAD_FRAMEWORK?>';</script>

<script src="extjs/ext-all.js"></script>
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?=LOAD_TRADUTOR?>';</script>
<script type="text/javascript" src="extjs/locale/ext-lang-<?=$_SESSION['language']?>.js"></script>
<script type="text/javascript" src="app/locale/ext-lang-<?=$_SESSION['language']?>.js"></script>
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?=LOAD_PLUGIN?>';</script>
<script type="text/javascript" src="resources/plugins/Notification.js"></script>
<script type="text/javascript" src="resources/plugins/TabCloseMenu.js"></script>
<script type="text/javascript" src="resources/plugins/TextMask.js"></script>
<script type="text/javascript" src="resources/plugins/Shortcut.js"></script>
<script type="text/javascript" src="resources/plugins/functions.js"></script>
<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?=LOAD_MODULES?>';</script>

<script type="text/javascript" src="app.js?key=<?=$_SESSION['tipo_usuario']?>&exportar=<?=$_SESSION['exportar_user']?>&id_grupo=<?=$_SESSION['id_grupo_usuario']?>"></script>
</html>