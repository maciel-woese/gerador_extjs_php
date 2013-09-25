<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/css.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1339315752523306343878d4-04000757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '900df0f09242a0a33c9dcab6fa9f1f928e0fea7b' => 
    array (
      0 => 'class/smarty/templates/touch/css.tpl',
      1 => 1351875848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1339315752523306343878d4-04000757',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'tabelas' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_523306343df399_14840115',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523306343df399_14840115')) {function content_523306343df399_14840115($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>
@CHARSET "ISO-8859-1";

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
.acao {
	-webkit-mask-box-image: url('../images/spaces2.png') !important;
}
.x-title .x-innerhtml:after {
	content: '';
	display: inline-block;
	width: .3em;
}

.principal{
	background: url('../icons/logoLogin.png') center center no-repeat;
}

.ux-wallpaper { background-color: #3d71b8; }
.ux-wallpaper-tiled { background-repeat: repeat; }
.ux-desktop-shortcut { cursor: pointer;position: absolute;text-align: center;padding: 8px;margin: 8px;width: 64px;}
.ux-desktop-shortcut-icon {
	width: 48px;
	height: 48px;
	background-color: transparent;
	background-repeat: no-repeat;
	background-image: url('../images/list48x48.png');
}
.ux-desktop-shortcut-text { font: normal 10px tahoma,arial,verdana,sans-serif;text-decoration: none;padding-top: 5px;color: black;}
.x-view-over .ux-desktop-shortcut-text { text-decoration: underline;}

/*SHORTCUT*/
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabelas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
	.<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
-shortcut {
		background-image: url(../images/list48x48.png);
	}
<?php } ?>
<?php }} ?>