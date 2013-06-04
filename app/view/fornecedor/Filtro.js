/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.fornecedor.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterfornecedorwin',

    id: 'FilterFornecedorWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Fornecedor',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterFornecedor',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'fornecedor',
							id: 'fornecedor_filter_fornecedor',							
							anchor: '100%',
							fieldLabel: 'Fornecedor'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_fornecedor',
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
