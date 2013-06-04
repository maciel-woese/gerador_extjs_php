/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.saida_produtos.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.saida_produtoslist',
    requires: [
    	'ShSolutions.store.StoreSaida_Produtos'
    ],
	
	id: 'GridSaida_Produtos',
    store: 'StoreSaida_Produtos',

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
					xtype: 'numbercolumn',
					dataIndex: 'saida_id',
					hidden: true,
					format: '0',
					text: 'Saida Id',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'medicamento',
					text: 'Medicamento',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'medicamento_id',
					hidden: true,
					format: '0',
					text: 'Medicamento',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'quantidade',
					format: '0',
					text: 'Quantidade',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreSaida_Produtos',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_saida_produtos',
							iconCls: 'bt_add',							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_saida_produtos',
							iconCls: 'bt_edit',
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_saida_produtos',
							iconCls: 'bt_del',
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_saida_produtos',
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
