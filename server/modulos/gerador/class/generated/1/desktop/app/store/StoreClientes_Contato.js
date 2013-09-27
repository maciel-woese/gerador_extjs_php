/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreClientes_Contato', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelClientes_Contato'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreClientes_Contato',
            model: 'ShSolutions.model.ModelClientes_Contato',
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
	            url : 'server/modulos/clientes_contato/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridClientes_Contato')){
				Ext.getCmp('GridClientes_Contato').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridClientes_Contato')){
				Ext.getCmp('GridClientes_Contato').getEl().unmask();
			}	
  		});
    }
});
