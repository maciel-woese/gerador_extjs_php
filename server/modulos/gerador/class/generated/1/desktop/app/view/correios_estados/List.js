/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_estados.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.correios_estadoslist',
    requires: [
    	'ShSolutions.store.StoreCorreios_Estados'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'correios_estados',

    id: 'List-Correios_Estados',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Correios_Estados',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridCorreios_Estados',
    		        store: 'StoreCorreios_Estados',
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
							dataIndex: 'uf',
							text: 'Uf',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'descricao',
							text: 'Descricao',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'ativo',
							text: 'Ativo',					
							width: 140
						},
						{
							xtype: 'numbercolumn',
							dataIndex: 'cadastrado_por',
							format: '0',
							text: 'Cadastrado Por',					
							width: 140
						},
						{
							xtype: 'datecolumn',
							dataIndex: 'data_cadastro',
							format: 'd/m/Y H:i:s',
							renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
							text: 'Data Cadastro',					
							width: 140
						}
                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StoreCorreios_Estados',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_correios_estados',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_correios_estados',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_correios_estados',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_correios_estados',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
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


