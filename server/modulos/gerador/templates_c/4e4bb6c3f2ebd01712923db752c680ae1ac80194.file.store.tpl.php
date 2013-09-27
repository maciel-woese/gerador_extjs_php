<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/permissoes/store.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145923716052457e14316de9-27190289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e4bb6c3f2ebd01712923db752c680ae1ac80194' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/permissoes/store.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145923716052457e14316de9-27190289',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14353d73_90743625',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14353d73_90743625')) {function content_52457e14353d73_90743625($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StorePermissoes', {
    extend: 'Ext.data.TreeStore',

    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPermissoes'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StorePermissoes',
            root: {
		        text: "M&oacute;dulos",
		        expanded: true
		    },
            model: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPermissoes',
            proxy: {
                type: 'ajax',
                extraParams: {
					action: ''
				},
		    	actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },	
                url: 'server/modulos/permissoes/list.php',
                reader: {
                    type: 'json'
                }
            }
        }, cfg)]);
    }
});<?php }} ?>