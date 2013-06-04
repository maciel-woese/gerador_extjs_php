/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreComboExportarUsuarios', {
    extend: 'Ext.data.Store',
    requires: [
        'ShSolutions.model.ModelComboLocal'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: 'ShSolutions.model.ModelComboLocal',
   	        data: [
				{
					id: '1',
					descricao: 'Sim'
				},				
				{
					id: '0',
					descricao: 'Não'
				}				
   	        	
   	        ]
        }, cfg)]);
        
    }
});
