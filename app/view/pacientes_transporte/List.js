/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.pacientes_transporte.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.pacientes_transportelist',
    requires: [
    	'ShSolutions.store.StorePacientes_Transporte'
    ],
	
	id: 'GridPacientes_Transporte',
    store: 'StorePacientes_Transporte',

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
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'acompanhado',
					format: '0',
					text: 'Acompanhado',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'local_consulta',
					text: 'Local Consulta',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'espera',
					text: 'Espera',					
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'hora',
					format: 'H:i:s',
					renderer : Ext.util.Format.dateRenderer('H:i:s'),
					text: 'Hora',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'fone',
					renderer : Ext.util.Format.maskRenderer('(99) 9999-9999'),
					text: 'Fone',					
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
					store: 'StorePacientes_Transporte',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_pacientes_transporte',
							iconCls: 'bt_add',							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_pacientes_transporte',
							iconCls: 'bt_edit',
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_pacientes_transporte',
							iconCls: 'bt_del',
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_pacientes_transporte',
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
