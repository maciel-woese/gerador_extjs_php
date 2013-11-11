/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreCorreios_Enderecos', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelCorreios_Enderecos'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreCorreios_Enderecos',
            model: 'ShSolutions.model.ModelCorreios_Enderecos',
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
	            url : 'server/modulos/correios_enderecos/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridCorreios_Enderecos')){
				Ext.getCmp('GridCorreios_Enderecos').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridCorreios_Enderecos')){
				Ext.getCmp('GridCorreios_Enderecos').getEl().unmask();
			}	
  		});
    }
});
