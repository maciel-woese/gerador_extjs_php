Ext.define('{$app|capitalize}.store.TreeStoreMenu', {
    extend: 'Ext.data.TreeStore',
    requires: [
        '{$app|capitalize}.model.ModelMenu'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'TreeStoreMenu',
            model: 'TreeStoreMenu.model.ModelMenu',
            proxy: {
                type: 'ajax',
                url: 'server/modulos/menu.php',
                reader: {
                    type: 'json'
                }
            }
        }, cfg)]);
    }
});
