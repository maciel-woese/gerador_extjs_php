{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.store.StoreCombo{$campo}{$TABELA|capitalize}', {
    extend: 'Ext.data.Store',
    alias: 'store.store{$TABELA}',

    requires: [
        '{$app|capitalize}.model.ModelCombo'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelCombo',
        storeId: 'StoreCombo{$campo}{$TABELA|capitalize}',
		data: [
{foreach from=$data item=field name=columns}
			{
				id: '{$field.id}',
				descricao: '{$field.descricao}'
			}{if $smarty.foreach.columns.index!={$smarty.foreach.columns.total}-1},{/if}
				
{/foreach}   	        	
   	    ]
    }
});


