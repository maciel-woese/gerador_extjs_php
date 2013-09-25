<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/view/lista/Principal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2044156267523306341271e8-09780646%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ff32c8920abaa4f8fb8a78d5db38cbb0df77e33' => 
    array (
      0 => 'class/smarty/templates/touch/view/lista/Principal.tpl',
      1 => 1352429147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2044156267523306341271e8-09780646',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'descricao' => 0,
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5233063414fe87_38781050',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5233063414fe87_38781050')) {function content_5233063414fe87_38781050($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>
Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.Principal', {
    extend: 'Ext.dataview.List',
    alias: 'widget.containerprincipal',

    config: {
        id: 'GridPrincipal',
		store: 'StorePrincipal',
        onItemDisclosure: true,
        itemTpl: [
            '<div><?php echo $_smarty_tpl->tpl_vars['descricao']->value;?>
</div>'
        ],
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['titulo']->value);?>
'
            }
        ]
    }

});<?php }} ?>