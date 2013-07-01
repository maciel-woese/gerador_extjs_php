/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StoreComboAdministradorUsuarios', {
    extend: 'Ext.data.Store',
    alias: 'store.storeusuarios',

    requires: [
        '{$app|capitalize}.model.ModelCombo'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelCombo',
        storeId: 'StoreComboAdministradorUsuarios',
		data: [
			{
				id: '1',
				descricao: 'Sim'
			},				
			{
				id: '2',
				descricao: 'Não'
			}				
   	        	
   	    ]
    }
});


