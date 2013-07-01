{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.store.StoreCombo{$TABELA|capitalize}', {
    extend: 'Ext.data.Store',
    alias: 'store.store{$TABELA}',

    requires: [
        '{$app|capitalize}.model.ModelCombo'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelCombo',
        storeId: 'StoreCombo{$TABELA|capitalize}',
        proxy: {
            type: 'ajax',
			url: 'server/modulos/{$TABELA}/list.php',
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

