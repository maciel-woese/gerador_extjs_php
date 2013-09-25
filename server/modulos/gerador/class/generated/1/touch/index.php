<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");

	$versao = '1.0.1 Beta';
	$build  = '(build 20130913)';
	$sistema = "Sh Solutions";
	
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
