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
{foreach from=$controller item=field name=form}
		'{$field}'{if $smarty.foreach.form.index!={$smarty.foreach.form.total}-1},{/if}
		
{/foreach}
    ],
    
    autoCreateViewport: false,
	dados: [],
	
	launch: function(){
		var me = this;
		Ext.widget('containerprincipal').show();
{if $permissoes=='sim'}			
		me.dados = key;
{/if}

		Ext.get('loading').hide();
		Ext.get('loading-mask').setOpacity(0, true);
		setTimeout(function(){
			Ext.get('loading-mask').hide();
		},400);
	}

});

