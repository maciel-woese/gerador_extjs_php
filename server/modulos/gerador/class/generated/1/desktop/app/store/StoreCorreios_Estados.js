/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreCorreios_Estados', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelCorreios_Estados'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreCorreios_Estados',
            model: 'ShSolutions.model.ModelCorreios_Estados',
            remoteSort: true,
            sorters: [
            	{
            		direction: 'ASC',
            		property: 'id'
            	}
            ],
   	        proxy: {
            	type: 'ajax',
				extraParams: {
					action: 'LIST'
				},
		    	actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },	
	            url : 'server/modulos/correios_estados/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridCorreios_Estados')){
				Ext.getCmp('GridCorreios_Estados').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridCorreios_Estados')){
				Ext.getCmp('GridCorreios_Estados').getEl().unmask();
			}	
  		});
    }
});
