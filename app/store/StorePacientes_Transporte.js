/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StorePacientes_Transporte', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelPacientes_Transporte'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StorePacientes_Transporte',
            model: 'ShSolutions.model.ModelPacientes_Transporte',
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
	            url : 'server/modulos/pacientes_transporte/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridPacientes_Transporte')){
				Ext.getCmp('GridPacientes_Transporte').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridPacientes_Transporte')){
				Ext.getCmp('GridPacientes_Transporte').getEl().unmask();
			}	
  		});
    }
});
