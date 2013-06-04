/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.filial.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filterfilialwin',

    id: 'FilterFilialWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Filial',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterFilial',
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
									name: 'filial',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'filial_filter_filial',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Filial'
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
											id: 'uf_id_filter_filial',
											button_id: 'button_uf_id_filter_filial',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_uf_id_filter_filial',
		                                    combo_id: 'uf_id_filter_filial',
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
											id: 'cidade_id_filter_filial',
											button_id: 'button_cidade_id_filter_filial',
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
		                                    id: 'button_cidade_id_filter_filial',
		                                    combo_id: 'cidade_id_filter_filial',
		                                    action: 'reset_combo'
		                                },
		                            ]
		                        },		                        
								{
									xtype: 'textfield',
									name: 'bairro',								    								    
								    flex: 1,
									id: 'bairro_filter_filial',																											
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
									id: 'endereco_filter_filial',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Endereco'
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_filter_filial',									
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
									id: 'telefone_filter_filial',							
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
							id: 'action_filter_filial',
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
