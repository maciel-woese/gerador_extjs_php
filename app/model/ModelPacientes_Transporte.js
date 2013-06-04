/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelPacientes_Transporte', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
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
			name: 'acompanhado',								 
			type: 'int'
		},				
		{
			name: 'local_consulta',								 
			type: 'string'
		},				
		{
			name: 'espera',
			type: 'string'
		},				
		{
			name: 'hora',			
			dateFormat: 'H:i:s',					 
			type: 'date'
		},				
		{
			name: 'fone',								 
			type: 'string'
		},				
		{
			name: 'obs',								 
			type: 'string'
		}				
    ]
});