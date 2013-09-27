/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelClientes', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'cod_cliente',								 
			type: 'int'
		},				
		{
			name: 'tipo_cliente',								 
			type: 'string'
		},				
		{
			name: 'nome_completo',								 
			type: 'string'
		},				
		{
			name: 'razao_social',								 
			type: 'string'
		},				
		{
			name: 'nome_fantasia',								 
			type: 'string'
		},				
		{
			name: 'pessoa_contato',								 
			type: 'string'
		},				
		{
			name: 'data_nascimento',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'sexo',								 
			type: 'string'
		},				
		{
			name: 'cpf',								 
			type: 'string'
		},				
		{
			name: 'cnpj',								 
			type: 'string'
		},				
		{
			name: 'ie',								 
			type: 'string'
		},				
		{
			name: 'im',								 
			type: 'string'
		},				
		{
			name: 'identidade',								 
			type: 'string'
		},				
		{
			name: 'profissao',								 
			type: 'string'
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
			name: 'cadastrado_por',								 
			type: 'string'
		},				
		{
			name: 'data_alteracao_time',			
			dateFormat: 'H:i:s',					 
			type: 'date'
		},				
		{
			name: 'data_alteracao_date',			
			dateFormat: 'Y-m-d',					 
			type: 'date'
		},				
		{
			name: 'data_alteracao',			
			dateFormat: 'Y-m-d H:i:s',					 
			type: 'date'
		},				
		{
			name: 'situacao_cadastral',								 
			type: 'string'
		}				
    ]
});