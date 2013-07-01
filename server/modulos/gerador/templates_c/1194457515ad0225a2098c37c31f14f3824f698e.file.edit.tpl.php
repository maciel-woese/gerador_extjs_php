<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/permissoes/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:109169167951d18a185adf46-22008219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1194457515ad0225a2098c37c31f14f3824f698e' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/permissoes/edit.tpl',
      1 => 1351271479,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109169167951d18a185adf46-22008219',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a185be2b5_98114068',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a185be2b5_98114068')) {function content_51d18a185be2b5_98114068($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.permissoes.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.addpermissoeswin',

    height: 282,
    id: 'AddPermissoesWin',
    width: 301,
    layout: {
        type: 'fit'
    },
    title: 'Permissões de Módulos',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'treepanel',
                    id: 'TreePermissoes',
                    useArrows: true,
                    store: 'StorePermissoes',
                    bodyBorder: false,
					border: false,
					padding: '5 2 2 2',
                    viewConfig: {

                    }
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    items: [
                        {
                            xtype: 'tbfill'
                        },
                        {
                            xtype: 'button',
                            action: 'save',
                            iconCls: 'bt_save',
                            text: 'Salvar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});<?php }} ?>