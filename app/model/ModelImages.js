/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelImages', {
	extend: 'Ext.data.Model',

	fields: [
		{
			name: 'id'
		},
		{
			name: 'modulo'
		},
		{
			name: 'descricao',
			type: 'string'
		},
		{
			name: 'src',
			type: 'string'
		}
	]
});