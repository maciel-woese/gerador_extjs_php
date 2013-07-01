<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/usuarios/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66556902451d18a183b1e09-10199473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'afe60d3b25141d0dcfe35cf70321f5e92048c1af' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/usuarios/grid.tpl',
      1 => 1353509475,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66556902451d18a183b1e09-10199473',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a183d6db5_10061719',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a183d6db5_10061719')) {function content_51d18a183d6db5_10061719($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.usuarios.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuarioslist',
    requires: [
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StoreUsuarios'
    ],
	
	id: 'GridUsuarios',
    store: 'StoreUsuarios',

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
					dataIndex: 'nome',
					text: 'Nome',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'perfil',
					text: 'Perfil',
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'perfil_id',
					hidden: true,
					format: '0',
					text: 'Perfil',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'email',
					text: 'Email',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'login',
					text: 'Login',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'administrador',
					text: 'Administrador',
					renderer: function(v){
						switch(v){
							case '1':
							return 'Sim';
						  	break;
							case '2':
							return 'Não';
						  	break;
 					
						}
					},
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'status',
					text: 'Status',
					renderer: function(v){
						switch(v){
							case '1':
							return 'Ativo';
						  	break;
							case '2':
							return 'Desativado';
						  	break;
 					
						}
					},
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreUsuarios',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_usuarios',
							iconCls: 'bt_add',
							hidden: true,
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_usuarios',
							iconCls: 'bt_edit',
							hidden: true,
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_usuarios',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_modulos_usuarios',
							iconCls: 'modulo',
							hidden: true,
							action: 'modulos',
							text: 'Add/Rem. M&oacute;dulos'
						},
						{
							xtype: 'button',
							id: 'button_filter_usuarios',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_usuarios',
							iconCls: 'bt_pdf',
							action: 'gerar_pdf',
							text: 'Gerar PDF'
						}
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
<?php }} ?>