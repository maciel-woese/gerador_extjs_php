/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelProduct', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
			{
				name: 'id',								
				type: 'int'
			},				
			{
				name: 'code',								
				type: 'string'
			},				
			{
				name: 'product',								
				type: 'string'
			},				
			{
				name: 'quantity',								
				type: 'int'
			}				
    	],
		
		validations: [
			{
				type: 'presence',
				field: 'code',
				message: 'Código &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'product',
				message: 'Produto &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'quantity',
				message: 'Quantidade &eacute; Obrigat&oacute;rio.'
			}
		]
    }	
});