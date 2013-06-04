/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelFilial', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'filial',								 
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
			name: 'telefone',								 
			type: 'string'
		}				
    ]
});