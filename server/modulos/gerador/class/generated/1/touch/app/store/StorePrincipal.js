Ext.define('ShSolutions.store.StorePrincipal', {
    extend: 'Ext.data.Store',
    alias: 'store.storeprincipal',

    requires: [
        'ShSolutions.model.ModelPrincipal'
    ],

    config: {
        model: 'ShSolutions.model.ModelPrincipal',
        storeId: 'StorePrincipal',
        proxy: {
            type: 'ajax',
			url: 'server/modulos/menu.php',
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