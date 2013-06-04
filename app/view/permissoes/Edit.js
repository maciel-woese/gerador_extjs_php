Ext.define('ShSolutions.view.permissoes.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.addpermissoeswin',

    height: 282,
    id: 'AddPermissoesWin',
    width: 301,
    layout: {
        type: 'fit'
    },
    title: 'Permissões de Módulos',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'treepanel',
                    id: 'TreePermissoes',
                    useArrows: true,
                    store: 'StorePermissoes',
                    bodyBorder: false,
					border: false,
					padding: '5 2 2 2',
                    viewConfig: {

                    }
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
                            action: 'save',
                            iconCls: 'bt_save',
                            text: 'Salvar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});