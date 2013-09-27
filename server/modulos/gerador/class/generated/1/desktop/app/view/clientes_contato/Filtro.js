/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_contato.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterclientes_contatowin',

    id: 'FilterClientes_ContatoWin',
    layout: {
        type: 'fit'
    },
	modal: true,
    minimizable: false,
    
    title: 'Filtro de Clientes_Contato',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterClientes_Contato',
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
									id: 'cod_cliente_filter_clientes_contato',
									button_id: 'button_cod_cliente_filter_clientes_contato',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Cliente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_cod_cliente_filter_clientes_contato',
                                    combo_id: 'cod_cliente_filter_clientes_contato',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'textfield',
							name: 'tipo_contato',
							id: 'tipo_contato_filter_clientes_contato',							
							anchor: '100%',
							fieldLabel: 'Tipo Contato'
						},
						{
							xtype: 'textfield',
							name: 'descricao',
							id: 'descricao_filter_clientes_contato',							
							anchor: '100%',
							fieldLabel: 'Descrição'
						},
						{
							xtype: 'textfield',
							name: 'observacao',
							id: 'observacao_filter_clientes_contato',							
							anchor: '100%',
							fieldLabel: 'Observação'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_clientes_contato',
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
