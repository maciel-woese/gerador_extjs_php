Ext.define('ShSolutions.model.ModelPrincipal', {
    extend: 'Ext.data.Model',
    alias: 'model.modelprincipal',
	
	config: {
	    fields: [
	        {
                name: 'modulo'
            },
            {
                name: 'descricao'
            },
            {
                name: 'action'
            },
            {
                name: 'iconCls'
            }
	    ]
    }
});

