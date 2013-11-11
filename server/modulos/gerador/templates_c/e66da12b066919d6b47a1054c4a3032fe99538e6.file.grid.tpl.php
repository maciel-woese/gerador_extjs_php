<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/usuarios/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11631670552457e13f11331-86365673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e66da12b066919d6b47a1054c4a3032fe99538e6' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/usuarios/grid.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11631670552457e13f11331-86365673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14047184_49414683',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14047184_49414683')) {function content_52457e14047184_49414683($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.usuarios.List', {
    extend: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.WindowBig',
	alias: 'widget.usuarioslist',
    requires: [
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StoreUsuarios'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'usuarios',

    id: 'List-Usuarios',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Usuarios',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridUsuarios',
    		        store: 'StoreUsuarios',
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
							dataIndex: 'senha',
							text: 'Senha',
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
    		    }
    		]
    	});

    	me.callParent(arguments);
    }
});


<?php }} ?>