{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.model.{$name}', {
	extend: 'Ext.data.Model',
	config: {
		fields: [
			{
				name: 'id',
				type: '{$type}'
			},
			{
				name: 'descricao',
				type: 'string'
			}
		]
	}	
});