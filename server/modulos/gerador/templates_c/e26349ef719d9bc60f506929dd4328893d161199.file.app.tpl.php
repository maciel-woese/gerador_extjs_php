<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/view/app.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121772667751d18a17e53fc4-59304718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e26349ef719d9bc60f506929dd4328893d161199' => 
    array (
      0 => 'class/smarty/templates/padrao/view/app.tpl',
      1 => 1352725670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121772667751d18a17e53fc4-59304718',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'controller' => 0,
    'field' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a17e8b062_15164454',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17e8b062_15164454')) {function content_51d18a17e8b062_15164454($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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
    
    autoCreateViewport: false,
	dados: [],
	
	launch: function(){
		var me = this;
		Ext.widget('containerprincipal').show();
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>			
		me.dados = key;
<?php }?>

		Ext.get('loading').hide();
		Ext.get('loading-mask').setOpacity(0, true);
		setTimeout(function(){
			Ext.get('loading-mask').hide();
		},400);
	}

});

<?php }} ?>