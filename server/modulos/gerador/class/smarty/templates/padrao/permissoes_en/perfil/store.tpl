/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StorePerfil', {
    extend: 'Ext.data.Store',
    requires: [
        '{$app|capitalize}.model.ModelPerfil'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StorePerfil',
            model: '{$app|capitalize}.model.ModelPerfil',
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
	            url : 'server/modulos/perfil/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridPerfil')){
				Ext.getCmp('GridPerfil').getEl().mask('Wait Loading Data...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridPerfil')){
				Ext.getCmp('GridPerfil').getEl().unmask();
			}	
  		});
    }
});
