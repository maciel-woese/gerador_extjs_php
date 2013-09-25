/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.Loader.setConfig({
    enabled: true
});


Ext.application({
	icon: {
        57: 'resources/icons/icon.png',
        72: 'resources/icons/icon-72.png',
        114: 'resources/icons/icon-114.png'
    },
    dados: [],
	
    name: 'ShSolutions',
    controllers: [
		'Product',		
		'User',		
		'Verification',		
		'Principal',		
		'Verification_Products'		
    ],
	
	launch: function(){
		var me = this;
		Ext.fly('appLoadingIndicator').destroy();
		var init = Ext.create('ShSolutions.view.Principal', {
			fullscreen: true
		});
		init.getStore().load();
		
	}

});

