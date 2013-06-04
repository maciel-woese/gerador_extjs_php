/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.cidades.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filtercidadeswin',

    id: 'FilterCidadesWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Cidades',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterCidades',
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
                                    store: 'StoreComboEstados',
                                    name: 'estado_id',
									id: 'estado_id_filter_cidades',
									button_id: 'button_estado_id_filter_cidades',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Estado'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_estado_id_filter_cidades',
                                    combo_id: 'estado_id_filter_cidades',
                                    action: 'reset_combo'
                                }
                            ]
                        },
						{
							xtype: 'textfield',
							name: 'cidade',
							id: 'cidade_filter_cidades',							
							anchor: '100%',
							fieldLabel: 'Cidade'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_cidades',
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
