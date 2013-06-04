/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StorePerfil', {
    extend: 'Ext.data.Store',
    alias: 'store.storeperfil',

    requires: [
        '{$app|capitalize}.model.ModelPerfil'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelPerfil',
        storeId: 'StorePerfil',
        proxy: {
            type: 'ajax',
			url: 'server/modulos/perfil/list.php',
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
