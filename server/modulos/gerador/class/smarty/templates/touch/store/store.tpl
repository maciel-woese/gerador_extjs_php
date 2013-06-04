{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.store.Store{$TABELA|capitalize}', {
    extend: 'Ext.data.Store',
    alias: 'store.store{$TABELA}',

    requires: [
        '{$app|capitalize}.model.Model{$TABELA|capitalize}'
    ],

    config: {
        model: '{$app|capitalize}.model.Model{$TABELA|capitalize}',
        storeId: 'Store{$TABELA|capitalize}',
		sorters: [
			{
				direction: 'ASC',
				property: '{$CHAVE}'
			}
		],
        proxy: {
            type: 'ajax',
			url: 'server/modulos/{$TABELA}/list.php',
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
