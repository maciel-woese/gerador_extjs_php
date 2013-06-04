

Ext.define('ShSolutions.store.StoreComboTabelasPDF', {
    extend: 'Ext.data.Store',
    alias: 'store.storecombopdf',
    requires: [
        'ShSolutions.model.ModelComboLocal'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreComboTabelasPDF',
            model: 'ShSolutions.model.ModelComboLocal',
            data: []
        }, cfg)]);
    }
});