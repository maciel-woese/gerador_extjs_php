/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelUsuarios', {
    extend: 'Ext.data.Model',

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
			name: 'filial',								 
			type: 'string'
		},				
		{
			name: 'filial_id',								 
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
    ]
});