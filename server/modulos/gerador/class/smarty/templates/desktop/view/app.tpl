{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}
Ext.Loader.setConfig({
    enabled: true,
    paths: {
    	'{$app|capitalize}': 'app',
    	'{$app|capitalize}.plugins': 'resources/plugins'
    }
});

Ext.application({
    name: '{$app|capitalize}',
    controllers: [
		'Desktop'
		
    ],
    autoCreateViewport: false,
    winRegistered: new Ext.util.MixedCollection(),
    launch: function() {
    	var me = this;
    	Ext.create('{$app|capitalize}.view.Desktop');
{if $permissoes=='sim'}			
		me.dados = key;
{/if}
    }

});


