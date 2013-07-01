/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StoreComboStatusUsuarios', {
    extend: 'Ext.data.Store',
    alias: 'store.storeusuarios',

    requires: [
        '{$app|capitalize}.model.ModelCombo'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelCombo',
        storeId: 'StoreComboStatusUsuarios',
		data: [
			{
				id: '1',
				descricao: 'Ativo'
			},				
			{
				id: '2',
				descricao: 'Desativado'
			}				
   	        	
   	    ]
    }
});


