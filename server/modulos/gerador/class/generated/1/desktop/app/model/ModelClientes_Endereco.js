/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelClientes_Endereco', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'controle',								 
			type: 'int'
		},				
		{
			name: 'nome_completo',								 
			type: 'string'
		},				
		{
			name: 'cod_cliente',								 
			type: 'int'
		},				
		{
			name: 'descricao',								 
			type: 'string'
		},				
		{
			name: 'estado',								 
			type: 'string'
		},				
		{
			name: 'loc_nome',								 
			type: 'string'
		},				
		{
			name: 'cidade',								 
			type: 'string'
		},				
		{
			name: 'bairro_nome',								 
			type: 'string'
		},				
		{
			name: 'bairro',								 
			type: 'string'
		},				
		{
			name: 'logradouro',								 
			type: 'string'
		},				
		{
			name: 'num_end',								 
			type: 'string'
		},				
		{
			name: 'complemento',								 
			type: 'string'
		},				
		{
			name: 'cep',								 
			type: 'string'
		},				
		{
			name: 'cx_postal',								 
			type: 'string'
		}				
    ]
});