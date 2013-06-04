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
			name: 'data_cadastro',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
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
			name: 'grupo',								 
			type: 'string'
		},				
		{
			name: 'id_grupo',								 
			type: 'int'
		},				
		{
			name: 'status',								 
			type: 'string'
		},				
		{
			name: 'exportar',								 
			type: 'string'
		}				
    ]
});