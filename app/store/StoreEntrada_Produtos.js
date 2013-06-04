/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreEntrada_Produtos', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelEntrada_Produtos'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreEntrada_Produtos',
            model: 'ShSolutions.model.ModelEntrada_Produtos',
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
	            url : 'server/modulos/entrada_produtos/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridEntrada_Produtos')){
				Ext.getCmp('GridEntrada_Produtos').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridEntrada_Produtos')){
				Ext.getCmp('GridEntrada_Produtos').getEl().unmask();
			}	
  		});
    }
});
