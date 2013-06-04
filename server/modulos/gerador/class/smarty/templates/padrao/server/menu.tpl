{
	children:[
{foreach from=$menu item=field name=foo}		
		{ 
			text:"{$field|capitalize}", 
			leaf: true,
			tipo: 'list',
			idtemp: "listagem_{$field}",
			tab: "{$field}"
		}{if $smarty.foreach.foo.index!={$smarty.foreach.foo.total}-1},{/if}
{/foreach}		
	]
}