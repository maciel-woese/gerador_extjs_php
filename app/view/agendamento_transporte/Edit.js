/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.agendamento_transporte.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addagendamento_transportewin',

    id: 'AddAgendamento_TransporteWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Agendamento de Transporte',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormAgendamento_Transporte',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/agendamento_transporte/save.php',
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
									xtype: 'datefield',
									format: 'd/m/Y',									
									margin: '0 5 0 0',									
									flex: 1,								
									name: 'data',
									id: 'data_agendamento_transporte',
									anchor: '100%',
									fieldLabel: 'Data'
								},								
								{
									xtype: 'textfield',
									mask: '99:99:99',
									returnWithMask: true,
									plugins: 'textmask',																		
									flex: 1,								
									name: 'hora_saida',
									id: 'hora_saida_agendamento_transporte',
									anchor: '100%',
									fieldLabel: 'Hora Saida'
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
									name: 'destino',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'destino_agendamento_transporte',
									anchor: '100%',									
									fieldLabel: 'Destino'									
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
		                                    store: 'StoreComboVeiculos',
		                                    name: 'veiculo_id',
											id: 'veiculo_id_agendamento_transporte',
											button_id: 'button_veiculo_id_agendamento_transporte',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Veiculo'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_veiculo_id_agendamento_transporte',
		                                    combo_id: 'veiculo_id_agendamento_transporte',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Veiculos',
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
									xtype: 'textarea',
									name: 'obs',								    								    
								    flex: 1,
									id: 'obs_agendamento_transporte',
									anchor: '100%',									
									fieldLabel: 'Obs'									
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_agendamento_transporte',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_agendamento_transporte',
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
                            id: 'button_resetar_agendamento_transporte',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_agendamento_transporte',
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
