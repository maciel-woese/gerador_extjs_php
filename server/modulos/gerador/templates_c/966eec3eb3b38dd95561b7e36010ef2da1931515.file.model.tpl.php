<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:55
         compiled from "class/smarty/templates/touch/model/model.tpl" */ ?>
<?php /*%%SmartyHeaderCode:409728708523306333ea7e6-08287442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '966eec3eb3b38dd95561b7e36010ef2da1931515' => 
    array (
      0 => 'class/smarty/templates/touch/model/model.tpl',
      1 => 1351780439,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '409728708523306333ea7e6-08287442',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
    'fields' => 0,
    'field' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5233063353a145_81865334',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5233063353a145_81865334')) {function content_5233063353a145_81865334($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.Model<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['index']++;
?>
			{
				name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',<?php if ($_smarty_tpl->tpl_vars['field']->value['type']=='date'){?>
				
				dateFormat: '<?php echo $_smarty_tpl->tpl_vars['field']->value['format'];?>
',<?php }else{ ?>
				<?php }?><?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='H:i:s'){?>				
				type: 'string'
<?php }?><?php if ($_smarty_tpl->tpl_vars['field']->value['format']!='H:i:s'){?>				
				type: '<?php echo $_smarty_tpl->tpl_vars['field']->value['type'];?>
'
<?php }?>
			}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['total'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']!=$_tmp1-1){?>,<?php }?>
				
<?php } ?>
    	],
		
		validations: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form']['index']++;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']!=''){?><?php if ($_smarty_tpl->tpl_vars['field']->value['required']==true&&$_smarty_tpl->tpl_vars['field']->value['validate']=='email'){?>
			{
                type: 'email',
                field: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
				message: 'E-mail Inválido.'
            },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']==true){?>
			{
				type: 'presence',
				field: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
				message: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
 &eacute; Obrigat&oacute;rio.'
			}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['form']['total'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form']['index']!=$_tmp2-1){?>,<?php }?>
<?php }?>

<?php }?>
<?php } ?>
		]
    }	
});<?php }} ?>