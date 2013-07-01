/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StoreUsuarios', {
    extend: 'Ext.data.Store',
    requires: [
        '{$app|capitalize}.model.ModelUsuarios'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreUsuarios',
            model: '{$app|capitalize}.model.ModelUsuarios',
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
	            url : 'server/modulos/usuarios/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridUsuarios')){
				Ext.getCmp('GridUsuarios').getEl().mask('Wait Loading Data...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridUsuarios')){
				Ext.getCmp('GridUsuarios').getEl().unmask();
			}	
  		});
    }
});
