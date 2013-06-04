/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelConsulta', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'data_hora_time',			
			dateFormat: 'H:i:s',					 
			type: 'date'
		},				
		{
			name: 'data_hora_date',			
			dateFormat: 'Y-m-d',
			type: 'date'
		},				
		{
			name: 'data_hora',			
			dateFormat: 'Y-m-d H:i:s',					 
			type: 'date'
		},				
		{
			name: 'faltou',								 
			type: 'string'
		},				
		{
			name: 'medico',								 
			type: 'string'
		},				
		{
			name: 'medico_id',								 
			type: 'int'
		},				
		{
			name: 'paciente',								 
			type: 'string'
		},				
		{
			name: 'paciente_id',								 
			type: 'int'
		},				
		{
			name: 'senha',								 
			type: 'int'
		},				
		{
			name: 'queixa_principal',								 
			type: 'string'
		},				
		{
			name: 'exame_fisico',								 
			type: 'string'
		},				
		{
			name: 'hipotese_diagnostica',								 
			type: 'string'
		},				
		{
			name: 'tratamento',								 
			type: 'string'
		}				
    ]
});