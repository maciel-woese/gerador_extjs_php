/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.fornecedor.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.fornecedorlist',
    requires: [
    	'ShSolutions.store.StoreFornecedor'
    ],
	
	id: 'GridFornecedor',
    store: 'StoreFornecedor',

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
					dataIndex: 'fornecedor',
					text: 'Fornecedor',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreFornecedor',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_fornecedor',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_fornecedor',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_fornecedor',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_fornecedor',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_fornecedor',
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
