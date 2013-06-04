/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.medicamento.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addmedicamentowin',

    id: 'AddMedicamentoWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Medicamento',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormMedicamento',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/medicamento/save.php',
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
									id: 'medicamento_medicamento',
									anchor: '100%',									
									fieldLabel: 'Medicamento'									
								},								
								{
									xtype: 'textfield',
									name: 'codigo_barras',								    								    
								    flex: 1,
									id: 'codigo_barras_medicamento',
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
											id: 'laboratorio_id_medicamento',
											button_id: 'button_laboratorio_id_medicamento',
											flex: 1,
											anchor: '100%',											fieldLabel: 'Laboratorio'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_laboratorio_id_medicamento',
		                                    combo_id: 'laboratorio_id_medicamento',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Laboratorio',
											action: 'add_win'
		                                }
		                            ]
		                        },		                        
								{
									xtype: 'numberfield',
									name: 'quantidade',								    								    
								    flex: 1,
									id: 'quantidade_medicamento',
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
									id: 'quantidade_minima_medicamento',
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
											id: 'status_medicamento',
											button_id: 'button_status_medicamento',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Status'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_status_medicamento',
		                                    combo_id: 'status_medicamento',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        }
							]
						},
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							anchor: '100%',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'textarea',
									name: 'obs',								    								    
								    flex: 1,
									id: 'obs_medicamento',
									anchor: '100%',									
									fieldLabel: 'Obs'									
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_medicamento',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_medicamento',
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
                            id: 'button_resetar_medicamento',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_medicamento',
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
