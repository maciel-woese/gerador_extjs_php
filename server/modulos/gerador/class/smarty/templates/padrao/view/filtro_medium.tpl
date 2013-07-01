{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.view.{$TABELA}.Filtro', {
    extend: '{$app|capitalize}.view.WindowMedium',
    alias: 'widget.filter{$TABELA}win',

    id: 'Filter{$TABELA|capitalize}Win',
    layout: {
        type: 'fit'
    },
    
    title: '{$title_filter} {$TABELA|capitalize}',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilter{$TABELA|capitalize}',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
{foreach from=$form item=field_form name=form}
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
{if $field_form|@count == 1}
							anchor: '50%',
							margins: '0 5 0 0',
{/if}
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
{foreach from=$field_form item=field name=form_field}
{if $field.comboLocal != ''}
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
								    
								    margin: '0 5 0 0',{else}
								    {/if}
								    
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
		                                {
											xtype: 'combobox',
		                                    store: 'StoreCombo{$field.nome|capitalize}{$TABELA|capitalize}',
		                                    name: '{$field.nome}',
											loadDisabled: true,
											id: '{$field.nome}_filter_{$TABELA}',
											button_id: 'button_{$field.nome}_filter_{$TABELA}',
											flex: 1,
											anchor: '100%',
											fieldLabel: '{$field.label}'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_{$field.nome}_filter_{$TABELA}',
		                                    combo_id: '{$field.nome}_filter_{$TABELA}',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        }{if $smarty.foreach.form_field.index == 0},{/if}

{else}
{if $field.xtype == 'text'}
								{
									xtype: 'textfield',
									name: '{$field.nome}',{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
									
								    margin: '0 5 0 0',{else}
								    {/if}
								    
								    flex: 1,
									id: '{$field.nome}_filter_{$TABELA}',{if $field.inputType != ''}
				
									inputType: '{$field.inputType}',{/if}
{if $field.mask == 'fone'}
							
									mask: '(99) 9999-9999',
									plugins: 'textmask',{else if $field.mask == 'cep'}
									
									mask: '99.999-999',
									plugins: 'textmask',{else if $field.mask == 'cnpj'}
									
									mask: '99.999.999/9999-99',
									plugins: 'textmask',{else if $field.mask == 'cpf'}
									
									mask: '999.999.999.99',
									plugins: 'textmask',{else if $field.mask == 'money'}
									
									mask: '#9.999.990,00',
									plugins: 'textmask',
									money: true,{/if}
{if $field.unique == true}
									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.Ajax.request({
												url: 'server/modulos/{$TABELA}/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: '{$field.nome}',
													valor: this.getValue()
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													if(dados.success==false){
														Ext.getCmp('{$field.nome}_{$TABELA}').markInvalid('Usuário Ja Existe...');
													}
												}
											});
										}
									},{/if}
{if $field.validate == 'email'}
		
									validator: function(value){
										if(!isEmail(value)){
											return 'E-mail Inválido...';
										}
										else{
											return true;
										}
									},{/if}																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: '{$field.label}'
								}{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 },{/if}
								
{else if $field.xtype == 'number'}
								{
									xtype: 'numberfield',
									name: '{$field.nome}',{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
								    
								    margin: '0 5 0 0',{else}
								    {/if}
								    
								    flex: 1,
									id: '{$field.nome}_filter_{$TABELA}',
									anchor: '100%',
									fieldLabel: '{$field.label}'
								}{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 },{/if}
								
{else if $field.xtype == 'combo'}
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
								    
								    margin: '0 5 0 0',{else}
								    {/if}
								    
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
										{
											xtype: 'combobox',
		                                    store: 'StoreCombo{$field.store|capitalize}',
		                                    name: '{$field.nome}',
											id: '{$field.nome}_filter_{$TABELA}',
											button_id: 'button_{$field.nome}_filter_{$TABELA}',
											flex: 1,
											anchor: '100%',
											fieldLabel: '{$field.label}'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_{$field.nome}_filter_{$TABELA}',
		                                    combo_id: '{$field.nome}_filter_{$TABELA}',
		                                    action: 'reset_combo'
		                                },
		                            ]
		                        }{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 },{/if}
		                        
{else if $field.xtype == 'date'}
{if $field.tipo_real == 'datetime' or $field.tipo_real == 'timestamp'}
								{
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
									
									margin: '0 5 0 0',{else}
									{/if}
									
									flex: 1,
									labelAlign: 'top',
									labelStyle: 'font-weight: bold;font-size: 11px;',			    
									fieldLabel: '{$field.label}',
									items: [
										{
											xtype: 'datefield',
											format: 'd/m/Y',
											flex: 1,
											id: '{$field.nome}_date_filter_{$TABELA}',
											name: '{$field.nome}_date',
											margins: '0 5 0 0',
{if $field.required != true}									
											allowBlank: true,{/if}
											hideLabel: true
										},
										{
											xtype: 'textfield',
											mask: '99:99:99',
											plugins: 'textmask',
											returnWithMask: true,
											flex: 1,
											id: '{$field.nome}_time_filter_{$TABELA}',
											name: '{$field.nome}_time',
{if $field.required != true}									
											allowBlank: true,{/if}
											hideLabel: true
										}
									]
								}{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 },{/if}
								
{else if $field.tipo_real == 'date'}
								{
									xtype: 'datefield',
									format: 'd/m/Y',{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
									
									margin: '0 5 0 0',{else}
									{/if}
									
									flex: 1,
{if $field.required != true}									
									allowBlank: true,{/if}								
									name: '{$field.nome}',
									id: '{$field.nome}_filter_{$TABELA}',
									anchor: '100%',
									fieldLabel: '{$field.label}'
								}{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 },{/if}
								
{else if $field.tipo_real == 'time'}
								{
									xtype: 'textfield',
									mask: '99:99:99',
									returnWithMask: true,
									plugins: 'textmask',{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 }
									
									margin: '0 5 0 0',{else}
									{/if}
									
									flex: 1,
{if $field.required != true}									
									allowBlank: true,{/if}								
									name: '{$field.nome}',
									id: '{$field.nome}_filter_{$TABELA}',
									anchor: '100%',
									fieldLabel: '{$field.label}'
								}{if $smarty.foreach.form_field.index == 0 and $smarty.foreach.form_field.total>1 },{/if}
								
{/if}{/if}{/if}
{/foreach}

							]
						},
{/foreach}
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_{$TABELA}',
							allowBlank: false,
							value: 'FILTER',
							anchor: '100%'
						}
                    ]
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    items: [
                        {
                            xtype: 'tbfill'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_cancel',
                            action: 'resetar_filtro',
                            text: '{$button_reset_filtro}'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: '{$button_filtrar}'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
