/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.model.ModelClientes_Anotacoes', {
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
			name: 'anotacao',								 
			type: 'auto'
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
		},				
		{
			name: 'ativo',								 
			type: 'string'
		}				
    ]
});