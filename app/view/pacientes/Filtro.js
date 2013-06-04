/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.pacientes.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filterpacienteswin',

    id: 'FilterPacientesWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Pacientes',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterPacientes',
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
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},									
									margin: '0 5 0 0',									
									flex: 1,
									labelAlign: 'top',
									labelStyle: 'font-weight: bold;font-size: 11px;',			    
									fieldLabel: 'Data Cadastro',
									items: [
										{
											xtype: 'datefield',
											format: 'd/m/Y',
											flex: 1,
											id: 'data_cadastro_date_filter_pacientes',
											name: 'data_cadastro_date',
											hideLabel: true
										}
									]
								},								
								{
									xtype: 'textfield',
									name: 'paciente',								    								    
								    flex: 1,
									id: 'paciente_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Paciente'
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
									xtype: 'datefield',
									format: 'd/m/Y',									
									margin: '0 5 0 0',									
									flex: 1,
								
									name: 'data_nascimento',
									id: 'data_nascimento_filter_pacientes',
									anchor: '100%',
									fieldLabel: 'Data Nascimento'
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
		                                    store: 'StoreComboSexoPacientes',
		                                    name: 'sexo',
											loadDisabled: true,
											id: 'sexo_filter_pacientes',
											button_id: 'button_sexo_filter_pacientes',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Sexo'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_sexo_filter_pacientes',
		                                    combo_id: 'sexo_filter_pacientes',
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
									xtype: 'textfield',
									name: 'tipo_sanguineo',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'tipo_sanguineo_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Tipo Sanguineo'
								},								
								{
									xtype: 'textfield',
									name: 'rg',								    								    
								    flex: 1,
									id: 'rg_filter_pacientes',																				
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Rg'
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
									name: 'cpf',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'cpf_filter_pacientes',									
									mask: '999.999.999.99',
									plugins: 'textmask',																						
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cpf'
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
		                                    store: 'StoreComboEstados',
		                                    name: 'uf_id',
											id: 'uf_id_filter_pacientes',
											button_id: 'button_uf_id_filter_pacientes',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_uf_id_filter_pacientes',
		                                    combo_id: 'uf_id_filter_pacientes',
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
		                                    store: 'StoreComboCidades',
		                                    name: 'cidade_id',
											id: 'cidade_id_filter_pacientes',
											button_id: 'button_cidade_id_filter_pacientes',
											flex: 1,
											disabled: true,
											loadDisabled: true,
											anchor: '100%',
											fieldLabel: 'Cidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cidade_id_filter_pacientes',
		                                    combo_id: 'cidade_id_filter_pacientes',
		                                    action: 'reset_combo'
		                                },
		                            ]
		                        },		                        
								{
									xtype: 'textfield',
									name: 'bairro',								    								    
								    flex: 1,
									id: 'bairro_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Bairro'
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
									name: 'endereco',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'endereco_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Endereco'
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_filter_pacientes',									
									mask: '99.999-999',
									plugins: 'textmask',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cep'
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
									name: 'trabalho',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'trabalho_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Trabalho'
								},								
								{
									xtype: 'textfield',
									name: 'telefone',								    								    
								    flex: 1,
									id: 'telefone_filter_pacientes',							
									mask: '(99) 9999-9999',
									plugins: 'textmask',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Telefone'
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
									name: 'pai',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'pai_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Pai'
								},								
								{
									xtype: 'textfield',
									name: 'mae',								    								    
								    flex: 1,
									id: 'mae_filter_pacientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Mae'
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
								    flex: 1,
									margin: '0 5 0 0',
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
		                                {
											xtype: 'combobox',
		                                    store: 'StoreComboStatusPacientes',
		                                    name: 'status',
											loadDisabled: true,
											id: 'status_filter_pacientes',
											button_id: 'button_status_filter_pacientes',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Status'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_status_filter_pacientes',
		                                    combo_id: 'status_filter_pacientes',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        }

							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_pacientes',
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
