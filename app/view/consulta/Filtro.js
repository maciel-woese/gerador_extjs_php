/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.consulta.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterconsultawin',

    id: 'FilterConsultaWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Consulta',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterConsulta',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'fieldcontainer',
							autoHeight: true,								    
							flex: 1,
							anchor: '100%',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'combobox',
									store: 'StoreComboMedico',
									name: 'medico_id',
									id: 'medico_id_filter_consulta',
									button_id: 'button_medico_id_filter_consulta',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Medico'
								},
								{
									xtype: 'buttonadd',
									iconCls: 'bt_cancel',
									hidden: true,
									id: 'button_medico_id_filter_consulta',
									combo_id: 'medico_id_filter_consulta',
									action: 'reset_combo'
								},
							]
						},		                        
						{
							xtype: 'fieldcontainer',
							autoHeight: true,								    								    
							flex: 1,
							anchor: '100%',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'combobox',
									store: 'StoreComboPacientes',
									name: 'paciente_id',
									id: 'paciente_id_filter_consulta',
									button_id: 'button_paciente_id_filter_consulta',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
								{
									xtype: 'buttonadd',
									iconCls: 'bt_cancel',
									hidden: true,
									id: 'button_paciente_id_filter_consulta',
									combo_id: 'paciente_id_filter_consulta',
									action: 'reset_combo'
								},
							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_consulta',
							allowBlank: false,
							value: 'FILTER',
							anchor: '100%'
						}
                    ]
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    items: [
                        {
                            xtype: 'tbfill'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_cancel',
                            action: 'resetar_filtro',
                            text: 'Resetar Filtro'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: 'Filtrar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
