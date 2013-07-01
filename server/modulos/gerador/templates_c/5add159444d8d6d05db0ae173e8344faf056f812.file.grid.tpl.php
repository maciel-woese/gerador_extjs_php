<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/perfil/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104965883151d18a1829dfd1-75197350%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5add159444d8d6d05db0ae173e8344faf056f812' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/perfil/grid.tpl',
      1 => 1353509599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104965883151d18a1829dfd1-75197350',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a182b4e13_36006855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a182b4e13_36006855')) {function content_51d18a182b4e13_36006855($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.perfil.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.perfillist',
    requires: [
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StorePerfil'
    ],
	
	id: 'GridPerfil',
    store: 'StorePerfil',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false
			},
			forceFit: true,			
			columns: [
				{
					xtype: 'numbercolumn',
					dataIndex: 'id',
					hidden: true,
					format: '0',
					text: 'Id',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'perfil',
					text: 'Perfil',
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StorePerfil',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_perfil',
							iconCls: 'bt_add',
							hidden: true,
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_perfil',
							iconCls: 'bt_edit',
							hidden: true,
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_perfil',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_modulos_perfil',
							iconCls: 'modulo',
							hidden: true,
							action: 'modulos',
							text: 'Add/Rem. M&oacute;dulos'
						},
						{
							xtype: 'button',
							id: 'button_filter_perfil',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						}					
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
<?php }} ?>