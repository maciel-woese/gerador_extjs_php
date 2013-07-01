<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/store/TreeStoreMenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:107937188651d18a18009281-83846190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfbaae401aedbd7c89bb8c2ea31ac1c440214c5a' => 
    array (
      0 => 'class/smarty/templates/padrao/store/TreeStoreMenu.tpl',
      1 => 1351537320,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107937188651d18a18009281-83846190',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a180198b9_52206357',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a180198b9_52206357')) {function content_51d18a180198b9_52206357($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.TreeStoreMenu', {
    extend: 'Ext.data.TreeStore',
    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelMenu'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'TreeStoreMenu',
            model: 'TreeStoreMenu.model.ModelMenu',
            proxy: {
                type: 'ajax',
                url: 'server/modulos/menu.php',
                reader: {
                    type: 'json'
                }
            }
        }, cfg)]);
    }
});
<?php }} ?>