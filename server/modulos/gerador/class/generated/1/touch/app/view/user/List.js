/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.user.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.userlist',

    config: {
        id: 'GridUser',
		fullscreen: true,
		store: 'StoreUser',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
						
			'<div class="gridlist"><b>Nome: </b> {name}</div>',			
			'<div class="gridlist"><b>Senha: </b> {password}</div>',			
			{

			}
        ),
        plugins: [
	        {
	            xclass: 'Ext.plugin.ListPaging',
				loadMoreText: 'Carregar mais...',
				noMoreRecordsText: 'N&atilde;o &agrave; mais registros',
	            autoPaging: true
	        }
	    ],
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
						action: 'adicionar',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'editar',
						iconCls: 'compose',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'deletar',
						iconCls: 'delete',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'search',
						iconCls: 'search',
						iconMask: true
					}
				]
			}
               
        ]
    }

});

