/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.entrada_medicamento.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.entrada_medicamentolist',
    requires: [
    	'ShSolutions.store.StoreEntrada_Medicamento'
    ],
	
	id: 'GridEntrada_Medicamento',
    store: 'StoreEntrada_Medicamento',

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
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'fornecedor_id',
					hidden: true,
					format: '0',
					text: 'Fornecedor',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'nota',
					text: 'Nota',					
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'data_cadastro',
					format: 'd/m/Y H:i:s',
					renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
					text: 'Data Cadastro',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'nome',
					text: 'Usuario',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'usuario_id',
					hidden: true,
					format: '0',
					text: 'Usuario',					
					width: 140
				}
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreEntrada_Medicamento',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_entrada_medicamento',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_entrada_medicamento',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_entrada_medicamento',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_add_itens_entrada_medicamento',
							iconCls: 'bt_add',
							hidden: true,
							action: 'adicionar_itens',
							text: 'Entrada de Medicamentos'
						},
						{
							xtype: 'button',
							id: 'button_filter_entrada_medicamento',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_entrada_medicamento',
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
