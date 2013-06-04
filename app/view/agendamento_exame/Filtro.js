/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.agendamento_exame.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filteragendamento_examewin',

    id: 'FilterAgendamento_ExameWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Agendamento de Exame',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterAgendamento_Exame',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Exame',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_exame_date_filter_agendamento_exame',
		                            name: 'data_exame_date',
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Entrega',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_entrega_date_filter_agendamento_exame',
		                            name: 'data_entrega_date',
		                            hideLabel: true
		                        }
		                    ]
		                },
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
                                    store: 'StoreComboUsuarios',
                                    name: 'usuario_id',
									id: 'usuario_id_filter_agendamento_exame',
									button_id: 'button_usuario_id_filter_agendamento_exame',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Usuario'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_usuario_id_filter_agendamento_exame',
                                    combo_id: 'usuario_id_filter_agendamento_exame',
                                    action: 'reset_combo'
                                }
                            ]
                        },
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
									id: 'paciente_id_filter_agendamento_exame',
									button_id: 'button_paciente_id_filter_agendamento_exame',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_paciente_id_filter_agendamento_exame',
                                    combo_id: 'paciente_id_filter_agendamento_exame',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_agendamento_exame',
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
