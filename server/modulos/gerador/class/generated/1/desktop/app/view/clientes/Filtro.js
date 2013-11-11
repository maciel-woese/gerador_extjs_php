/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filterclienteswin',

    id: 'FilterClientesWin',
    layout: {
        type: 'fit'
    },
    modal: true,
    minimizable: false,
	
    title: 'Filtro de Clientes',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterClientes',
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
		                                    store: 'StoreComboTipo_ClienteClientes',
		                                    name: 'tipo_cliente',
											loadDisabled: true,
											id: 'tipo_cliente_filter_clientes',
											button_id: 'button_tipo_cliente_filter_clientes',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Tipo Cliente'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_tipo_cliente_filter_clientes',
		                                    combo_id: 'tipo_cliente_filter_clientes',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        },								
								{
									xtype: 'textfield',
									name: 'nome_completo',								    								    
								    flex: 1,
									id: 'nome_completo_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Nome Completo'
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
									name: 'razao_social',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'razao_social_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Razão Social'
								},								
								{
									xtype: 'textfield',
									name: 'nome_fantasia',								    								    
								    flex: 1,
									id: 'nome_fantasia_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Nome Fantasia'
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
									name: 'pessoa_contato',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'pessoa_contato_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Pessoa Contato'
								},								
								{
									xtype: 'datefield',
									format: 'd/m/Y',																		
									flex: 1,								
									name: 'data_nascimento',
									id: 'data_nascimento_filter_clientes',
									anchor: '100%',
									fieldLabel: 'Data Nascimento'
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
		                                    store: 'StoreComboSexoClientes',
		                                    name: 'sexo',
											loadDisabled: true,
											id: 'sexo_filter_clientes',
											button_id: 'button_sexo_filter_clientes',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Sexo'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_sexo_filter_clientes',
		                                    combo_id: 'sexo_filter_clientes',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        },								
								{
									xtype: 'textfield',
									name: 'cpf',								    								    
								    flex: 1,
									id: 'cpf_filter_clientes',									
									mask: '999.999.999.99',
									plugins: 'textmask',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cpf'
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
									name: 'cnpj',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'cnpj_filter_clientes',									
									mask: '99.999.999/9999-99',
									plugins: 'textmask',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cnpj'
								},								
								{
									xtype: 'textfield',
									name: 'ie',								    								    
								    flex: 1,
									id: 'ie_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Ie'
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
									name: 'im',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'im_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Im'
								},								
								{
									xtype: 'textfield',
									name: 'identidade',								    								    
								    flex: 1,
									id: 'identidade_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Identidade'
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
									name: 'profissao',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'profissao_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Profissão'
								},								
								{
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},																		
									flex: 1,
									labelAlign: 'top',
									labelStyle: 'font-weight: bold;font-size: 11px;',			    
									fieldLabel: 'Data Cadastro',
									items: [
										{
											xtype: 'datefield',
											format: 'd/m/Y',
											flex: 1,
											id: 'data_cadastro_date_filter_clientes',
											name: 'data_cadastro_date',
											margins: '0 5 0 0',
											hideLabel: true
										},
										{
											xtype: 'textfield',
											mask: '99:99:99',
											plugins: 'textmask',
											returnWithMask: true,
											flex: 1,
											id: 'data_cadastro_time_filter_clientes',
											name: 'data_cadastro_time',
											hideLabel: true
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
									name: 'cadastrado_por',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'cadastrado_por_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cadastrado Por'
								},								
								{
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},																		
									flex: 1,
									labelAlign: 'top',
									labelStyle: 'font-weight: bold;font-size: 11px;',			    
									fieldLabel: 'Data Alteração',
									items: [
										{
											xtype: 'datefield',
											format: 'd/m/Y',
											flex: 1,
											id: 'data_alteracao_date_filter_clientes',
											name: 'data_alteracao_date',
											margins: '0 5 0 0',
											hideLabel: true
										},
										{
											xtype: 'textfield',
											mask: '99:99:99',
											plugins: 'textmask',
											returnWithMask: true,
											flex: 1,
											id: 'data_alteracao_time_filter_clientes',
											name: 'data_alteracao_time',
											hideLabel: true
										}
									]
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
									name: 'situacao_cadastral',								    								    
								    flex: 1,
									id: 'situacao_cadastral_filter_clientes',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Situação Cadastral'
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_clientes',
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
