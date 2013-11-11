/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_endereco.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addclientes_enderecowin',

    id: 'AddClientes_EnderecoWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
    title: 'Cadastro de Clientes_Endereco',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormClientes_Endereco',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/clientes_endereco/save.php',
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
		                                    store: 'StoreComboClientes',
		                                    name: 'cod_cliente',
											id: 'cod_cliente_clientes_endereco',
											button_id: 'button_cod_cliente_clientes_endereco',
											flex: 1,
											anchor: '100%',											fieldLabel: 'Cliente'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cod_cliente_clientes_endereco',
		                                    combo_id: 'cod_cliente_clientes_endereco',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Clientes',
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
		                                    store: 'StoreComboCorreios_Estados',
		                                    name: 'estado',
											id: 'estado_clientes_endereco',
											button_id: 'button_estado_clientes_endereco',
											flex: 1,
											anchor: '100%',											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_estado_clientes_endereco',
		                                    combo_id: 'estado_clientes_endereco',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Correios_Estados',
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
		                                    store: 'StoreComboCorreios_Cidades',
		                                    name: 'cidade',
											id: 'cidade_clientes_endereco',
											button_id: 'button_cidade_clientes_endereco',
											flex: 1,
											anchor: '100%',											fieldLabel: 'Cidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cidade_clientes_endereco',
		                                    combo_id: 'cidade_clientes_endereco',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Correios_Cidades',
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
		                                    store: 'StoreComboCorreios_Bairros',
		                                    name: 'bairro',
											id: 'bairro_clientes_endereco',
											button_id: 'button_bairro_clientes_endereco',
											flex: 1,
											anchor: '100%',											fieldLabel: 'Bairro'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_bairro_clientes_endereco',
		                                    combo_id: 'bairro_clientes_endereco',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Correios_Bairros',
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
									xtype: 'textfield',
									name: 'logradouro',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'logradouro_clientes_endereco',
									anchor: '100%',									
									fieldLabel: 'Logradouro'									
								},								
								{
									xtype: 'textfield',
									name: 'num_end',								    								    
								    flex: 1,
									id: 'num_end_clientes_endereco',
									anchor: '100%',									
									fieldLabel: 'Num End'									
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
									name: 'complemento',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'complemento_clientes_endereco',
									anchor: '100%',									
									fieldLabel: 'Complemento'									
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_clientes_endereco',
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
									name: 'cx_postal',								    								    
								    flex: 1,
									id: 'cx_postal_clientes_endereco',
									anchor: '100%',									
									fieldLabel: 'Cx Postal'									
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'controle',
							hidden: true,
							id: 'controle_clientes_endereco',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_clientes_endereco',
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
                            id: 'button_resetar_clientes_endereco',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_clientes_endereco',
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
