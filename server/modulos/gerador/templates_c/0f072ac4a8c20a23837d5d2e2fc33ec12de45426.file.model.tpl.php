<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/permissoes/model.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188034537351d18a185c1a50-37075102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f072ac4a8c20a23837d5d2e2fc33ec12de45426' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/permissoes/model.tpl',
      1 => 1351271524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188034537351d18a185c1a50-37075102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a185d05e6_54605621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a185d05e6_54605621')) {function content_51d18a185d05e6_54605621($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPermissoes', {
    extend: 'Ext.data.Model',
    alias: 'model.permissoes',

    fields: [
        {
            name: 'modulo'
        },
        {
            name: 'leaf',
            type: 'boolean'
        },
        {
            name: 'text'
        },
        {
            name: 'acao_id',
            type: 'int'
        },
        {
            name: 'acao'
        },
        {
        	name: 'is_perfil',
        	type: 'boolean'
        },
        {
            name: 'checked',
            type: 'boolean'
        },
        {
            name: 'init_checked',
            type: 'boolean'
        }
    ]
});<?php }} ?>