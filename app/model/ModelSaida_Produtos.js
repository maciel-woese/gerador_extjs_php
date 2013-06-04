/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelSaida_Produtos', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'data_cadastro',								 
			type: 'string'
		},				
		{
			name: 'saida_id',								 
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