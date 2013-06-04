/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelEstados', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'sigla',								 
			type: 'string'
		},				
		{
			name: 'descricao',								 
			type: 'string'
		}				
    ]
});