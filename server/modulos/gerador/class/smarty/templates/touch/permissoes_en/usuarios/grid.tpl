/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.usuarios.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.usuarioslist',

    config: {
        id: 'GridUsuarios',
		fullscreen: true,
		store: 'StoreUsuarios',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
			{$item_tpl}
			{
				setAdministrador: function(v){
					switch(v){
						case '1':
						return 'Yes';
					  	break;
						case '2':
						return 'No';
					  	break;
 					
					}
				},				
				setStatus: function(v){
					switch(v){
						case '1':
						return 'ON';
					  	break;
						case '2':
						return 'OFF';
					  	break;
 					
					}
				}
			}
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
                title: 'Usuarios',
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

