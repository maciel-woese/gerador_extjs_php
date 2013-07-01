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
		'Perfil',		
		'Principal',		
		'Permissoes',		
		'Usuarios'		
    ],
    
    autoCreateViewport: false,
	dados: [],
	
	launch: function(){
		var me = this;
		Ext.widget('containerprincipal').show();
			
		me.dados = key;

		Ext.get('loading').hide();
		Ext.get('loading-mask').setOpacity(0, true);
		setTimeout(function(){
			Ext.get('loading-mask').hide();
		},400);
	}

});

