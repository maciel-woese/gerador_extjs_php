/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelEspecialidades', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'especialidade',								 
			type: 'string'
		},				
		{
			name: 'obs',								 
			type: 'string'
		}				
    ]
});