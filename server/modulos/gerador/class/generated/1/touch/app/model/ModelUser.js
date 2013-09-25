/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelUser', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
			{
				name: 'id',								
				type: 'int'
			},				
			{
				name: 'name',								
				type: 'string'
			},				
			{
				name: 'password',								
				type: 'string'
			}				
    	],
		
		validations: [
			{
				type: 'presence',
				field: 'name',
				message: 'Nome &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'password',
				message: 'Senha &eacute; Obrigat&oacute;rio.'
			}
		]
    }	
});