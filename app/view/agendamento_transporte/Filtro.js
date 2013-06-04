/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.agendamento_transporte.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filteragendamento_transportewin',

    id: 'FilterAgendamento_TransporteWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Agendamento de Transporte',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterAgendamento_Transporte',
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
									xtype: 'datefield',
									format: 'd/m/Y',									
									margin: '0 5 0 0',									
									flex: 1,
								
									name: 'data',
									id: 'data_filter_agendamento_transporte',
									anchor: '100%',
									fieldLabel: 'Data'
								},								
								{
									xtype: 'textfield',
									mask: '99:99:99',
									returnWithMask: true,
									plugins: 'textmask',																		
									flex: 1,
								
									name: 'hora_saida',
									id: 'hora_saida_filter_agendamento_transporte',
									anchor: '100%',
									fieldLabel: 'Hora Saida'
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
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,								    
								    margin: '0 5 0 0',								    
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
										{
											xtype: 'combobox',
		                                    store: 'StoreComboUsuarios',
		                                    name: 'usuario_id',
											id: 'usuario_id_filter_agendamento_transporte',
											button_id: 'button_usuario_id_filter_agendamento_transporte',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Usuario'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_usuario_id_filter_agendamento_transporte',
		                                    combo_id: 'usuario_id_filter_agendamento_transporte',
		                                    action: 'reset_combo'
		                                },
		                            ]
		                        },		                        
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,								    								    
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
										{
											xtype: 'combobox',
		                                    store: 'StoreComboVeiculos',
		                                    name: 'veiculo_id',
											id: 'veiculo_id_filter_agendamento_transporte',
											button_id: 'button_veiculo_id_filter_agendamento_transporte',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Veiculo'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_veiculo_id_filter_agendamento_transporte',
		                                    combo_id: 'veiculo_id_filter_agendamento_transporte',
		                                    action: 'reset_combo'
		                                },
		                            ]
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
									xtype: 'textfield',
									name: 'destino',									
								    flex: 1,
									id: 'destino_filter_agendamento_transporte',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Destino'
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_agendamento_transporte',
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
