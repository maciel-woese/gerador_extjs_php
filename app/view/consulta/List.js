/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.consulta.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.consultalist',
    requires: [
    	'ShSolutions.store.StoreConsulta'
    ],
	
	id: 'GridConsulta',
    store: 'StoreConsulta',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false,
				getRowClass: function(record, rowIndex, rowParams, store){
					if(record.get('faltou')=='N'){
						return '';
					}
					else if(record.get('faltou')=='S'){
						return 'amarelo';
					}
				}
			},
			features: [
				{
					ftype: 'grouping',
					groupHeaderTpl: '{columnName}: {name} ({rows.length} Consulta{[values.rows.length > 1 ? "s" : ""]})',
					hideGroupedHeader: true
				}
			],
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
					dataIndex: 'data_hora_date',
					format: 'd/m/Y',
					renderer : Ext.util.Format.dateRenderer('d/m/Y'),
					text: 'Data da Consulta',
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'data_hora',
					format: 'd/m/Y H:i:s',
					renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
					text: 'Data Hora',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'medico',
					text: 'Medico',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'medico_id',
					hidden: true,
					format: '0',
					text: 'Medico',					
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
					dataIndex: 'senha',
					format: '0',
					text: 'Senha',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'faltou',
					text: 'Faltou',					
					renderer: function(v){
						switch(v){
							case 'S':
							return 'Sim';
						  	break;
							case 'N':
							return 'Não';
						  	break;
 					
						}
					},					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'queixa_principal',
					text: 'Queixa Principal',					
					width: 180
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'exame_fisico',
					text: 'Exame Fisico',					
					width: 180
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'hipotese_diagnostica',
					text: 'Hipotese Diagnostica',					
					width: 180
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'tratamento',
					text: 'Tratamento',					
					width: 180
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreConsulta',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_consulta',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_consulta',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_consulta',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_dias_consulta',
							iconCls: 'acao',
							enableToggle: true,
							action: 'filtrar_apenas_dia',
							text: 'Consultas do Dia'
						},
						{
							xtype: 'button',
							id: 'button_baixa_consulta',
							iconCls: 'bt_edit',
							hidden: true,
							action: 'baixa_consulta',
							text: 'Baixa Consulta'
						},
						{
							xtype: 'button',
							id: 'button_filter_consulta',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_consulta',
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
