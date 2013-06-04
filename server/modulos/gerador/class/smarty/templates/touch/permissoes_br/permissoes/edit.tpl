/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.permissoes.Edit', {
    extend: 'Ext.dataview.List',
    alias: 'widget.addpermissoeswin',

    config: {
        id: 'AddPermissoesWin',
		fullscreen: true,
		grouped: true,
		mode: 'MULTI',
		store: 'StorePermissoes',
        itemTpl:  new Ext.XTemplate(
			{$item_tpl}
        ),
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Permiss&otilde;es',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: 'Voltar',
						action: 'back'
                    },
					{
						xtype: 'spacer'
					},
					{
                        xtype: 'button',
                        ui: 'confirm',
						iconMask: true,
						iconCls: 'refresh',
						action: 'refresh'
                    }
				]
            },
			{
				xtype: 'toolbar',
				docked: 'bottom',
				ui: 'light',
				layout: {
					align: 'center',
					pack: 'center',
					type: 'hbox'
				},
				items: [
					{
						xtype: 'button',
                        ui: 'confirm',
						action: 'salvar',
                        text: 'Salvar'
					}
				]
			}
               
        ]
    }

});

