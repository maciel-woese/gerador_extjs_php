/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreVerification_Products', {
    extend: 'Ext.data.Store',
    alias: 'store.storeverification_products',

    requires: [
        'ShSolutions.model.ModelVerification_Products'
    ],

    config: {
        model: 'ShSolutions.model.ModelVerification_Products',
        storeId: 'StoreVerification_Products',
		sorters: [
			{
				direction: 'ASC',
				property: 'id'
			}
		],
        proxy: {
            type: 'ajax',
			url: 'server/modulos/verification_products/list.php',
			extraParams: {
                action: 'LIST'
            },
            actionMethods: {
		        create : 'POST',
		        read   : 'POST',
		        update : 'POST',
		        destroy: 'POST'
		    },
            reader: {
                type: 'json',
                rootProperty: 'dados'
            }
        }
    }
});
