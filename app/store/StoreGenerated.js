/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreGenerated', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelGenerated'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreGenerated',
			groupField: 'usuario_id',
            model: 'ShSolutions.model.ModelGenerated',
            sorters: [
            	{
            		direction: 'DESC',
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
	            url : 'server/modulos/generated/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridGenerated')){
				Ext.getCmp('GridGenerated').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridGenerated')){
				Ext.getCmp('GridGenerated').getEl().unmask();
			}	
  		});
    }
});
