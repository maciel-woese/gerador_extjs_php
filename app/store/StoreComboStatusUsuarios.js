/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.store.StoreComboStatusUsuarios', {
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
					descricao: 'Ativo'
				},				
				{
					id: '2',
					descricao: 'Desativado'
				}				
   	        	
   	        ]
        }, cfg)]);
        
    }
});
