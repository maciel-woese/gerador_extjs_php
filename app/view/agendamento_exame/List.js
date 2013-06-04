/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.agendamento_exame.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.agendamento_examelist',
    requires: [
    	'ShSolutions.store.StoreAgendamento_Exame'
    ],
	
	id: 'GridAgendamento_Exame',
    store: 'StoreAgendamento_Exame',

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
					dataIndex: 'data_exame',
					format: 'd/m/Y H:i:s',
					renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
					text: 'Data Exame',					
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'data_entrega',
					format: 'd/m/Y H:i:s',
					renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
					text: 'Data Entrega',					
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
					store: 'StoreAgendamento_Exame',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_agendamento_exame',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_agendamento_exame',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_agendamento_exame',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_agendamento_exame',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_agendamento_exame',
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
