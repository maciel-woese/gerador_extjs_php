{
	success: true,
	icon_desktop:[
{foreach from=$menu item=field name=foo}		
		{ 
			descricao:	"{$field|capitalize}", 
			iconCls: 	"{$field}",
			controller: "{$field|capitalize}",
			className: 	"{$field}.List",
			id: 		"List-{$field|capitalize}"
		}{if $smarty.foreach.foo.index!={$smarty.foreach.foo.total}-1},{/if}
{/foreach}

	],
	
	menu_start:[
{foreach from=$menu item=field name=foo}		
		{ 
			descricao:	"{$field|capitalize}", 
			iconCls: 	"{$field}",
			controller: "{$field|capitalize}",
			className: 	"{$field}.List",
			id: 		"List-{$field|capitalize}"
		}{if $smarty.foreach.foo.index!={$smarty.foreach.foo.total}-1},{/if}
{/foreach}

	]
}
