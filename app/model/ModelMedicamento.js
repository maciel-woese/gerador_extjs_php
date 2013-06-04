/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelMedicamento', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'medicamento',								 
			type: 'string'
		},				
		{
			name: 'codigo_barras',								 
			type: 'string'
		},				
		{
			name: 'laboratorio',								 
			type: 'string'
		},				
		{
			name: 'laboratorio_id',								 
			type: 'int'
		},				
		{
			name: 'quantidade',								 
			type: 'int'
		},				
		{
			name: 'quantidade_minima',								 
			type: 'int'
		},				
		{
			name: 'obs',								 
			type: 'string'
		},				
		{
			name: 'status',								 
			type: 'string'
		}				
    ]
});