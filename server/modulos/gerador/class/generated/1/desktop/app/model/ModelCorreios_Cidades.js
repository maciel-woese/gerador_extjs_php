/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelCorreios_Cidades', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'loc_nome_abreviado',								 
			type: 'string'
		},				
		{
			name: 'loc_nome',								 
			type: 'string'
		},				
		{
			name: 'cep',								 
			type: 'string'
		},				
		{
			name: 'uf_sigla',								 
			type: 'string'
		},				
		{
			name: 'loc_tipo',								 
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