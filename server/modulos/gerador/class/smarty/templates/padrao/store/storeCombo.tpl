{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.store.StoreCombo{$TABELA|capitalize}', {
    extend: 'Ext.data.Store',
    requires: [
        '{$app|capitalize}.model.ModelCombo'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: '{$app|capitalize}.model.ModelCombo',
   	        proxy: {
            	type: 'ajax',
				extraParams: {
					action: 'LIST_COMBO'
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
        
    }
});
