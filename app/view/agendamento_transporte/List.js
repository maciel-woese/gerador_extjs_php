/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.agendamento_transporte.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.agendamento_transportelist',
    requires: [
    	'ShSolutions.store.StoreAgendamento_Transporte'
    ],
	
	id: 'GridAgendamento_Transporte',
    store: 'StoreAgendamento_Transporte',

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
					dataIndex: 'data',
					format: 'd/m/Y',
					renderer : Ext.util.Format.dateRenderer('d/m/Y'),
					text: 'Data',					
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'hora_saida',
					format: 'H:i:s',
					renderer : Ext.util.Format.dateRenderer('H:i:s'),
					text: 'Hora Saida',					
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
					dataIndex: 'veiculo',
					text: 'Veiculo',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'veiculo_id',
					hidden: true,
					format: '0',
					text: 'Veiculo',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'destino',
					text: 'Destino',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'obs',
					text: 'Obs',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreAgendamento_Transporte',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_agendamento_transporte',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_agendamento_transporte',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_agendamento_transporte',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_add_pacientes_agendamento_transporte',
							iconCls: 'bt_add',
							hidden: true,
							action: 'add_pacientes',
							text: 'Adicionar Pacientes'
						},
						{
							xtype: 'button',
							id: 'button_filter_agendamento_transporte',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_agendamento_transporte',
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
