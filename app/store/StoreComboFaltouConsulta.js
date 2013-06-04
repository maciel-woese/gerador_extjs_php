/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreComboFaltouConsulta', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelComboLocal'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: 'ShSolutions.model.ModelComboLocal',
   	        data: [
				{
					id: 'S',
					descricao: 'Sim'
				},				
				{
					id: 'N',
					descricao: 'Não'
				}				
   	        	
   	        ]
        }, cfg)]);
        
    }
});
