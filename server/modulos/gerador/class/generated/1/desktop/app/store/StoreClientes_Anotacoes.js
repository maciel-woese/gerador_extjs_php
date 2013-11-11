/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreClientes_Anotacoes', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelClientes_Anotacoes'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreClientes_Anotacoes',
            model: 'ShSolutions.model.ModelClientes_Anotacoes',
            remoteSort: true,
            sorters: [
            	{
            		direction: 'ASC',
            		property: 'controle'
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
	            url : 'server/modulos/clientes_anotacoes/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridClientes_Anotacoes')){
				Ext.getCmp('GridClientes_Anotacoes').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridClientes_Anotacoes')){
				Ext.getCmp('GridClientes_Anotacoes').getEl().unmask();
			}	
  		});
    }
});
