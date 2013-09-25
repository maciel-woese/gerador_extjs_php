/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreVerification', {
    extend: 'Ext.data.Store',
    alias: 'store.storeverification',

    requires: [
        'ShSolutions.model.ModelVerification'
    ],

    config: {
        model: 'ShSolutions.model.ModelVerification',
        storeId: 'StoreVerification',
		sorters: [
			{
				direction: 'ASC',
				property: 'id'
			}
		],
        proxy: {
            type: 'ajax',
			url: 'server/modulos/verification/list.php',
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
