/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelAgendamento_Transporte', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'data',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'hora_saida',			
			dateFormat: 'H:i:s',					 
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
			name: 'veiculo',								 
			type: 'string'
		},				
		{
			name: 'veiculo_id',								 
			type: 'int'
		},
		{
			name: 'passageiros',								 
			type: 'int'
		},
		{
			name: 'destino',								 
			type: 'string'
		},				
		{
			name: 'obs',								 
			type: 'string'
		}				
    ]
});