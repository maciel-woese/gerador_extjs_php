/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelVerification', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
			{
				name: 'id',								
				type: 'int'
			},				
			{
				name: 'user_id',								
				type: 'int'
			},				
			{
				name: 'date_start_time',				
				dateFormat: 'H:i:s',				
				type: 'string'
			},				
			{
				name: 'date_start_date',				
				dateFormat: 'Y-m-d',				
				type: 'date'
			},				
			{
				name: 'date_start',				
				dateFormat: 'Y-m-d H:i:s',				
				type: 'date'
			},				
			{
				name: 'date_finish_time',				
				dateFormat: 'H:i:s',				
				type: 'string'
			},				
			{
				name: 'date_finish_date',				
				dateFormat: 'Y-m-d',				
				type: 'date'
			},				
			{
				name: 'date_finish',				
				dateFormat: 'Y-m-d H:i:s',				
				type: 'date'
			}				
    	],
		
		validations: [
			{
				type: 'presence',
				field: 'user_id',
				message: 'User Id &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'date_start',
				message: 'Data Inicial &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'date_finish',
				message: 'Date Final &eacute; Obrigat&oacute;rio.'
			}
		]
    }	
});