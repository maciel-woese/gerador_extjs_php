<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:09
         compiled from "class/smarty/templates/desktop/model/model.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136448683252457e1161d176-34591325%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9190efa95aac4fbac78966d569f3c2c9719e0544' => 
    array (
      0 => 'class/smarty/templates/desktop/model/model.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136448683252457e1161d176-34591325',
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
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e116b6e85_19424770',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e116b6e85_19424770')) {function content_52457e116b6e85_19424770($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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
			<?php }?>					 
			type: '<?php echo $_smarty_tpl->tpl_vars['field']->value['type'];?>
'
		}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['total'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']!=$_tmp1-1){?>,<?php }?>
				
<?php } ?>
    ]
});<?php }} ?>