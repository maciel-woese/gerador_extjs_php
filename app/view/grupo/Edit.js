Ext.define('ShSolutions.view.grupo.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.addgrupowin',

	id: 'AddGrupoWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Grupo',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormGrupo',
                    autoScroll: true,
                    bodyPadding: 5,
                    method: 'POST',
                    url: 'server/modulos/grupo/save.php',
                    items: [
                        {
                            xtype: 'fieldset',
                            title: 'Campos',
                            items: [
                                {
                                    xtype: 'textfield',
                                    anchor: '100%',
                                    id: 'grupo_grupo',
                                    name: 'grupo',
                                    fieldLabel: 'Grupo'
                                },
                                {
                                    xtype: 'hiddenfield',
                                    anchor: '100%',
									value: 'INSERIR',
                                    id: 'action_grupo',
                                    name: 'action',
                                    fieldLabel: 'Action'
                                },
                                {
                                    xtype: 'hiddenfield',
                                    anchor: '100%',
									value: 0,
                                    id: 'id_grupo',
                                    name: 'id',
                                    fieldLabel: 'Id'
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
							action: 'salvar',
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