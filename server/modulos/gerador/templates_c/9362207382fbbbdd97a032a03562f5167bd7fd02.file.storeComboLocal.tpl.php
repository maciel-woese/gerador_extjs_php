<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:08
         compiled from "class/smarty/templates/desktop/store/storeComboLocal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150915432152457e10629846-92871024%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9362207382fbbbdd97a032a03562f5167bd7fd02' => 
    array (
      0 => 'class/smarty/templates/desktop/store/storeComboLocal.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150915432152457e10629846-92871024',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'campo' => 0,
    'TABELA' => 0,
    'data' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e106d1d78_74995077',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e106d1d78_74995077')) {function content_52457e106d1d78_74995077($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StoreCombo<?php echo $_smarty_tpl->tpl_vars['campo']->value;?>
<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', {
    extend: 'Ext.data.Store',
    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelComboLocal'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelComboLocal',
   	        data: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']++;
?>
				{
					id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
',
					descricao: '<?php echo $_smarty_tpl->tpl_vars['field']->value['descricao'];?>
'
				}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['total'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['index']!=$_tmp1-1){?>,<?php }?>
				
<?php } ?>   	        	
   	        ]
        }, cfg)]);
        
    }
});
<?php }} ?>