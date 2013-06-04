/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreGeneratedChart', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelGeneratedChart'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreGeneratedChart',
			autoLoad: true,
            model: 'ShSolutions.model.ModelGeneratedChart',
   	        proxy: {
            	type: 'ajax',
				extraParams: {
					action: 'LIST_CHART'
				},
		    	actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },	
	            url : 'server/modulos/generated/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
    }
});
