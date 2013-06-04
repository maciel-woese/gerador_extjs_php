/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.laboratorio.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterlaboratoriowin',

    id: 'FilterLaboratorioWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Laboratorio',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterLaboratorio',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'laboratorio',
							id: 'laboratorio_filter_laboratorio',							
							anchor: '100%',
							fieldLabel: 'Laboratorio'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_laboratorio',
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
