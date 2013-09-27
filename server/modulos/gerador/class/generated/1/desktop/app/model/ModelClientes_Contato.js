/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelClientes_Contato', {
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
			name: 'tipo_contato',								 
			type: 'string'
		},				
		{
			name: 'descricao',								 
			type: 'string'
		},				
		{
			name: 'observacao',								 
			type: 'string'
		}				
    ]
});