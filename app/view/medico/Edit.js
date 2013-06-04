/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.medico.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addmedicowin',

    id: 'AddMedicoWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Medico',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormMedico',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/medico/save.php',
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
									xtype: 'textfield',
									name: 'medico',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'medico_medico',
									anchor: '100%',									
									fieldLabel: 'Medico'									
								},								
								{
									xtype: 'textfield',
									name: 'crm',								    								    
								    flex: 1,
									id: 'crm_medico',
									anchor: '100%',									
									fieldLabel: 'Crm'									
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
		                                    store: 'StoreComboEspecialidades',
		                                    name: 'especialidade_id',
											id: 'especialidade_id_medico',
											button_id: 'button_especialidade_id_medico',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Especialidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_especialidade_id_medico',
		                                    combo_id: 'especialidade_id_medico',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Especialidades',
											action: 'add_win'
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
		                                    store: 'StoreComboEstados',
		                                    name: 'uf_id',
											id: 'uf_id_medico',
											button_id: 'button_uf_id_medico',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_uf_id_medico',
		                                    combo_id: 'uf_id_medico',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Estados',
											action: 'add_win'
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
		                                    store: 'StoreComboCidades',
		                                    name: 'cidade_id',
											id: 'cidade_id_medico',
											button_id: 'button_cidade_id_medico',
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
		                                    id: 'button_cidade_id_medico',
		                                    combo_id: 'cidade_id_medico',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Cidades',
											action: 'add_win'
		                                }
		                            ]
		                        },		                        
								{
									xtype: 'textfield',
									name: 'bairro',								    								    
								    flex: 1,
									id: 'bairro_medico',
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
									id: 'endereco_medico',
									anchor: '100%',									
									fieldLabel: 'Endereco'									
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_medico',
									anchor: '100%',									
									mask: '99.999-999',
									plugins: 'textmask',									
									fieldLabel: 'Cep'									
								}								

							]
						},
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							anchor: '50%',
							margins: '0 5 0 0',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'textfield',
									name: 'telefone',								    								    
								    flex: 1,
									id: 'telefone_medico',
									anchor: '100%',							
									mask: '(99) 9999-9999',
									plugins: 'textmask',									
									fieldLabel: 'Telefone'									
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_medico',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_medico',
							value: 'INSERIR',
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
                            id: 'button_resetar_medico',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_medico',
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
