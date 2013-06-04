/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelPacientes', {
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
			name: 'paciente',								 
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
			name: 'tipo_sanguineo',								 
			type: 'string'
		},				
		{
			name: 'rg',								 
			type: 'string'
		},				
		{
			name: 'cpf',								 
			type: 'string'
		},				
		{
			name: 'descricao',								 
			type: 'string'
		},				
		{
			name: 'uf_id',								 
			type: 'int'
		},				
		{
			name: 'cidade',								 
			type: 'string'
		},				
		{
			name: 'cidade_id',								 
			type: 'int'
		},				
		{
			name: 'bairro',								 
			type: 'string'
		},				
		{
			name: 'endereco',								 
			type: 'string'
		},				
		{
			name: 'cep',								 
			type: 'string'
		},				
		{
			name: 'trabalho',								 
			type: 'string'
		},				
		{
			name: 'telefone',								 
			type: 'string'
		},				
		{
			name: 'pai',								 
			type: 'string'
		},				
		{
			name: 'mae',								 
			type: 'string'
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