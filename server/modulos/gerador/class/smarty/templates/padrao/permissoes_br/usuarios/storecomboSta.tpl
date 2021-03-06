/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StoreComboStatusUsuarios', {
    extend: 'Ext.data.Store',
    requires: [
        '{$app|capitalize}.model.ModelComboLocal'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: '{$app|capitalize}.model.ModelComboLocal',
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
        }, cfg)]);
        
    }
});
