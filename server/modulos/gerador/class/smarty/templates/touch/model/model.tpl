{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.model.Model{$TABELA|capitalize}', {
    extend: 'Ext.data.Model',
	
	config: {
    	fields: [
{foreach from=$fields item=field name=foo2}
			{
				name: '{$field.nome}',{if $field.type=='date' }
				
				dateFormat: '{$field.format}',{else}
				{/if}{if $field.format=='H:i:s'}				
				type: 'string'
{/if}{if $field.format!='H:i:s'}				
				type: '{$field.type}'
{/if}
			}{if $smarty.foreach.foo2.index!={$smarty.foreach.foo2.total}-1},{/if}
				
{/foreach}
    	],
		
		validations: [
{foreach from=$form item=field name=form}
{if $field.xtype != ''}{if $field.required == true and $field.validate == 'email'}
			{
                type: 'email',
                field: '{$field.nome}',
				message: 'E-mail Inválido.'
            },
{/if}
{if $field.required == true}
			{
				type: 'presence',
				field: '{$field.nome}',
				message: '{$field.label|capitalize} &eacute; Obrigat&oacute;rio.'
			}{if $smarty.foreach.form.index!={$smarty.foreach.form.total}-1},{/if}
{/if}

{/if}
{/foreach}
		]
    }	
});