/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.saida_produtos.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filtersaida_produtoswin',

    id: 'FilterSaida_ProdutosWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Saida_Produtos',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterSaida_Produtos',
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
                                    store: 'StoreComboMedicamento',
                                    name: 'medicamento_id',
									id: 'medicamento_id_filter_saida_produtos',
									button_id: 'button_medicamento_id_filter_saida_produtos',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Medicamento'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_medicamento_id_filter_saida_produtos',
                                    combo_id: 'medicamento_id_filter_saida_produtos',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'quantidade',
							id: 'quantidade_filter_saida_produtos',
							anchor: '100%',
							fieldLabel: 'Quantidade'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_saida_produtos',
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
