/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelCidades', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'descricao',								 
			type: 'string'
		},				
		{
			name: 'estado_id',								 
			type: 'int'
		},				
		{
			name: 'cidade',								 
			type: 'string'
		}				
    ]
});