<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login - Sistema</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<noscript>
  <meta http-equiv="Refresh" content="1; url=javascript.html">
</noscript>
<script src="touch/sencha-touch-all.js"></script>
<link rel="stylesheet" href="touch/resources/css/sencha-touch.css">

<script type="text/javascript" src="app/view/Login.js"></script>
<script type="text/javascript">
	Ext.Loader.setConfig({
		enabled: true
	});

	Ext.application({
		name: 'ShSolutions',
		launch: function() {
			Ext.create('ShSolutions.view.Login', {fullscreen: true});
		}
	});
</script>
</head>
<body>
</body>
</html>
