/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelMedico', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'medico',								 
			type: 'string'
		},				
		{
			name: 'crm',								 
			type: 'string'
		},				
		{
			name: 'especialidade',								 
			type: 'string'
		},				
		{
			name: 'especialidade_id',								 
			type: 'int'
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
			name: 'telefone',								 
			type: 'string'
		}				
    ]
});