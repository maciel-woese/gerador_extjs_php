/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.entrada_produtos.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.entrada_produtoslist',
    requires: [
    	'ShSolutions.store.StoreEntrada_Produtos'
    ],
	
	id: 'GridEntrada_Produtos',
	store: 'StoreEntrada_Produtos',

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
					dataIndex: 'nota',
					text: 'Nota',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'entrada_id',
					hidden: true,
					format: '0',
					text: 'Entrada Id',					
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
				/*{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreEntrada_Produtos',
					dock: 'bottom'
				},*/
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_entrada_produtos',
							iconCls: 'bt_add',							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_entrada_produtos',
							iconCls: 'bt_edit',
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_entrada_produtos',
							iconCls: 'bt_del',
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_entrada_produtos',
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
