/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.pacientes_transporte.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterpacientes_transportewin',

    id: 'FilterPacientes_TransporteWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Pacientes Transporte',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterPacientes_Transporte',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
                            xtype: 'fieldcontainer',
                            autoHeight: true,
                            layout: {
                                align: 'stretch',
                                type: 'hbox'
                            },
                            items: [
                                {
									xtype: 'combobox',
                                    store: 'StoreComboPacientes',
                                    name: 'paciente_id',
									id: 'paciente_id_filter_pacientes_transporte',
									button_id: 'button_paciente_id_filter_pacientes_transporte',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_paciente_id_filter_pacientes_transporte',
                                    combo_id: 'paciente_id_filter_pacientes_transporte',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'acompanhado',
							id: 'acompanhado_filter_pacientes_transporte',
							anchor: '100%',
							fieldLabel: 'Acompanhado'
						},
						{
							xtype: 'textfield',
							name: 'local_consulta',
							id: 'local_consulta_filter_pacientes_transporte',							
							anchor: '100%',
							fieldLabel: 'Local Consulta'
						},
						{
							xtype: 'textfield',
                            mask: '99:99:99',
							returnWithMask: true,
							plugins: 'textmask',								
							name: 'hora',
							id: 'hora_filter_pacientes_transporte',
							anchor: '100%',
							fieldLabel: 'Hora'
						},
						{
							xtype: 'textfield',
							name: 'fone',
							id: 'fone_filter_pacientes_transporte',							
							mask: '(99) 9999-9999',
							plugins: 'textmask',							
							anchor: '100%',
							fieldLabel: 'Fone'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_pacientes_transporte',
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
