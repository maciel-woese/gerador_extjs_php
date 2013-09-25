/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelVerification_Products', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
			{
				name: 'id',								
				type: 'int'
			},				
			{
				name: 'verification_id',								
				type: 'int'
			},				
			{
				name: 'product_id',								
				type: 'int'
			},				
			{
				name: 'quantity1',								
				type: 'int'
			},				
			{
				name: 'quantity2',								
				type: 'int'
			},				
			{
				name: 'quantity_finish',								
				type: 'int'
			}				
    	],
		
		validations: [
			{
				type: 'presence',
				field: 'verification_id',
				message: 'Verification Id &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'product_id',
				message: 'Product Id &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'quantity1',
				message: 'Quantidade 1 &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'quantity2',
				message: 'Quantidade 2 &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'quantity_finish',
				message: 'Quantidade Final &eacute; Obrigat&oacute;rio.'
			}
		]
    }	
});