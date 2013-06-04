/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.estados.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterestadoswin',

    id: 'FilterEstadosWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Estados',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterEstados',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'sigla',
							id: 'sigla_filter_estados',							
							anchor: '100%',
							fieldLabel: 'Sigla'
						},
						{
							xtype: 'textfield',
							name: 'descricao',
							id: 'descricao_filter_estados',							
							anchor: '100%',
							fieldLabel: 'Descrição'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_estados',
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
