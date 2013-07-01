Ext.define('ShSolutions.view.gerador.Select', {
    extend: 'Ext.window.Window',
    alias: 'widget.selectwin',

	id: 'SelectWin',
    layout: {
        type: 'fit'
    },
	
    title: 'Selecionar Tabelas',
	
	fieldTabela: 'Tabelas',
	button_select: 'Selecionar',
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			title: me.title,
            items: [
                {
                    xtype: 'form',
                    id: 'FormSelect',
                    bodyPadding: 10,
                    title: 'Config.',
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
                                    store: 'StoreComboTabelasPDF',
                                    name: 'tabelas[]',
                                    multiSelect: true,
                                    allowBlank: true,
									id: 'tabelas_select',
									flex: 1,
									anchor: '100%',
									fieldLabel: me.fieldTabela
								}
							]
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
							action: 'select_now_tabelas',
                            iconCls: 'refresh',
                            text: me.button_select
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});