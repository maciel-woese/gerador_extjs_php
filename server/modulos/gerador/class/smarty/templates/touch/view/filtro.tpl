
Ext.define('{$app|capitalize}.view.{$TABELA}.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.{$TABELA}filter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'Form{$TABELA|capitalize}Filter',
        url: 'server/modulos/{$TABELA}/list.php',
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
                        ui: 'decline',
						action: 'reset',
                        text: '{$reset_form}'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'filter',
                        text: '{$button_filtrar}'
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
								name: '{$field.nome}',
								loadDisabled: true,
								id: '{$field.nome}_filter_{$TABELA}',
								button_id: 'button_{$field.nome}_filter_{$TABELA}',
								store: 'StoreCombo{$field.nome|capitalize}{$TABELA|capitalize}',
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
								id: 'button_{$field.nome}_filter_{$TABELA}',
								combo_id: '{$field.nome}_filter_{$TABELA}',
								action: 'reset_combo'
							}
						]
					},
{/if}	
{if $field.xtype == 'text' and $field.mask =="" and $field.inputType =="" and $field.comboLocal ==""}
					{
                        xtype: 'textfield',
						id: '{$field.nome}_filter_{$TABELA}',
                        label: '{$field.label|capitalize}',
						name: '{$field.nome}'
                    },
{/if}
{if $field.xtype == 'number' and $field.mask =="" and $field.inputType =="" and $field.comboLocal ==""}
					{
                        xtype: 'numberfield',
						id: '{$field.nome}_filter_{$TABELA}',
                        label: '{$field.label|capitalize}',
						name: '{$field.nome}'
                    },
{/if}
{if $field.mask != '' and $field.comboLocal =="" and $field.inputType ==""}
					{
                        xtype: 'maskfield',
						id: '{$field.nome}_filter_{$TABELA}',
						tipo: '{$field.mask}',
                        label: '{$field.label|capitalize}',
						name: '{$field.nome}'
                    },
{/if}
{if $field.inputType != ''}
					{
                        xtype: 'passwordfield',
                        label: '{$field.label|capitalize}',
						id: '{$field.nome}_filter_{$TABELA}',
						name: '{$field.nome}'
                    },
{/if}
{if $field.xtype == 'combo'}
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
								id: '{$field.nome}_filter_{$TABELA}',
								button_id: 'button_{$field.nome}_filter_{$TABELA}',
								flex: 1,
								label: '{$field.label|capitalize}'
							},
							{
								xtype: 'button',
								iconCls: 'compose',
								hidden: true,
								id: 'button_{$field.nome}_filter_{$TABELA}',
								combo_id: '{$field.nome}_filter_{$TABELA}',
								action: 'reset_combo'
							}
						]
					},
{/if}
{if $field.xtype == 'date' and $field.tipo_real == 'date'}
					{
                        xtype: 'datepickerfield',
						id: '{$field.nome}_filter_{$TABELA}',
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
						id: '{$field.nome}_filter_{$TABELA}',
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
								id: '{$field.nome}_date_filter_{$TABELA}',
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
								id: '{$field.nome}_time_filter_{$TABELA}',
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
								id: '{$field.nome}_date_filter_{$TABELA}',
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
								id: '{$field.nome}_time_filter_{$TABELA}',
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
						name: 'action',
						hidden: true,
						id: 'action_filter_{$TABELA}',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


