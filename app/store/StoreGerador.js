Ext.define('ShSolutions.store.StoreGerador', {
    extend: 'Ext.data.Store',
    alias: 'store.storegerador',
    requires: [
        'ShSolutions.model.ModelGerador'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreGerador',
            model: 'ShSolutions.model.ModelGerador',
            groupField: 'tabela',
            proxy: {
                type: 'ajax',
                extraParams: {
					action: 'LIST_COLUMNS'
				},
                actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },
                url: 'server/modulos/gerador/list.php',
                reader: {
                    type: 'json',
                    root: 'dados'
                }
            }
        }, cfg)]);
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridGerador')){
				Ext.getCmp('GridGerador').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridGerador')){
				Ext.getCmp('GridGerador').getEl().unmask();
			}	
  		});
    }
});