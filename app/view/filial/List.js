/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.filial.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.filiallist',
    requires: [
    	'ShSolutions.store.StoreFilial'
    ],
	
	id: 'GridFilial',
    store: 'StoreFilial',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false
			},
						
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
					dataIndex: 'filial',
					text: 'Filial',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'descricao',
					text: 'Estado',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'cidade',
					text: 'Cidade',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'bairro',
					text: 'Bairro',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'endereco',
					text: 'Endereco',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'cep',
					renderer : Ext.util.Format.maskRenderer('99.999-999'),
					text: 'Cep',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'telefone',
					renderer : Ext.util.Format.maskRenderer('(99) 9999-9999'),
					text: 'Telefone',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreFilial',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_filial',
							iconCls: 'bt_add',							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_filial',
							iconCls: 'bt_edit',
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_filial',
							iconCls: 'bt_del',
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_filial',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_filial',
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
