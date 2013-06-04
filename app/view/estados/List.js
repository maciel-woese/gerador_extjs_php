/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.estados.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.estadoslist',
    requires: [
    	'ShSolutions.store.StoreEstados'
    ],
	
	id: 'GridEstados',
    store: 'StoreEstados',

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
					dataIndex: 'sigla',
					text: 'Sigla',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'descricao',
					text: 'Descrição',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreEstados',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_estados',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_estados',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_estados',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_estados',
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
