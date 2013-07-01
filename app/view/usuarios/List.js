/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.usuarios.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuarioslist',
    requires: [
    	'ShSolutions.store.StoreUsuarios'
    ],
	
	id: 'GridUsuarios',
    store: 'StoreUsuarios',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false,
				getRowClass: function(record, rowIndex, rowParams, store){
					if(record.get('status')=='1'){
						return '';
					}
					else if(record.get('status')=='0'){
						return 'amarelo';
					}
				}
			},
			//forceFit: true,
			columns: [
				{
					xtype: 'numbercolumn',
					dataIndex: 'id',
					format: '0',
					text: 'Id',					
					flex: 1,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'nome',
					text: 'Nome',					
					flex: 1,
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'data_cadastro',
					format: 'd/m/Y',
					renderer : Ext.util.Format.dateRenderer('d/m/Y'),
					text: 'Data Cadastro',					
					flex: 1,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'email',
					text: 'Email',					
					flex: 2,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'login',
					text: 'Login',					
					flex: 1,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'grupo',
					text: 'Grupo',					
					flex: 1,
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'id_grupo',
					hidden: true,
					format: '0',
					text: 'Grupo',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'status',
					text: 'Status',					
					flex: 1,
					renderer: function(v){
						switch(v){
							case '1':
							return '<span style="color:blue;">Ativo</span>';
						  	break;
							case '0':
							return '<span style="color:red;">Desativado</span>';
						  	break;
 					
						}
					},
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'exportar',
					text: 'Exportar',					
					flex: 1,
					renderer: function(v){
						switch(v){
							case '1':
							return '<span style="color:blue;">Sim</span>';
						  	break;
							case '0':
							return '<span style="color:red;">Não</span>';
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
							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_usuarios',
							iconCls: 'bt_edit',							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_usuarios',
							iconCls: 'bt_del',							
							action: 'deletar',
							text: 'Deletar'
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
							id: 'button_sql_usuarios',
							iconCls: 'acao',
							action: 'sql',
							text: 'SQL Exec.'
						},
						{
							xtype: 'button',
							id: 'button_export_usuarios',
							iconCls: 'acao',
							action: 'export',
							text: 'Exportar S/N'
						},
						{
							xtype: 'button',
							id: 'button_status_list_usuarios',
							iconCls: 'acao',
							action: 'status',
							text: 'Ativo S/N'
						}
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
