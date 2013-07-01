/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelGenerated', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'project',								 
			type: 'string'
		},
		{
			name: 'usuario',								 
			type: 'string'
		},				
		{
			name: 'usuario_id',								 
			type: 'int'
		},				
		{
			name: 'data',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'versao',								 
			type: 'string'
		},				
		{
			name: 'ip',								 
			type: 'string'
		},				
		{
			name: 'project_zip',								 
			type: 'string'
		},			
		{
			name: 'layout',								 
			type: 'string'
		},				
		{
			name: 'server',								 
			type: 'string'
		}				
    ]
});