/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelEntrada_Produtos', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'nota',								 
			type: 'string'
		},				
		{
			name: 'entrada_id',								 
			type: 'int'
		},				
		{
			name: 'medicamento',								 
			type: 'string'
		},				
		{
			name: 'medicamento_id',								 
			type: 'int'
		},				
		{
			name: 'quantidade',								 
			type: 'int'
		}				
    ]
});