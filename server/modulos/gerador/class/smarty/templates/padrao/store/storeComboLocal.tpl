{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.store.StoreCombo{$campo}{$TABELA|capitalize}', {
    extend: 'Ext.data.Store',
    requires: [
        '{$app|capitalize}.model.ModelComboLocal'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            model: '{$app|capitalize}.model.ModelComboLocal',
   	        data: [
{foreach from=$data item=field name=columns}
				{
					id: '{$field.id}',
					descricao: '{$field.descricao}'
				}{if $smarty.foreach.columns.index!={$smarty.foreach.columns.total}-1},{/if}
				
{/foreach}   	        	
   	        ]
        }, cfg)]);
        
    }
});
