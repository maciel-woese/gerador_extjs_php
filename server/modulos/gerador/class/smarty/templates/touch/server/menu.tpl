{
	dados: [
{foreach from=$menu item=field name=foo}		
		{ 
			modulo: "{$field|capitalize}",
			descricao: "{$field|capitalize}",
			action: "list"
		},
{/foreach}
		{
			modulo: "Logout",
			descricao: "{$sair}",
			action: "logout"
		}
	]
}