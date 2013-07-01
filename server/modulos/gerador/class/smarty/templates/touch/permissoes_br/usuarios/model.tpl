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
				message: 'Nome &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'perfil_id',
				message: 'Perfil &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'email',
				message: 'Email &eacute; Obrigat&oacute;rio.'
			},
			{
                type: 'email',
                field: 'email',
				message: 'E-mail Inválido.'
            },
			{
				type: 'presence',
				field: 'login',
				message: 'Login &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'senha',
				message: 'Senha &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'administrador',
				message: 'Administrador &eacute; Obrigat&oacute;rio.'
			},
			{
				type: 'presence',
				field: 'status',
				message: 'Status &eacute; Obrigat&oacute;rio.'
			}
		]
    }	
});