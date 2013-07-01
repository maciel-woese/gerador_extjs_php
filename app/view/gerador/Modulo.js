Ext.define('ShSolutions.view.gerador.Modulo', {
    extend: 'Ext.window.Window',
    alias: 'widget.modulowin',

    layout: {
        type: 'fit'
    },
    id: 'AddModuloWin',
    title: 'Modulo Manual',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormModulo',
                    bodyPadding: 10,
                    items: [
                        {
                            xtype: 'textfield',
                            anchor: '100%',
                            fieldLabel: 'Modulo'
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Campos',
                            items: [
                                {
                                    xtype: 'textfield',
                                    anchor: '100%',
                                    name: 'campo',
                                    fieldLabel: 'Campo'
                                },
                                {
                                    xtype: 'textfield',
                                    anchor: '100%',
                                    name: 'tipo',
                                    fieldLabel: 'Tipo'
                                },
                                {
                                    xtype: 'checkboxfield',
                                    anchor: '100%',
                                    name: 'chave',
                                    fieldLabel: 'Chave Primaria',
                                    boxLabel: 'Primary Key'
                                },
                                {
                                    xtype: 'checkboxfield',
                                    anchor: '100%',
                                    name: 'unique',
                                    fieldLabel: 'Chave Unica',
                                    boxLabel: 'Unique Key'
                                },
                                {
                                    xtype: 'checkboxfield',
                                    anchor: '100%',
                                    name: 'foreign',
                                    fieldLabel: 'Chave Estrang.',
                                    boxLabel: 'Foreign Key'
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
                                    xtype: 'button',
                                    action: 'add_grid',
                                    iconCls: 'bt_add',
                                    text: 'Adicionar'
                                }
                            ]
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});