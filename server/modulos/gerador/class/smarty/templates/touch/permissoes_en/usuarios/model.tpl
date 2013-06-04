/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.model.ModelUsuarios', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
			{
				name: 'id',								
				type: 'int'
			},				
			{
				name: 'nome',								
				type: 'string'
			},				
			{
				name: 'perfil',								
				type: 'string'
			},				
			{
				name: 'perfil_id',								
				type: 'int'
			},				
			{
				name: 'email',								
				type: 'string'
			},				
			{
				name: 'login',								
				type: 'string'
			},				
			{
				name: 'senha',								
				type: 'string'
			},				
			{
				name: 'administrador',								
				type: 'string'
			},				
			{
				name: 'status',								
				type: 'string'
			}				
    	],
		
		validations: [
			{
				type: 'presence',
				field: 'nome',
				message: 'Name is Required.'
			},
			{
				type: 'presence',
				field: 'perfil_id',
				message: 'Profile is Required.'
			},
			{
				type: 'presence',
				field: 'email',
				message: 'Email is Required.'
			},
			{
                type: 'email',
                field: 'email',
				message: 'E-mail Invalid.'
            },
			{
				type: 'presence',
				field: 'login',
				message: 'Login is Required.'
			},
			{
				type: 'presence',
				field: 'senha',
				message: 'Password is Required.'
			},
			{
				type: 'presence',
				field: 'administrador',
				message: 'Administrator is Required.'
			},
			{
				type: 'presence',
				field: 'status',
				message: 'Status is Required.'
			}
		]
    }	
});