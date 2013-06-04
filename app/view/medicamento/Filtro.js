/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.medicamento.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filtermedicamentowin',

    id: 'FilterMedicamentoWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Medicamento',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterMedicamento',
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
									name: 'medicamento',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'medicamento_filter_medicamento',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Medicamento'
								},								
								{
									xtype: 'textfield',
									name: 'codigo_barras',								    								    
								    flex: 1,
									id: 'codigo_barras_filter_medicamento',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Codigo Barras'
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
		                                    store: 'StoreComboLaboratorio',
		                                    name: 'laboratorio_id',
											id: 'laboratorio_id_filter_medicamento',
											button_id: 'button_laboratorio_id_filter_medicamento',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Laboratorio'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_laboratorio_id_filter_medicamento',
		                                    combo_id: 'laboratorio_id_filter_medicamento',
		                                    action: 'reset_combo'
		                                },
		                            ]
		                        },		                        
								{
									xtype: 'numberfield',
									name: 'quantidade',								    								    
								    flex: 1,
									id: 'quantidade_filter_medicamento',
									anchor: '100%',
									fieldLabel: 'Quantidade'
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
									xtype: 'numberfield',
									name: 'quantidade_minima',								    
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'quantidade_minima_filter_medicamento',
									anchor: '100%',
									fieldLabel: 'Qtd Minima'
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
		                                    store: 'StoreComboStatusMedicamento',
		                                    name: 'status',
											loadDisabled: true,
											id: 'status_filter_medicamento',
											button_id: 'button_status_filter_medicamento',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Status'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_status_filter_medicamento',
		                                    combo_id: 'status_filter_medicamento',
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
							id: 'action_filter_medicamento',
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
