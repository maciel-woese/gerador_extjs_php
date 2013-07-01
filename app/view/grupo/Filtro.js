Ext.define('ShSolutions.view.grupo.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filtergrupowin',

    id: 'FilterGrupoWin',
    layout: {
        type: 'fit'
    },
    modal: true,
    minimizable: false,
    
    title: 'Filtro de Grupo',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterGrupo',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'grupo',
							id: 'grupo_filter_grupo',																					
							anchor: '100%',
							fieldLabel: 'Grupo'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_grupo',
							allowBlank: false,
							value: 'INSERIR',
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
