{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.view.{$TABELA}.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.{$TABELA}form',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'Form{$TABELA|capitalize}',
        url: 'server/modulos/{$TABELA}/save.php',
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
						action: 'back'
                    }
                ]
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                items: [
                    {
                        xtype: 'spacer'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'salvar',
                        text: '{$button_save}'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
{foreach from=$form item=field name=form}
{if $field.comboLocal != ''}
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
								store: 'StoreCombo{$field.nome|capitalize}{$TABELA|capitalize}',
								name: '{$field.nome}',
								loadDisabled: true,
								id: '{$field.nome}_{$TABELA}',
								button_id: 'button_{$field.nome}_{$TABELA}',
								flex: 1,
{if $field.required != true}
								required: true,{/if}
								label: '{$field.label|capitalize}'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_{$field.nome}_{$TABELA}',
								combo_id: '{$field.nome}_{$TABELA}',
								action: 'reset_combo'
							}
						]
					},
{/if}{if $field.xtype == 'text' and $field.mask =="" and $field.inputType =="" and $field.comboLocal ==""}
					{
                        xtype: 'textfield',
						id: '{$field.nome}_{$TABELA}',
						name: '{$field.nome}',
{if $field.required != true}
						required: true,{/if}
						label: '{$field.label|capitalize}'
                    },
{/if}{if $field.xtype == 'number' and $field.mask =="" and $field.inputType =="" and $field.comboLocal ==""}
					{
                        xtype: 'numberfield',
						id: '{$field.nome}_{$TABELA}',
						name: '{$field.nome}',
{if $field.required != true}
						required: true,{/if}
						label: '{$field.label|capitalize}'
                    },
{/if}{if $field.mask != '' and $field.comboLocal =="" and $field.inputType ==""}
					{
                        xtype: 'maskfield',
						id: '{$field.nome}_{$TABELA}',
						tipo: '{$field.mask}',
						name: '{$field.nome}',
{if $field.required != true}
						required: true,{/if}
						label: '{$field.label|capitalize}'
                    },
{/if}{if $field.inputType != ''}
					{
                        xtype: 'passwordfield',
						id: '{$field.nome}_{$TABELA}',
                        name: '{$field.nome}',
{if $field.required != true}
						required: true,{/if}
						label: '{$field.label|capitalize}'
                    },
{/if}{if $field.xtype == 'combo'}
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
								store: 'StoreCombo{$field.store|capitalize}',
								name: '{$field.nome}',
								id: '{$field.nome}_{$TABELA}',
								button_id: 'button_{$field.nome}_{$TABELA}',
								flex: 1,
								labelWidth: '34%',
{if $field.required != true}
								required: true,{/if}
								label: '{$field.label|capitalize}'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_{$field.nome}_{$TABELA}',
								combo_id: '{$field.nome}_{$TABELA}',
								action: 'reset_combo'
							},
							{
								xtype: 'button',
								iconCls: 'add',
								iconMask: true,
								modulo: '{$field.store|capitalize}',
								action: 'add_win'
							}
						]
					},
{/if}{if $field.xtype == 'date' and $field.tipo_real == 'date'}
					{
                        xtype: 'datepickerfield',
						id: '{$field.nome}_{$TABELA}',
						name: '{$field.nome}',
{if $field.required != true}
						required: true,{/if}
						label: '{$field.label|capitalize}'
                    },
{/if}
{if $field.xtype == 'date' and $field.tipo_real == 'time'}
					{
                        xtype: 'maskfield',
						tipo: 'hora',
						id: '{$field.nome}_{$TABELA}',
						name: '{$field.nome}',
{if $field.required != true}
						required: true,{/if}
						label: '{$field.label|capitalize}'
                    },
{/if}
{if $field.xtype == 'date' and $field.tipo_real == 'timestamp'}
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'datepickerfield',
                                margin: '0 10 0 0',
                                label: '{$field.label|capitalize}',
								name: '{$field.nome}_date',
								id: '{$field.nome}_date_{$TABELA}',
{if $field.required != true}
								required: true,{/if}
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: '{$hora}',
                                style: 'border-bottom: 1px solid #DDD;',
								name: '{$field.nome}_time',
								id: '{$field.nome}_time_{$TABELA}',
{if $field.required != true}
								required: true,{/if}
								flex: 1
							}
						]
					},
{/if}
{if $field.xtype == 'date' and $field.tipo_real == 'datetime'}
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'datepickerfield',
                                margin: '0 10 0 0',
                                label: '{$field.label|capitalize}',
								name: '{$field.nome}_date',
								id: '{$field.nome}_date_{$TABELA}',
{if $field.required != true}
								required: true,{/if}
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: 'Hora',
                                style: 'border-bottom: 1px solid #DDD;',
								name: '{$field.nome}_time',
								id: '{$field.nome}_time_{$TABELA}',
{if $field.required != true}
								required: true,{/if}
								flex: 1
							}
						]
					},
{/if}
{/foreach}
					{
						xtype: 'hiddenfield',
						name: '{$CHAVE}',
						hidden: true,
						id: '{$CHAVE}_{$TABELA}',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_{$TABELA}',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

