/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreAgendamento_Exame', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelAgendamento_Exame'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreAgendamento_Exame',
            model: 'ShSolutions.model.ModelAgendamento_Exame',
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
	            url : 'server/modulos/agendamento_exame/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridAgendamento_Exame')){
				Ext.getCmp('GridAgendamento_Exame').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridAgendamento_Exame')){
				Ext.getCmp('GridAgendamento_Exame').getEl().unmask();
			}	
  		});
    }
});
