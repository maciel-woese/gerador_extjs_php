Ext.define('{$app|capitalize}.store.StorePermissoes', {
    extend: 'Ext.data.TreeStore',

    requires: [
        '{$app|capitalize}.model.ModelPermissoes'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StorePermissoes',
            root: {
		        text: "M&oacute;dulos",
		        expanded: true
		    },
            model: '{$app|capitalize}.model.ModelPermissoes',
            proxy: {
                type: 'ajax',
                extraParams: {
					action: ''
				},
		    	actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },	
                url: 'server/modulos/permissoes/list.php',
                reader: {
                    type: 'json'
                }
            }
        }, cfg)]);
    }
});