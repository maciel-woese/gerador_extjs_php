/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreProduct', {
    extend: 'Ext.data.Store',
    alias: 'store.storeproduct',

    requires: [
        'ShSolutions.model.ModelProduct'
    ],

    config: {
        model: 'ShSolutions.model.ModelProduct',
        storeId: 'StoreProduct',
		sorters: [
			{
				direction: 'ASC',
				property: 'id'
			}
		],
        proxy: {
            type: 'ajax',
			url: 'server/modulos/product/list.php',
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
