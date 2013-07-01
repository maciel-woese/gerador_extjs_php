{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

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
	
    name: '{$app|capitalize}',
    controllers: [
{foreach from=$controller item=field name=form}
		'{$field}'{if $smarty.foreach.form.index!={$smarty.foreach.form.total}-1},{/if}
		
{/foreach}
    ],
	
	launch: function(){
		var me = this;
		Ext.fly('appLoadingIndicator').destroy();
		var init = Ext.create('{$app|capitalize}.view.Principal', {
			fullscreen: true
		});
{if $store_init=='lista'}
		init.getStore().load();
{else}
		{$app|capitalize}.app.getController('Principal').ajaxCarousel();
{/if}
{if $permissoes=='sim'}
		me.dados = key;
{/if}
		
	}

});

