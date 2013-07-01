{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.model.ModelCombo', {
	extend: 'Ext.data.Model',

	fields: [
		{
			name: 'id',
			type: 'int'
		},
		{
			name: 'descricao',
			type: 'string'
		}
	]
});