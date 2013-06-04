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
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><? echo "$sistema $versao $build"; ?></title>
    <link rel="stylesheet" href="touch/resources/css/sencha-touch.css">
	<link rel="stylesheet" href="resources/css/style.css">
	<script src="touch/sencha-touch-all.js"></script>
	<script type="text/javascript">
        if (!Ext.browser.is.WebKit) {
            alert("Navegador incompativel!.\n\nNavegadores Compativeis:\n" +
                "Google Chrome\n" +
                "Apple Safari\n" +
                "Mobile Safari (iOS)\n" +
                "Android Browser\n" +
                "BlackBerry Browser"
            );
        }
{if $permissoes=='sim'}
		var key = <?=$model?>;
{/if}		
    </script>
    <script type="text/javascript" src="resources/plugins/function.js"></script>
    <script type="text/javascript" src='app.js'></script>
</head>
<body>
<div id="appLoadingIndicator">
	<div></div>
	<div></div>
	<div></div>
</div>
</body>
</html>
