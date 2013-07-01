/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StoreUsuarios', {
    extend: 'Ext.data.Store',
    alias: 'store.storeusuarios',

    requires: [
        '{$app|capitalize}.model.ModelUsuarios'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelUsuarios',
        storeId: 'StoreUsuarios',
        proxy: {
            type: 'ajax',
			url: 'server/modulos/usuarios/list.php',
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
