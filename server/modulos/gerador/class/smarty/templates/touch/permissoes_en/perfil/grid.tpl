/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.perfil.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.perfillist',

    config: {
        id: 'GridPerfil',
		fullscreen: true,
		store: 'StorePerfil',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
			{$item_tpl}
        ),
        plugins: [
	        {
	            xclass: 'Ext.plugin.ListPaging',
	            autoPaging: true
	        }
	    ],
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
						action: 'back_menu'
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
						iconCls: 'add',
						hidden: true,
						action: 'adicionar',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'editar',
						hidden: true,
						iconCls: 'compose',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'deletar',
						hidden: true,
						iconCls: 'delete',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'search',
						iconCls: 'search',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'modulos',
						iconCls: 'acao',
						iconMask: true
					}
				]
			}
               
        ]
    }

});

