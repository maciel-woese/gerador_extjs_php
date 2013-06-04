{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.store.Store{$TABELA|capitalize}', {
    extend: 'Ext.data.Store',
    requires: [
        '{$app|capitalize}.model.Model{$TABELA|capitalize}'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'Store{$TABELA|capitalize}',
            model: '{$app|capitalize}.model.Model{$TABELA|capitalize}',
            remoteSort: true,
            sorters: [
            	{
            		direction: 'ASC',
            		property: '{$CHAVE}'
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
	            url : 'server/modulos/{$TABELA}/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('Grid{$TABELA|capitalize}')){
				Ext.getCmp('Grid{$TABELA|capitalize}').getEl().mask('{$store_load_data}');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('Grid{$TABELA|capitalize}')){
				Ext.getCmp('Grid{$TABELA|capitalize}').getEl().unmask();
			}	
  		});
    }
});
