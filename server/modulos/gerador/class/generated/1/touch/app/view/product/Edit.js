/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.product.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.productform',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormProduct',
        url: 'server/modulos/product/save.php',
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
                        xtype: 'textfield',
						id: 'code_product',
						name: 'code',
						label: 'Código'
                    },
					{
                        xtype: 'textfield',
						id: 'product_product',
						name: 'product',
						label: 'Produto'
                    },
					{
                        xtype: 'numberfield',
						id: 'quantity_product',
						name: 'quantity',
						label: 'Quantidade'
                    },
					{
						xtype: 'hiddenfield',
						name: 'id',
						hidden: true,
						id: 'id_product',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_product',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

