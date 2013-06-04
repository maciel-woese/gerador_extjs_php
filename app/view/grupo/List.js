Ext.define('ShSolutions.view.grupo.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.grupolist',

	id: 'GridGrupo',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			store: 'StoreGrupo',
            columns: [
                {
					xtype: 'rownumberer',
					width: 50,
					sortable: false
				},
				{
                    xtype: 'gridcolumn',
                    dataIndex: 'id',
					width: 100,
                    text: 'Id Grupo'
                },
                {
                    xtype: 'gridcolumn',
					width: 250,
                    dataIndex: 'grupo',
                    text: 'Grupo'
                }
            ],
            viewConfig: {

            },
            dockedItems: [
                {
                    xtype: 'pagingtoolbar',
                    dock: 'bottom',
                    store: 'StoreGrupo',
                    displayInfo: true
                },
				{
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            action: 'adicionar',
                            iconCls: 'bt_add',
                            text: 'Adicionar'
                        },
                        {
                            xtype: 'button',
                            action: 'editar',
                            iconCls: 'bt_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            action: 'deletar',
                            iconCls: 'bt_del',
                            text: 'Deletar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});