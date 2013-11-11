<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/usuarios/storecomboSta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102450582052457e1416ecd8-31381204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61161b2b64cfdbfaa2d76dc7877890a5c672e098' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/usuarios/storecomboSta.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102450582052457e1416ecd8-31381204',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e141a3622_34969218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e141a3622_34969218')) {function content_52457e141a3622_34969218($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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