<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/model/ModelMenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166500914951d18a1801ca26-82359255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e17b48d407f3ebf4a117303235b08cfaaed4cdf1' => 
    array (
      0 => 'class/smarty/templates/padrao/model/ModelMenu.tpl',
      1 => 1347997030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166500914951d18a1801ca26-82359255',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a18029828_43488326',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a18029828_43488326')) {function content_51d18a18029828_43488326($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelMenu', {
    extend: 'Ext.data.Model',

    fields: [
        {
            name: 'leaf'
        },
        {
            name: 'text'
        },
        {
            name: 'iconCls'
        },
        {
            name: 'tipo'
        },
        {
            name: 'idtemp'
        },
        {
            name: 'tab'
        }
    ]
});

<?php }} ?>