/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreComboFilial', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelCombo'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: 'ShSolutions.model.ModelCombo',
			storeId: 'StoreComboFilial',
   	        proxy: {
            	type: 'ajax',
				extraParams: {
					action: 'LIST_COMBO'
				},
		    	actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },	
	            url : 'server/modulos/filial/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
    }
});
