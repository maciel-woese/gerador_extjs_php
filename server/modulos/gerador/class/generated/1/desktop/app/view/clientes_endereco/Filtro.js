/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_endereco.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filterclientes_enderecowin',

    id: 'FilterClientes_EnderecoWin',
    layout: {
        type: 'fit'
    },
    modal: true,
    minimizable: false,
	
    title: 'Filtro de Clientes_Endereco',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterClientes_Endereco',
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
		                                    store: 'StoreComboClientes',
		                                    name: 'cod_cliente',
											id: 'cod_cliente_filter_clientes_endereco',
											button_id: 'button_cod_cliente_filter_clientes_endereco',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Cliente'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cod_cliente_filter_clientes_endereco',
		                                    combo_id: 'cod_cliente_filter_clientes_endereco',
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
		                                    store: 'StoreComboCorreios_Estados',
		                                    name: 'estado',
											id: 'estado_filter_clientes_endereco',
											button_id: 'button_estado_filter_clientes_endereco',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_estado_filter_clientes_endereco',
		                                    combo_id: 'estado_filter_clientes_endereco',
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
		                                    store: 'StoreComboCorreios_Cidades',
		                                    name: 'cidade',
											id: 'cidade_filter_clientes_endereco',
											button_id: 'button_cidade_filter_clientes_endereco',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Cidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cidade_filter_clientes_endereco',
		                                    combo_id: 'cidade_filter_clientes_endereco',
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
		                                    store: 'StoreComboCorreios_Bairros',
		                                    name: 'bairro',
											id: 'bairro_filter_clientes_endereco',
											button_id: 'button_bairro_filter_clientes_endereco',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Bairro'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_bairro_filter_clientes_endereco',
		                                    combo_id: 'bairro_filter_clientes_endereco',
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
									name: 'logradouro',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'logradouro_filter_clientes_endereco',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Logradouro'
								},								
								{
									xtype: 'textfield',
									name: 'num_end',								    								    
								    flex: 1,
									id: 'num_end_filter_clientes_endereco',																											
									allowBlank: false,
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
									id: 'complemento_filter_clientes_endereco',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Complemento'
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_filter_clientes_endereco',									
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
									id: 'cx_postal_filter_clientes_endereco',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cx Postal'
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_clientes_endereco',
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
