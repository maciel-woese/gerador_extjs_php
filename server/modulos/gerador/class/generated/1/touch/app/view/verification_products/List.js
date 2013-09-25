/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.verification_products.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.verification_productslist',

    config: {
        id: 'GridVerification_Products',
		fullscreen: true,
		store: 'StoreVerification_Products',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
						
			'<div class="gridlist"><b>Verification Id: </b> {verification_id}</div>',			
			'<div class="gridlist"><b>Product Id: </b> {product_id}</div>',			
			'<div class="gridlist"><b>Quantidade 1: </b> {quantity1}</div>',			
			'<div class="gridlist"><b>Quantidade 2: </b> {quantity2}</div>',			
			'<div class="gridlist"><b>Quantidade Final: </b> {quantity_finish}</div>',			
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
                title: 'Verification_Products',
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

