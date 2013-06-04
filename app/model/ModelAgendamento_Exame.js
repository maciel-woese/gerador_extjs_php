/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelAgendamento_Exame', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'data_exame_time',			
			dateFormat: 'H:i:s',					 
			type: 'date'
		},				
		{
			name: 'data_exame_date',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'data_exame',			
			dateFormat: 'Y-m-d H:i:s',					 
			type: 'date'
		},				
		{
			name: 'data_entrega_time',			
			dateFormat: 'H:i:s',					 
			type: 'date'
		},				
		{
			name: 'data_entrega_date',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'data_entrega',			
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
			name: 'paciente',								 
			type: 'string'
		},				
		{
			name: 'paciente_id',								 
			type: 'int'
		}				
    ]
});