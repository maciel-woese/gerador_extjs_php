/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.user.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.userform',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormUser',
        url: 'server/modulos/user/save.php',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'User',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: 'Voltar',
						action: 'back'
                    }
                ]
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                items: [
                    {
                        xtype: 'spacer'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'salvar',
                        text: 'Salvar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
					{
                        xtype: 'textfield',
						id: 'name_user',
						name: 'name',
						label: 'Nome'
                    },
					{
                        xtype: 'passwordfield',
						id: 'password_user',
                        name: 'password',
						label: 'Senha'
                    },
					{
						xtype: 'hiddenfield',
						name: 'id',
						hidden: true,
						id: 'id_user',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_user',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

