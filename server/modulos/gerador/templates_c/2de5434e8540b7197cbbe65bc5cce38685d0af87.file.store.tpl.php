<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/permissoes/store.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167006994451d18a185d65f8-59165588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2de5434e8540b7197cbbe65bc5cce38685d0af87' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/permissoes/store.tpl',
      1 => 1351271562,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167006994451d18a185d65f8-59165588',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a185f0090_61569899',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a185f0090_61569899')) {function content_51d18a185f0090_61569899($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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