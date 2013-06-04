/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.perfil.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filterperfilwin',

    id: 'FilterPerfilWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filter Profile',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterPerfil',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'perfil',
							id: 'perfil_filter_perfil',							
							anchor: '100%',
							fieldLabel: 'Profile'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_perfil',
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
                            text: 'Reset Filter'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: 'Filter'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
