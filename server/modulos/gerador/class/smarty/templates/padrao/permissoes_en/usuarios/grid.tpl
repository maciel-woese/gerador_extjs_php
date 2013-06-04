/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.usuarios.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuarioslist',
    requires: [
    	'{$app|capitalize}.store.StoreUsuarios'
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
					text: 'Name',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'perfil',
					text: 'Profile',
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'perfil_id',
					hidden: true,
					format: '0',
					text: 'Profile',
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
					text: 'Password',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'administrador',
					text: 'Administrator',
					renderer: function(v){
						switch(v){
							case '1':
							return 'Yes';
						  	break;
							case '2':
							return 'No';
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
							return 'ON';
						  	break;
							case '2':
							return 'OFF';
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
							text: 'Add'
						},
						{
							xtype: 'button',
							id: 'button_edit_usuarios',
							iconCls: 'bt_edit',
							hidden: true,
							action: 'editar',
							text: 'Edit'
						},
						{
							xtype: 'button',
							id: 'button_del_usuarios',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Delete'
						},
						{
							xtype: 'button',
							id: 'button_modulos_usuarios',
							iconCls: 'modulo',
							hidden: true,
							action: 'modulos',
							text: 'Add/Rem. Modules'
						},
						{
							xtype: 'button',
							id: 'button_filter_usuarios',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filter'
						},
						{
							xtype: 'button',
							id: 'button_pdf_usuarios',
							iconCls: 'bt_pdf',
							action: 'gerar_pdf',
							text: 'Generate PDF'
						}
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
