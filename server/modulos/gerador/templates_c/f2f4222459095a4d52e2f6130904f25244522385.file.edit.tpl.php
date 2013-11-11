<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/permissoes/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108664899452457e142c4841-30513672%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2f4222459095a4d52e2f6130904f25244522385' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/permissoes/edit.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108664899452457e142c4841-30513672',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e142e8963_92302406',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e142e8963_92302406')) {function content_52457e142e8963_92302406($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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
    modal: true,
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