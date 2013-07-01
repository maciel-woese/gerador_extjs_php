/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.perfil.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.perfilform',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormPerfil',
        url: 'server/modulos/perfil/save.php',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Perfil',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: 'Back',
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
                        text: 'Save'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
					{
                        xtype: 'textfield',
						id: 'perfil_perfil',
						name: 'perfil',
						label: 'Profile'
                    },
					{
						xtype: 'hiddenfield',
						name: 'id',
						hidden: true,
						id: 'id_perfil',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_perfil',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

