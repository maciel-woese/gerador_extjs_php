/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.model.ModelPerfil', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'perfil',								 
			type: 'string'
		}				
    ]
});