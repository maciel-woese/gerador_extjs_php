/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.veiculos.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterveiculoswin',

    id: 'FilterVeiculosWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Veiculos',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterVeiculos',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'veiculo',
							id: 'veiculo_filter_veiculos',							
							anchor: '100%',
							fieldLabel: 'Veiculo'
						},
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'passageiros',
							id: 'passageiros_filter_veiculos',
							anchor: '100%',
							fieldLabel: 'Passageiros'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_veiculos',
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
