Ext.define('ShSolutions.view.AddComboWin', {
    extend: 'Ext.window.Window',
    alias: 'widget.addcombowin',

    height: 375,
    id: 'AddComboWin',
    width: 353,
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Combobox',
    modal: true,

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    bodyPadding: 5,
                    title: 'Formulario',
                    items: [
                        {
                            xtype: 'fieldset',
                            title: 'Campos',
                            items: [
                                {
                                    xtype: 'textfield',
                                    id: 'FormComboId',
                                    fieldLabel: 'Id',
                                    allowBlank: false,
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'FormComboDescricao',
                                    fieldLabel: 'Descri&ccedil;&atilde;o',
                                    allowBlank: false,
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'hidden',
                                    id: 'ColIndex',
                                    fieldLabel: 'Index',
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'button',
                                    margin: '0 0 5 0',
                                    iconCls: 'bt_add',
                                    text: 'Adicionar',
                                    action: 'add_grid'
                                },
                                {
                                	xtype: 'hidden',
                                	name: 'action',
                                	value: 'INSERT',
                                	id: 'action_grid_combo'
                                }
                            ]
                        },
                        {
                            xtype: 'gridpanel',
                            height: 145,
                            id: 'GridCombo',
                            width: 330,
                            autoScroll: true,
                            title: 'Opcoes Combobox',
                            store: 'StoreCombo',
                            columns: [
                                {
                                    xtype: 'gridcolumn',
                                    width: 120,
                                    dataIndex: 'value',
                                    text: 'Id'
                                },
                                {
                                    xtype: 'gridcolumn',
                                    width: 150,
                                    dataIndex: 'label',
                                    text: 'Descri&ccedil;&atilde;o'
                                }
                            ],
                            viewConfig: {

                            },
                            dockedItems: [
                                {
                                    xtype: 'toolbar',
                                    dock: 'top',
                                    items: [
										{
										    xtype: 'button',
										    iconCls: 'bt_edit',
										    text: 'Editar',
										    action: 'edit_grid'
										},
                                        {
                                            xtype: 'button',
                                            iconCls: 'bt_del',
                                            text: 'Deletar',
                                            action: 'del_grid'
                                        }
                                    ]
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
                            xtype: 'button',
                            iconCls: 'bt_save',
                            text: 'Salvar',
                            action: 'save_grid'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
        
        me.on('show', function(){
        	Ext.getCmp('GridCombo').store.removeAll();
        })
    }

});