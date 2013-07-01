/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.model.ModelPerfil', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
			{
				name: 'id',								
				type: 'int'
			},				
			{
				name: 'perfil',								
				type: 'string'
			}				
    	],
		
		validations: [
			{
				type: 'presence',
				field: 'perfil',
				message: 'Profile is Required.'
			}
		]
    }	
});