<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");

	$versao = '{$versao}';
	$build  = '(build {$data})';
	$sistema = "{$titulo|capitalize}";
{if $permissoes=='sim'}	
	if(!isset($_SESSION['SESSION_USUARIO'])){
		header("Location: login.php");
	}
	else{
		$model = json_encode(unserialize($_SESSION['MODEL_PERMISSOES']));
	}
{/if}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo "$sistema $versao $build"; ?></title>
    <link rel="stylesheet" type="text/css" href="ext/resources/css/ext-all.css"/>
    <link rel="stylesheet" type="text/css" href="resources/css/style.css"/>
</head>
<body>
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div id='loading-indicator' class="loading-indicator">
			<img src="resources/images/loading.gif" style="margin-right:8px;float:left;vertical-align:top;"/>
			<div id="txt-indicator" style=" padding-top:30px;">
				<?php echo "$sistema $versao $build"; ?><br>
				<span id="loading-msg">{$loading_msg_style}</span>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		document.getElementById('loading-msg').innerHTML = '{$loading_msg_framework}';
		var NameApp = '{$app|capitalize}';
		var TITULO_SYSTEM = '<?php echo $sistema?>';
{if $permissoes=='sim'}
		var key = <?=$model?>;
{/if}
	</script>
	<script type="text/javascript" src="ext/ext-all.js"></script>
	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '{$loading_msg_tradutor}';</script>
{if $locale == 'br'}
	<script type="text/javascript" src="ext/locale/ext-lang-pt_BR.js"></script>
{/if}
	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '{$loading_msg_plugins}';</script>
	<script type="text/javascript" src="resources/plugins/Notification.js"></script>
	<script type="text/javascript" src="resources/plugins/TabCloseMenu.js"></script>
	<script type="text/javascript" src="resources/plugins/TextMask.js"></script>
	<script type="text/javascript" src="resources/plugins/functions.js"></script>

	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '{$loading_msg_modulos}';</script>
    <script type="text/javascript" src='app.js'></script>
</body>
</html>
