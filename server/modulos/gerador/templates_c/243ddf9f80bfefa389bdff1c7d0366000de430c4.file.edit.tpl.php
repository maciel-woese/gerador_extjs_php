<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/perfil/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42678239551d18a182880d8-83674370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '243ddf9f80bfefa389bdff1c7d0366000de430c4' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/perfil/edit.tpl',
      1 => 1351270955,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42678239551d18a182880d8-83674370',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1829b224_89341900',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1829b224_89341900')) {function content_51d18a1829b224_89341900($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.perfil.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addperfilwin',

    id: 'AddPerfilWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Perfil',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormPerfil',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/perfil/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'perfil',
							id: 'perfil_perfil',
							anchor: '100%',							
							
							fieldLabel: 'Perfil'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_perfil',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_perfil',
							value: 'INSERIR',
							anchor: '100%'
						}
                    ]
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
                            xtype: 'tbseparator'
                        },
                        {
                            xtype: 'button',
                            id: 'button_resetar_perfil',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_perfil',
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: 'Salvar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);

    }

});
<?php }} ?>