/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelCorreios_Enderecos', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'uf_sigla',								 
			type: 'string'
		},				
		{
			name: 'localidade_id',								 
			type: 'int'
		},				
		{
			name: 'nome',								 
			type: 'string'
		},				
		{
			name: 'bairro_id_inicial',								 
			type: 'int'
		},				
		{
			name: 'bairro_id_final',								 
			type: 'int'
		},				
		{
			name: 'cep',								 
			type: 'string'
		},				
		{
			name: 'complemento',								 
			type: 'string'
		},				
		{
			name: 'tipo',								 
			type: 'string'
		},				
		{
			name: 'ativo',								 
			type: 'string'
		},				
		{
			name: 'cadastrado_por',								 
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
		}				
    ]
});