Ext.define('ShSolutions.view.user.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.userfilter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormUserFilter',
        url: 'server/modulos/user/list.php',
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
                        ui: 'decline',
						action: 'reset',
                        text: 'Resetar'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'filter',
                        text: 'Filtrar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
	
					{
                        xtype: 'textfield',
						id: 'name_filter_user',
                        label: 'Nome',
						name: 'name'
                    },
	
					{
                        xtype: 'passwordfield',
                        label: 'Senha',
						id: 'password_filter_user',
						name: 'password'
                    },
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_user',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


