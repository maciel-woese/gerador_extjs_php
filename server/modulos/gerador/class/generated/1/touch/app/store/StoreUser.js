/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreUser', {
    extend: 'Ext.data.Store',
    alias: 'store.storeuser',

    requires: [
        'ShSolutions.model.ModelUser'
    ],

    config: {
        model: 'ShSolutions.model.ModelUser',
        storeId: 'StoreUser',
		sorters: [
			{
				direction: 'ASC',
				property: 'id'
			}
		],
        proxy: {
            type: 'ajax',
			url: 'server/modulos/user/list.php',
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
