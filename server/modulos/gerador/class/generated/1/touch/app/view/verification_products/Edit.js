/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.verification_products.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.verification_productsform',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormVerification_Products',
        url: 'server/modulos/verification_products/save.php',
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
                        ui: 'confirm',
						action: 'salvar',
                        text: 'Salvar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
					{
                        xtype: 'numberfield',
						id: 'verification_id_verification_products',
						name: 'verification_id',
						label: 'Verification Id'
                    },
					{
                        xtype: 'numberfield',
						id: 'product_id_verification_products',
						name: 'product_id',
						label: 'Product Id'
                    },
					{
                        xtype: 'numberfield',
						id: 'quantity1_verification_products',
						name: 'quantity1',
						label: 'Quantidade 1'
                    },
					{
                        xtype: 'numberfield',
						id: 'quantity2_verification_products',
						name: 'quantity2',
						label: 'Quantidade 2'
                    },
					{
                        xtype: 'numberfield',
						id: 'quantity_finish_verification_products',
						name: 'quantity_finish',
						label: 'Quantidade Final'
                    },
					{
						xtype: 'hiddenfield',
						name: 'id',
						hidden: true,
						id: 'id_verification_products',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_verification_products',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

