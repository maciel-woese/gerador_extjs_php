/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelComboLocal', {
	extend: 'Ext.data.Model',

	fields: [
		{
			name: 'id',
			type: 'auto'
		},
		{
			name: 'descricao',
			type: 'string'
		}
	]
});