{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.view.{$TABELA}.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.{$TABELA}list',
    requires: [
    	'{$app|capitalize}.store.Store{$TABELA|capitalize}'
    ],
	
	id: 'Grid{$TABELA|capitalize}',
    store: 'Store{$TABELA|capitalize}',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false
			},
			{if {$columns|@count} < 10}forceFit: true,{/if}
			
			columns: [
{foreach from=$columns item=field name=columns}
				{
					xtype: '{$field.xtype}column',
					dataIndex: '{$field.dataIndex}',
{if $field.xtype == 'date'}
					format: '{$field.format}',
{/if}
{if $field.hidden == true}
					hidden: true,
{/if}
{if $field.xtype == 'date'}
					renderer : Ext.util.Format.dateRenderer('{$field.format}'),
{/if}
{if $field.xtype == 'number'}
					format: '0',
{/if}
{if $field.mask == 'cpf'}
					renderer : Ext.util.Format.maskRenderer('999.999.999-99'),
{/if}
{if $field.mask == 'cep'}
					renderer : Ext.util.Format.maskRenderer('99.999-999'),
{/if}
{if $field.mask == 'fone'}
					renderer : Ext.util.Format.maskRenderer('(99) 9999-9999'),
{/if}
{if $field.mask == 'cnpj'}
					renderer : Ext.util.Format.maskRenderer('99.999.999/9999-99'),
{/if}
{if $field.mask == 'money'}
					renderer: Ext.util.Format.maskRenderer('R$ #9.999.990,00', true),
{/if}
					text: '{$field.title}',{if $field.renderer != 'false'}
					
					renderer: function(v){
						switch(v){
{foreach from=$field.renderer item=f name=col}
							case '{$f.id}':
							return '{$f.descricao}';
						  	break;
{/foreach} 					
						}
					},{/if}					
					width: 140
				}{if $smarty.foreach.columns.index!={$smarty.foreach.columns.total}-1},{/if}

{/foreach}                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'Store{$TABELA|capitalize}',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_{$TABELA}',
							iconCls: 'bt_add',{if $permissoes == 'sim'}							
							hidden: true,{/if}							
							action: 'adicionar',
							text: '{$button_adicionar}'
						},
						{
							xtype: 'button',
							id: 'button_edit_{$TABELA}',
							iconCls: 'bt_edit',
{if $permissoes == 'sim'}
							hidden: true,{/if}
							
							action: 'editar',
							text: '{$button_editar}'
						},
						{
							xtype: 'button',
							id: 'button_del_{$TABELA}',
							iconCls: 'bt_del',
{if $permissoes == 'sim'}
							hidden: true,{/if}
							
							action: 'deletar',
							text: '{$button_deletar}'
						},
						{
							xtype: 'button',
							id: 'button_filter_{$TABELA}',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: '{$button_filtrar}'
						}{if $pdf==true},
						{
							xtype: 'button',
							id: 'button_pdf_{$TABELA}',
							iconCls: 'bt_pdf',
							action: 'gerar_pdf',
							text: '{$button_pdf}'
						}
{/if}
					
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
