/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
Ext.Loader.setConfig({
    enabled: true,
    paths: {
    	'ShSolutions': 'app',
    	'ShSolutions.plugins': 'resources/plugins'
    }
});

Ext.application({
    name: 'ShSolutions',
    controllers: [
		'Desktop'		
    ],
    autoCreateViewport: false,
    winRegistered: new Ext.util.MixedCollection(),
    launch: function() {
    	var me = this;
    	Ext.create('ShSolutions.view.Desktop');
			
		me.dados = Ext.decode(decodeURIComponent(getParams('app.js').key));
    }

});


