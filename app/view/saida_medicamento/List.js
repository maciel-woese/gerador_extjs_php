/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.saida_medicamento.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.saida_medicamentolist',
    requires: [
    	'ShSolutions.store.StoreSaida_Medicamento'
    ],
	
	id: 'GridSaida_Medicamento',
    store: 'StoreSaida_Medicamento',

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
					text: 'Usuário',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'usuario_id',
					hidden: true,
					format: '0',
					text: 'Usuário',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'paciente',
					text: 'Paciente',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'paciente_id',
					hidden: true,
					format: '0',
					text: 'Paciente',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreSaida_Medicamento',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_saida_medicamento',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_saida_medicamento',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_saida_medicamento',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_del_itens_saida_medicamento',
							iconCls: 'bt_del',
							hidden: true,
							action: 'remover_itens',
							text: 'Saida de Medicamentos'
						},
						{
							xtype: 'button',
							id: 'button_filter_saida_medicamento',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_saida_medicamento',
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
