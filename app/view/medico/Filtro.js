/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.medico.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filtermedicowin',

    id: 'FilterMedicoWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Medico',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterMedico',
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
									xtype: 'textfield',
									name: 'medico',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'medico_filter_medico',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Medico'
								},								
								{
									xtype: 'textfield',
									name: 'crm',								    								    
								    flex: 1,
									id: 'crm_filter_medico',																											
									allowBlank: false,
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
											id: 'especialidade_id_filter_medico',
											button_id: 'button_especialidade_id_filter_medico',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Especialidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_especialidade_id_filter_medico',
		                                    combo_id: 'especialidade_id_filter_medico',
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
		                                    store: 'StoreComboEstados',
		                                    name: 'uf_id',
											id: 'uf_id_filter_medico',
											button_id: 'button_uf_id_filter_medico',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_uf_id_filter_medico',
		                                    combo_id: 'uf_id_filter_medico',
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
											id: 'cidade_id_filter_medico',
											button_id: 'button_cidade_id_filter_medico',
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
		                                    id: 'button_cidade_id_filter_medico',
		                                    combo_id: 'cidade_id_filter_medico',
		                                    action: 'reset_combo'
		                                },
		                            ]
		                        },		                        
								{
									xtype: 'textfield',
									name: 'bairro',								    								    
								    flex: 1,
									id: 'bairro_filter_medico',																											
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
									id: 'endereco_filter_medico',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Endereco'
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_filter_medico',									
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
									name: 'telefone',								    								    
								    flex: 1,
									id: 'telefone_filter_medico',							
									mask: '(99) 9999-9999',
									plugins: 'textmask',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Telefone'
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_medico',
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
