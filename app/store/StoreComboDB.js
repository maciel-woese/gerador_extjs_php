

Ext.define('ShSolutions.store.StoreComboDB', {
    extend: 'Ext.data.Store',
    alias: 'store.storecombodb',
    requires: [
        'ShSolutions.model.ModelComboDB'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreComboDB',
            model: 'ShSolutions.model.ModelComboDB',
            proxy: {
                type: 'ajax',
                extraParams: {
					action: 'LIST_TABLES'
				},
                actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },
                url: 'server/tabela.php',
                reader: {
                    type: 'json',
                    root: 'dados'
                }
            }
        }, cfg)]);
    }
});