/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreCorreios_Cidades', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelCorreios_Cidades'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreCorreios_Cidades',
            model: 'ShSolutions.model.ModelCorreios_Cidades',
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
	            url : 'server/modulos/correios_cidades/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridCorreios_Cidades')){
				Ext.getCmp('GridCorreios_Cidades').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridCorreios_Cidades')){
				Ext.getCmp('GridCorreios_Cidades').getEl().unmask();
			}	
  		});
    }
});
