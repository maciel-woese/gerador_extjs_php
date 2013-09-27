/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreClientes', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelClientes'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreClientes',
            model: 'ShSolutions.model.ModelClientes',
            remoteSort: true,
            sorters: [
            	{
            		direction: 'ASC',
            		property: 'cod_cliente'
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
	            url : 'server/modulos/clientes/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridClientes')){
				Ext.getCmp('GridClientes').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridClientes')){
				Ext.getCmp('GridClientes').getEl().unmask();
			}	
  		});
    }
});
