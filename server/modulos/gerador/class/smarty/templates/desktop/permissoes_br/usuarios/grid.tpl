{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.view.usuarios.List', {
    extend: '{$app|capitalize}.view.WindowBig',
	alias: 'widget.usuarioslist',
    requires: [
    	'{$app|capitalize}.store.StoreUsuarios'
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


