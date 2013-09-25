<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/model/ModelPrincipal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5365022115233063418dd39-57326444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2acd90d3b83d915faf7d7aa62f37a3f617d7b1b' => 
    array (
      0 => 'class/smarty/templates/touch/model/ModelPrincipal.tpl',
      1 => 1351872500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5365022115233063418dd39-57326444',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_523306341a9f85_12037395',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523306341a9f85_12037395')) {function content_523306341a9f85_12037395($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPrincipal', {
    extend: 'Ext.data.Model',
    alias: 'model.modelprincipal',
	
	config: {
	    fields: [
	        {
                name: 'modulo'
            },
            {
                name: 'descricao'
            },
            {
                name: 'action'
            },
            {
                name: 'iconCls'
            }
	    ]
    }
});

<?php }} ?>