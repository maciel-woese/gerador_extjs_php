/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelVeiculos', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'veiculo',								 
			type: 'string'
		},				
		{
			name: 'passageiros',								 
			type: 'int'
		}				
    ]
});