/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.saida_medicamento.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filtersaida_medicamentowin',

    id: 'FilterSaida_MedicamentoWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Saida_Medicamento',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterSaida_Medicamento',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Cadastro',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_cadastro_date_filter_saida_medicamento',
		                            name: 'data_cadastro_date',
		                            hideLabel: true
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
									xtype: 'combobox',
                                    store: 'StoreComboUsuarios',
                                    name: 'usuario_id',
									id: 'usuario_id_filter_saida_medicamento',
									button_id: 'button_usuario_id_filter_saida_medicamento',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Usuário'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_usuario_id_filter_saida_medicamento',
                                    combo_id: 'usuario_id_filter_saida_medicamento',
                                    action: 'reset_combo'
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
									xtype: 'combobox',
                                    store: 'StoreComboPacientes',
                                    name: 'paciente_id',
									id: 'paciente_id_filter_saida_medicamento',
									button_id: 'button_paciente_id_filter_saida_medicamento',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_paciente_id_filter_saida_medicamento',
                                    combo_id: 'paciente_id_filter_saida_medicamento',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_saida_medicamento',
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
