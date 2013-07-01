{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.model.ModelPreferences', {
    extend: 'Ext.data.Model',

    fields: [
        {
            name: 'checked',
            type: 'boolean'
        },
        {
            name: 'leaf',
            type: 'boolean'
        },
        {
            name: 'text'
        },
        {
            name: 'iconCls'
        },
        {
            name: 'id_modulo'
        }
    ]
});