<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");

	$versao = '1.0.2';
	$build  = '(build 20121118)';
	$sistema = "Posto De Saude";
	
	if(!isset($_SESSION['SESSION_USUARIO'])){
		header("Location: login.php");
	}
	else{
		$model = json_encode(unserialize($_SESSION['MODEL_PERMISSOES']));
		$usuario = json_encode(unserialize($_SESSION['SESSION_USUARIO']));
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><? echo "$sistema $versao $build"; ?></title>
    <link rel="stylesheet" type="text/css" href="ext/resources/css/ext-all.css"/>
    <link rel="stylesheet" type="text/css" href="resources/css/style.css"/>
</head>
<body>
	<div id="loading-mask" style=""></div>
	<div id="dataview-example" style=""></div>
	<div id="loading">
		<div id='loading-indicator' class="loading-indicator">
			<img src="resources/images/loading.gif" style="margin-right:8px;float:left;vertical-align:top;"/>
			<div id="txt-indicator" style=" padding-top:30px;">
				<? echo "$sistema $versao $build"; ?><br>
				<span id="loading-msg">Carregando Styles e Imagens, Aguarde...</span>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		document.getElementById('loading-msg').innerHTML = 'Carregando Framework, Aguarde...';
		var NameApp = 'ShSolutions';
		var TITULO_SYSTEM = '<?=$sistema?>';
		var key = <?=$model?>;
	</script>
	<script type="text/javascript" src="ext/ext-all.js"></script>
	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Carregando Tradutor, Aguarde...';</script>
	<script type="text/javascript" src="ext/locale/ext-lang-pt_BR.js"></script>
	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = 'Carregando Plugins, Aguarde...';</script>
	<script type="text/javascript" src="resources/plugins/Notification.js"></script>
	<script type="text/javascript" src="resources/plugins/TabCloseMenu.js"></script>
	<script type="text/javascript" src="resources/plugins/TextMask.js"></script>
	<script type="text/javascript" src='resources/plugins/functions.js?response=<?=$usuario?>'></script>
	
	<script type="text/javascript">
		var responseUsuario = Ext.decode(decodeURIComponent(getParams('functions.js').response));
		document.getElementById('loading-msg').innerHTML = 'Carregando M&oacute;dulos, Aguarde...';
	</script>
    <script type="text/javascript" src='app.js'></script>
</body>
</html>
