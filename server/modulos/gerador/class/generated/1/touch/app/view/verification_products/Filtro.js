Ext.define('ShSolutions.view.verification_products.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.verification_productsfilter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormVerification_ProductsFilter',
        url: 'server/modulos/verification_products/list.php',
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
                        xtype: 'numberfield',
						id: 'verification_id_filter_verification_products',
                        label: 'Verification Id',
						name: 'verification_id'
                    },
	
					{
                        xtype: 'numberfield',
						id: 'product_id_filter_verification_products',
                        label: 'Product Id',
						name: 'product_id'
                    },
	
					{
                        xtype: 'numberfield',
						id: 'quantity1_filter_verification_products',
                        label: 'Quantidade 1',
						name: 'quantity1'
                    },
	
					{
                        xtype: 'numberfield',
						id: 'quantity2_filter_verification_products',
                        label: 'Quantidade 2',
						name: 'quantity2'
                    },
	
					{
                        xtype: 'numberfield',
						id: 'quantity_finish_filter_verification_products',
                        label: 'Quantidade Final',
						name: 'quantity_finish'
                    },
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_verification_products',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


