/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.medicamento.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.medicamentolist',
    requires: [
    	'ShSolutions.store.StoreMedicamento'
    ],
	
	id: 'GridMedicamento',
    store: 'StoreMedicamento',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false,
				getRowClass: function(record, rowIndex, rowParams, store){
					var s = '';
					if(record.get('quantidade')<record.get('quantidade_minima')){
						s = 'red_text';
					}
					
					if(record.get('status')=='1'){
						return ' '+s;
					}
					else if(record.get('status')=='2'){
						return 'amarelo '+s;
					}
				}
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
					dataIndex: 'medicamento',
					text: 'Medicamento',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'codigo_barras',
					text: 'Codigo Barras',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'laboratorio',
					text: 'Laboratorio',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'laboratorio_id',
					hidden: true,
					format: '0',
					text: 'Laboratorio',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'quantidade',
					format: '0',
					text: 'Quantidade',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'quantidade_minima',
					format: '0',
					text: 'Qtd Minima',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'obs',
					text: 'Obs',					
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
					store: 'StoreMedicamento',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_medicamento',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_medicamento',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_medicamento',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_medicamento',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_medicamento',
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
