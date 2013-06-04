/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.fornecedor.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addfornecedorwin',

    id: 'AddFornecedorWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Fornecedor',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormFornecedor',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/fornecedor/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'fornecedor',
							id: 'fornecedor_fornecedor',
							anchor: '100%',							
							fieldLabel: 'Fornecedor'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_fornecedor',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_fornecedor',
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
                            xtype: 'tbseparator'
                        },
                        {
                            xtype: 'button',
                            id: 'button_resetar_fornecedor',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_fornecedor',
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: 'Salvar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);

    }

});
