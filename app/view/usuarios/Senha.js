/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.usuarios.Senha', {
    extend: 'Ext.window.Window',
	alias: 'widget.addsenhawin',

    id: 'AddSenhaWin',
    layout: {
        type: 'fit'
    },
    title: 'Alterar Senha',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormSenha',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/usuarios/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'senha1',									
							id: 'senha1_senha',
							anchor: '100%',				
							inputType: 'password',									
							fieldLabel: 'Senha Atual'
						},
						{
							xtype: 'textfield',
							name: 'senha2',									
							id: 'senha2_senha',
							anchor: '100%',				
							inputType: 'password',									
							fieldLabel: 'Nova Senha'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_senha',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_senha',
							value: 'ALTERAR_SENHA',
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
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: 'Alterar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);

    }

});
