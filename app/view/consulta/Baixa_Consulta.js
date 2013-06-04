/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.consulta.Baixa_Consulta', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addbaixaconsultawin',

    id: 'AddBaixaConsultaWin',
    layout: {
        type: 'fit'
    },
    title: 'Baixa de Consulta',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormConsulta',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/consulta/save.php',
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
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},									
									margin: '0 5 0 0',
									flex: 1,
									items: [
										{
											xtype: 'textfield',
											margins: '0 5 0 0',
											flex: 1,
											fieldLabel: 'Data Hora',
											readOnly: true,
											id: 'data_hora_consulta',
											name: 'data_hora'
										},
										{
											xtype: 'numberfield',
											name: 'senha',								    
											flex: 1,
											readOnly: true,
											id: 'senha_consulta',
											anchor: '100%',									
											fieldLabel: 'Senha'
										}
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
		                                    store: 'StoreComboFaltouConsulta',
		                                    name: 'faltou',
											loadDisabled: true,
											id: 'faltou_consulta',
											button_id: 'button_faltou_consulta',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Faltou'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_faltou_consulta',
		                                    combo_id: 'faltou_consulta',
		                                    action: 'reset_combo'
		                                }
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
		                                    store: 'StoreComboMedico',
		                                    name: 'medico_id',
											readOnly: true,
											id: 'medico_id_consulta',
											button_id: 'button_medico_id_consulta',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Medico'
										}
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
		                                    store: 'StoreComboPacientes',
		                                    name: 'paciente_id',
											id: 'paciente_id_consulta',
											button_id: 'button_paciente_id_consulta',
											flex: 1,
											readOnly: true,
											anchor: '100%',											
											fieldLabel: 'Paciente'
										}
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
									xtype: 'textarea',
									name: 'exame_fisico',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'exame_fisico_consulta',
									anchor: '100%',									
									fieldLabel: 'Exame Fisico'									
								},	
								{
									xtype: 'textarea',
									name: 'queixa_principal',								    								    
								    flex: 1,
									id: 'queixa_principal_consulta',
									anchor: '100%',									
									fieldLabel: 'Queixa Principal'									
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
									xtype: 'textarea',
									name: 'hipotese_diagnostica',								    								    
								    flex: 1,
									margin: '0 5 0 0',	
									id: 'hipotese_diagnostica_consulta',
									anchor: '100%',									
									fieldLabel: 'Hipotese Diagnostica'									
								},
								{
									xtype: 'textarea',
									name: 'tratamento',								    								    
								    flex: 1,
									id: 'tratamento_consulta',
									anchor: '100%',									
									fieldLabel: 'Tratamento'									
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_consulta',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_consulta',
							value: 'BAIXA_CONSULTA',
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
                            xtype: 'tbseparator'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_consulta',
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: 'Salvar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);

    }

});
