<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/view/app.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200491310052457e13365320-07065306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfafa3ca6efb29b0ca1c6c4dee563cd06dabbb6b' => 
    array (
      0 => 'class/smarty/templates/desktop/view/app.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200491310052457e13365320-07065306',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e133c1d34_84771623',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e133c1d34_84771623')) {function content_52457e133c1d34_84771623($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>
Ext.Loader.setConfig({
    enabled: true,
    paths: {
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
': 'app',
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins': 'resources/plugins'
    }
});

Ext.application({
    name: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
',
    controllers: [
		'Desktop'
		
    ],
    autoCreateViewport: false,
    winRegistered: new Ext.util.MixedCollection(),
    launch: function() {
    	var me = this;
    	Ext.create('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.Desktop');
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>			
		me.dados = key;
<?php }?>
    }

});


<?php }} ?>