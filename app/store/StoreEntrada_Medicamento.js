/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreEntrada_Medicamento', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelEntrada_Medicamento'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreEntrada_Medicamento',
            model: 'ShSolutions.model.ModelEntrada_Medicamento',
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
	            url : 'server/modulos/entrada_medicamento/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridEntrada_Medicamento')){
				Ext.getCmp('GridEntrada_Medicamento').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridEntrada_Medicamento')){
				Ext.getCmp('GridEntrada_Medicamento').getEl().unmask();
			}	
  		});
    }
});
