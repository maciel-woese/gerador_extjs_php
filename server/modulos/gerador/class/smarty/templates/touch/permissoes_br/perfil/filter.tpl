Ext.define('{$app|capitalize}.view.perfil.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.perfilfilter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormPerfilFilter',
        url: 'server/modulos/perfil/list.php',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Perfil',
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
						id: 'perfil_filter_perfil',
                        label: 'Perfil',
						name: 'perfil'
                    },
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_perfil',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


