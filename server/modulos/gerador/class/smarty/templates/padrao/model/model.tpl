{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.model.Model{$TABELA|capitalize}', {
    extend: 'Ext.data.Model',

    fields: [
{foreach from=$fields item=field name=foo2}
		{
			name: '{$field.nome}',{if $field.type=='date' }
			
			dateFormat: '{$field.format}',{else}
			{/if}					 
			type: '{$field.type}'
		}{if $smarty.foreach.foo2.index!={$smarty.foreach.foo2.total}-1},{/if}
				
{/foreach}
    ]
});