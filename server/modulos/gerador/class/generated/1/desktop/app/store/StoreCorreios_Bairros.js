/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreCorreios_Bairros', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelCorreios_Bairros'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreCorreios_Bairros',
            model: 'ShSolutions.model.ModelCorreios_Bairros',
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
	            url : 'server/modulos/correios_bairros/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridCorreios_Bairros')){
				Ext.getCmp('GridCorreios_Bairros').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridCorreios_Bairros')){
				Ext.getCmp('GridCorreios_Bairros').getEl().unmask();
			}	
  		});
    }
});
