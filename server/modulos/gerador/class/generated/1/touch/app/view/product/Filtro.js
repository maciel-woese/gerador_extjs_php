Ext.define('ShSolutions.view.product.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.productfilter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormProductFilter',
        url: 'server/modulos/product/list.php',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Product',
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
						id: 'code_filter_product',
                        label: 'Código',
						name: 'code'
                    },
	
					{
                        xtype: 'textfield',
						id: 'product_filter_product',
                        label: 'Produto',
						name: 'product'
                    },
	
					{
                        xtype: 'numberfield',
						id: 'quantity_filter_product',
                        label: 'Quantidade',
						name: 'quantity'
                    },
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_product',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


