<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/view/app.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112267724052330634467835-29514838%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2de8f70469e17d406da64f76de88e169d0e33e11' => 
    array (
      0 => 'class/smarty/templates/touch/view/app.tpl',
      1 => 1352725777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112267724052330634467835-29514838',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'controller' => 0,
    'field' => 0,
    'store_init' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5233063450b808_81336365',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5233063450b808_81336365')) {function content_5233063450b808_81336365($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.Loader.setConfig({
    enabled: true
});


Ext.application({
	icon: {
        57: 'resources/icons/icon.png',
        72: 'resources/icons/icon-72.png',
        114: 'resources/icons/icon-114.png'
    },
    dados: [],
	
    name: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
',
    controllers: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['controller']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form']['index']++;
?>
		'<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
'<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['form']['total'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form']['index']!=$_tmp1-1){?>,<?php }?>
		
<?php } ?>
    ],
	
	launch: function(){
		var me = this;
		Ext.fly('appLoadingIndicator').destroy();
		var init = Ext.create('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.Principal', {
			fullscreen: true
		});
<?php if ($_smarty_tpl->tpl_vars['store_init']->value=='lista'){?>
		init.getStore().load();
<?php }else{ ?>
		<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.app.getController('Principal').ajaxCarousel();
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
		me.dados = key;
<?php }?>
		
	}

});

<?php }} ?>