/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.pacientes.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addpacienteswin',

    id: 'AddPacientesWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Pacientes',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormPacientes',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/pacientes/save.php',
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
									name: 'paciente',
									flex: 1,
									margin: '0 5 0 0',	
									id: 'paciente_pacientes',
									anchor: '100%',									
									fieldLabel: 'Paciente'									
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
		                                    store: 'StoreComboStatusPacientes',
		                                    name: 'status',
											loadDisabled: true,
											id: 'status_pacientes',
											button_id: 'button_status_pacientes',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Status'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_status_pacientes',
		                                    combo_id: 'status_pacientes',
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
									xtype: 'datefield',
									format: 'd/m/Y',									
									margin: '0 5 0 0',									
									flex: 1,								
									name: 'data_nascimento',
									id: 'data_nascimento_pacientes',
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
											id: 'sexo_pacientes',
											button_id: 'button_sexo_pacientes',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Sexo'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_sexo_pacientes',
		                                    combo_id: 'sexo_pacientes',
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
									id: 'tipo_sanguineo_pacientes',
									anchor: '100%',									
									fieldLabel: 'Tipo Sanguineo'									
								},								
								{
									xtype: 'textfield',
									name: 'rg',
									flex: 1,
									id: 'rg_pacientes',
									anchor: '100%',									
									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.Ajax.request({
												url: 'server/modulos/pacientes/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: 'rg',
													valor: this.getValue()
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													if(dados.success==false){
														Ext.getCmp('rg_pacientes').markInvalid('RG Ja Existe...');
													}
												}
											});
										}
									},									
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
									id: 'cpf_pacientes',
									anchor: '100%',									
									mask: '999.999.999.99',
									plugins: 'textmask',									
									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.Ajax.request({
												url: 'server/modulos/pacientes/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: 'cpf',
													valor: this.getValue()
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													if(dados.success==false){
														Ext.getCmp('cpf_pacientes').markInvalid('CPF Ja Existe...');
													}
												}
											});
										}
									},									
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
											id: 'uf_id_pacientes',
											button_id: 'button_uf_id_pacientes',
											flex: 1,
											anchor: '100%',										
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_uf_id_pacientes',
		                                    combo_id: 'uf_id_pacientes',
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
											id: 'cidade_id_pacientes',
											button_id: 'button_cidade_id_pacientes',
											loadDisabled: true,
											disabled: true,
											flex: 1,
											anchor: '100%',		
											fieldLabel: 'Cidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cidade_id_pacientes',
		                                    combo_id: 'cidade_id_pacientes',
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
									id: 'bairro_pacientes',
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
									id: 'endereco_pacientes',
									anchor: '100%',									
									fieldLabel: 'Endereco'									
								},								
								{
									xtype: 'textfield',
									name: 'cep',
									flex: 1,
									id: 'cep_pacientes',
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
									id: 'trabalho_pacientes',
									anchor: '100%',									
									fieldLabel: 'Trabalho'									
								},								
								{
									xtype: 'textfield',
									name: 'telefone',   
								    flex: 1,
									id: 'telefone_pacientes',
									anchor: '100%',							
									mask: '(99) 9999-9999',
									plugins: 'textmask',									
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
									id: 'pai_pacientes',
									anchor: '100%',									
									fieldLabel: 'Pai'									
								},								
								{
									xtype: 'textfield',
									name: 'mae',
								    flex: 1,
									id: 'mae_pacientes',
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
									xtype: 'textarea',
									name: 'obs',									
								    flex: 1,
									id: 'obs_pacientes',
									anchor: '100%',									
									fieldLabel: 'Obs'									
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_pacientes',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_pacientes',
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
                            id: 'button_resetar_pacientes',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_pacientes',
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
