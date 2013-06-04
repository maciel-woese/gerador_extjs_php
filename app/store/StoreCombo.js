
Ext.define('ShSolutions.store.StoreCombo', {
    extend: 'Ext.data.Store',
    alias: 'store.storecombo',
    requires: [
        'ShSolutions.model.ModelComboDB'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreCombo',
            model: 'ShSolutions.model.ModelComboDB',
            data: [
                
            ],
            proxy: {
                type: 'ajax',
                reader: {
                    type: 'json',
                    root: 'dados'
                }
            }
        }, cfg)]);
    }
});