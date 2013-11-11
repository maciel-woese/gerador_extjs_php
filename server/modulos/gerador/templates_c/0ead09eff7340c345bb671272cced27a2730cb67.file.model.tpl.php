<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/permissoes/model.tpl" */ ?>
<?php /*%%SmartyHeaderCode:99010102952457e142ece38-42534504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ead09eff7340c345bb671272cced27a2730cb67' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/permissoes/model.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99010102952457e142ece38-42534504',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14312683_46193454',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14312683_46193454')) {function content_52457e14312683_46193454($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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