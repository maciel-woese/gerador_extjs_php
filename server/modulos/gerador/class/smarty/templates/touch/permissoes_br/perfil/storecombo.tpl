/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StoreComboPerfil', {
    extend: 'Ext.data.Store',
    alias: 'store.storeperfil',

    requires: [
        '{$app|capitalize}.model.ModelCombo'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelCombo',
        storeId: 'StoreComboPerfil',
        proxy: {
            type: 'ajax',
			url: 'server/modulos/perfil/list.php',
			extraParams: {
                action: 'LIST_COMBO'
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

