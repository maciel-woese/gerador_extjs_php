<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50023487251d18a17e8fee1-00164663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10e637e862d394685f090497e5dea774be3ab534' => 
    array (
      0 => 'class/smarty/templates/padrao/index.tpl',
      1 => 1352725653,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50023487251d18a17e8fee1-00164663',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'versao' => 0,
    'data' => 0,
    'titulo' => 0,
    'permissoes' => 0,
    'loading_msg_style' => 0,
    'loading_msg_framework' => 0,
    'app' => 0,
    'loading_msg_tradutor' => 0,
    'locale' => 0,
    'loading_msg_plugins' => 0,
    'loading_msg_modulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a17ecc309_68749991',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17ecc309_68749991')) {function content_51d18a17ecc309_68749991($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><<?php ?>?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");

	$versao = '<?php echo $_smarty_tpl->tpl_vars['versao']->value;?>
';
	$build  = '(build <?php echo $_smarty_tpl->tpl_vars['data']->value;?>
)';
	$sistema = "<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['titulo']->value);?>
";
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>	
	if(!isset($_SESSION['SESSION_USUARIO'])){
		header("Location: login.php");
	}
	else{
		$model = json_encode(unserialize($_SESSION['MODEL_PERMISSOES']));
	}
<?php }?>	
?<?php ?>>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><<?php ?>? echo "$sistema $versao $build"; ?<?php ?>></title>
    <link rel="stylesheet" type="text/css" href="ext/resources/css/ext-all.css"/>
    <link rel="stylesheet" type="text/css" href="resources/css/style.css"/>
</head>
<body>
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div id='loading-indicator' class="loading-indicator">
			<img src="resources/images/loading.gif" style="margin-right:8px;float:left;vertical-align:top;"/>
			<div id="txt-indicator" style=" padding-top:30px;">
				<<?php ?>? echo "$sistema $versao $build"; ?<?php ?>><br>
				<span id="loading-msg"><?php echo $_smarty_tpl->tpl_vars['loading_msg_style']->value;?>
</span>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		document.getElementById('loading-msg').innerHTML = '<?php echo $_smarty_tpl->tpl_vars['loading_msg_framework']->value;?>
';
		var NameApp = '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
';
		var TITULO_SYSTEM = '<<?php ?>?=$sistema?<?php ?>>';
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
		var key = <<?php ?>?=$model?<?php ?>>;
<?php }?>
	</script>
	<script type="text/javascript" src="ext/ext-all.js"></script>
	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?php echo $_smarty_tpl->tpl_vars['loading_msg_tradutor']->value;?>
';</script>
<?php if ($_smarty_tpl->tpl_vars['locale']->value=='br'){?>
	<script type="text/javascript" src="ext/locale/ext-lang-pt_BR.js"></script>
<?php }?>
	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?php echo $_smarty_tpl->tpl_vars['loading_msg_plugins']->value;?>
';</script>
	<script type="text/javascript" src="resources/plugins/Notification.js"></script>
	<script type="text/javascript" src="resources/plugins/TabCloseMenu.js"></script>
	<script type="text/javascript" src="resources/plugins/TextMask.js"></script>
	<script type="text/javascript" src="resources/plugins/functions.js"></script>

	<script type="text/javascript">document.getElementById('loading-msg').innerHTML = '<?php echo $_smarty_tpl->tpl_vars['loading_msg_modulos']->value;?>
';</script>
    <script type="text/javascript" src='app.js'></script>
</body>
</html>
<?php }} ?>