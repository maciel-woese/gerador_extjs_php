/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_anotacoes.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterclientes_anotacoeswin',

    id: 'FilterClientes_AnotacoesWin',
    layout: {
        type: 'fit'
    },
	modal: true,
    minimizable: false,
    
    title: 'Filtro de Clientes_Anotacoes',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterClientes_Anotacoes',
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
									xtype: 'combobox',
                                    store: 'StoreComboClientes',
                                    name: 'cod_cliente',
									id: 'cod_cliente_filter_clientes_anotacoes',
									button_id: 'button_cod_cliente_filter_clientes_anotacoes',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Cliente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_cod_cliente_filter_clientes_anotacoes',
                                    combo_id: 'cod_cliente_filter_clientes_anotacoes',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'textfield',
							name: 'anotacao',
							id: 'anotacao_filter_clientes_anotacoes',							
							anchor: '100%',
							fieldLabel: 'Anotação'
						},
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'cadastrado_por',
							id: 'cadastrado_por_filter_clientes_anotacoes',
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
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Cadastro',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_cadastro_date_filter_clientes_anotacoes',
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
		                            id: 'data_cadastro_time_filter_clientes_anotacoes',
		                            name: 'data_cadastro_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
							xtype: 'textfield',
							name: 'ativo',
							id: 'ativo_filter_clientes_anotacoes',							
							anchor: '100%',
							fieldLabel: 'Ativo'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_clientes_anotacoes',
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
