{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.view.{$TABELA}.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.{$TABELA}list',

    config: {
        id: 'Grid{$TABELA|capitalize}',
		fullscreen: true,
		store: 'Store{$TABELA|capitalize}',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
{foreach from=$columns item=field name=columns}
			{if $field.hidden != true}'<div class="gridlist"><b>{$field.title|capitalize}: </b> {$field.dataIndex}</div>',{/if}			
{/foreach}
			{
{foreach from=$columns item=field name=columns}{if $field.hidden != true}{if $field.xtype == 'date'}
				
				{$field.dataIndexFunction}: function(v){
{if $field.format=='H:i:s'}
					return v;
{else}					return Ext.util.Format.date(v, '{$field.format}');					
{/if}
				}{if $smarty.foreach.columns.index!={$smarty.foreach.columns.total}-1},{/if}{/if}{if $field.renderer != 'false'}
				
				{$field.dataIndexFunction}: function(v){
					switch(v){
{foreach from=$field.renderer item=f name=col}
						case '{$f.id}':
						return '{$f.descricao}';
					  	break;
{/foreach} 					
					}
				}{if $smarty.foreach.columns.index!={$smarty.foreach.columns.total}-1},{/if}{/if}{if $field.mask != ''}
				
				{$field.dataIndexFunction}: function(v){
					return setMask(v, '{$field.mask}');				
				}{if $smarty.foreach.columns.index!={$smarty.foreach.columns.total}-1},{/if}{/if}
{/if}
{/foreach}

			}
        ),
        plugins: [
	        {
	            xclass: 'Ext.plugin.ListPaging',
				loadMoreText: '{$load_more}',
				noMoreRecordsText: '{$no_records}',
	            autoPaging: true
	        }
	    ],
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: '{$TABELA|capitalize}',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: '{$button_back}',
						action: 'back_menu'
                    },
					{
						xtype: 'spacer'
					},
					{
                        xtype: 'button',
                        ui: 'confirm',
						iconMask: true,
						iconCls: 'refresh',
						action: 'refresh'
                    }
				]
            },
			{
				xtype: 'toolbar',
				docked: 'bottom',
				ui: 'light',
				layout: {
					align: 'center',
					pack: 'center',
					type: 'hbox'
				},
				items: [
					{
						xtype: 'button',
						iconCls: 'add',
{if $permissoes == 'sim'}
						hidden: true,{/if}
						action: 'adicionar',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'editar',
{if $permissoes == 'sim'}
						hidden: true,{/if}
						iconCls: 'compose',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'deletar',
{if $permissoes == 'sim'}
						hidden: true,{/if}
						iconCls: 'delete',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'search',
						iconCls: 'search',
						iconMask: true
					}
				]
			}
               
        ]
    }

});

