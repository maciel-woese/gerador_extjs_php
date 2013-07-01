<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");

	$versao = '1.0.1';
	$build  = '(build 20121023)';
	$sistema = "Padrão";
	
	if(!isset($_SESSION['SESSION_USUARIO'])){
		header("Location: login.php");
	}
	else{
		$model = json_encode(unserialize($_SESSION['MODEL_PERMISSOES']));
	}
	
?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><? echo "$sistema $versao $build"; ?></title>
    <script src="touch/sencha-touch-all.js"></script>
    <link rel="stylesheet" href="touch/resources/css/sencha-touch.css">
	<style type="text/css">
         /**
         * Example of an initial loading indicator.
         * It is recommended to keep this as minimal as possible to provide instant feedback
         * while other resources are still being loaded for the first time
         */
        html, body {
            height: 100%;
            background-color: #1985D0
        }

        #appLoadingIndicator {
            position: absolute;
            top: 50%;
            margin-top: -15px;
            text-align: center;
            width: 100%;
            height: 30px;
            -webkit-animation-name: appLoadingIndicator;
            -webkit-animation-duration: 0.5s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-direction: linear;
        }

        #appLoadingIndicator > * {
            background-color: #FFFFFF;
            display: inline-block;
            height: 30px;
            -webkit-border-radius: 15px;
            margin: 0 5px;
            width: 30px;
            opacity: 0.8;
        }

        @-webkit-keyframes appLoadingIndicator{
            0% {
                opacity: 0.8
            }
            50% {
                opacity: 0
            }
            100% {
                opacity: 0.8
            }
        }
		.gridlist{
			font-size: 14px!important;
		}
		.x-title .x-innerhtml:after {
			content: '';
			display: inline-block;
			width: .3em;
		}
	</style>
    <script type="text/javascript" src="resources/plugins/function.js"></script>
    <script type="text/javascript" src='app.js?key=<?=$model?>'></script>
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
</head>
<body>
<div id="appLoadingIndicator">
	<div></div>
	<div></div>
	<div></div>
</div>
</body>
</html>
