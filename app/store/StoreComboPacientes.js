/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreComboPacientes', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelCombo'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: 'ShSolutions.model.ModelCombo',
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
	            url : 'server/modulos/pacientes/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
    }
});
