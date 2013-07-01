<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/usuarios/storecomboSta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:156184246651d18a18458731-01349439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1dba0d18c523710d76a7c966d3d95f3f51ead9f6' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/usuarios/storecomboSta.tpl',
      1 => 1351271710,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156184246651d18a18458731-01349439',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1846cde9_79960463',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1846cde9_79960463')) {function content_51d18a1846cde9_79960463($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StoreComboStatusUsuarios', {
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
				{
					id: '1',
					descricao: 'Ativo'
				},				
				{
					id: '2',
					descricao: 'Desativado'
				}				
   	        	
   	        ]
        }, cfg)]);
        
    }
});
<?php }} ?>