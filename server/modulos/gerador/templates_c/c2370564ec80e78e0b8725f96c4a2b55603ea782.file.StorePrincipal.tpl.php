<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/store/StorePrincipal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79186031252330634154fc3-95749913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2370564ec80e78e0b8725f96c4a2b55603ea782' => 
    array (
      0 => 'class/smarty/templates/touch/store/StorePrincipal.tpl',
      1 => 1350351767,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79186031252330634154fc3-95749913',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52330634188ea4_60452156',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52330634188ea4_60452156')) {function content_52330634188ea4_60452156($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>
Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StorePrincipal', {
    extend: 'Ext.data.Store',
    alias: 'store.storeprincipal',

    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPrincipal'
    ],

    config: {
        model: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPrincipal',
        storeId: 'StorePrincipal',
        proxy: {
            type: 'ajax',
			url: 'server/modulos/menu.php',
			extraParams: {
                action: 'LIST'
            },
            actionMethods: {
		        create : 'POST',
		        read   : 'POST',
		        update : 'POST',
		        destroy: 'POST'
		    },
            reader: {
                type: 'json',
                rootProperty: 'dados'
            }
        }
    }
});<?php }} ?>