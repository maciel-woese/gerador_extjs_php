<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204586038452330634056c64-43592173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10ad9e257d9443a3ce0b03d965ad2352f91e5e67' => 
    array (
      0 => 'class/smarty/templates/touch/index.tpl',
      1 => 1352725762,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204586038452330634056c64-43592173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'versao' => 0,
    'data' => 0,
    'titulo' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_523306340aade6_45109207',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523306340aade6_45109207')) {function content_523306340aade6_45109207($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><<?php ?>? echo "$sistema $versao $build"; ?<?php ?>></title>
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
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
		var key = <<?php ?>?=$model?<?php ?>>;
<?php }?>		
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
<?php }} ?>