<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:54
         compiled from "class/smarty/templates/touch/store/store.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20512785852330632cde192-67068256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57c3034ca91fa7b845dc8c89146907e35534566f' => 
    array (
      0 => 'class/smarty/templates/touch/store/store.tpl',
      1 => 1352823052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20512785852330632cde192-67068256',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
    'CHAVE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52330632da1d61_85273149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52330632da1d61_85273149')) {function content_52330632da1d61_85273149($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', {
    extend: 'Ext.data.Store',
    alias: 'store.store<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',

    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.Model<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
'
    ],

    config: {
        model: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.Model<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
        storeId: 'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
		sorters: [
			{
				direction: 'ASC',
				property: '<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
'
			}
		],
        proxy: {
            type: 'ajax',
			url: 'server/modulos/<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
/list.php',
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
});
<?php }} ?>