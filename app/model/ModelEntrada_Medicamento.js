/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelEntrada_Medicamento', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'data_cadastro_time',			
			dateFormat: 'H:i:s',					 
			type: 'date'
		},				
		{
			name: 'data_cadastro_date',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'data_cadastro',			
			dateFormat: 'Y-m-d H:i:s',					 
			type: 'date'
		},				
		{
			name: 'nome',								 
			type: 'string'
		},				
		{
			name: 'usuario_id',								 
			type: 'int'
		},				
		{
			name: 'fornecedor',								 
			type: 'string'
		},				
		{
			name: 'fornecedor_id',								 
			type: 'int'
		},				
		{
			name: 'nota',								 
			type: 'string'
		}				
    ]
});