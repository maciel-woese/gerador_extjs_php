/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreComboTipo_ClienteClientes', {
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
					id: 'F',
					descricao: 'Fisica'
				},				
				{
					id: 'J',
					descricao: 'Juridica'
				}				
   	        	
   	        ]
        }, cfg)]);
        
    }
});
