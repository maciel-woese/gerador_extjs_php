{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.view.{$TABELA}.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.add{$TABELA}win',

    id: 'Add{$TABELA|capitalize}Win',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
	
    title: '{$title_window} {$TABELA|capitalize}',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'Form{$TABELA|capitalize}',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/{$TABELA}/save.php',
                    items: [
{foreach from=$form item=field name=form}
{if $field.comboLocal != ''}
						{
                            xtype: 'fieldcontainer',
                            autoHeight: true,
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
									id: '{$field.nome}_{$TABELA}',
									button_id: 'button_{$field.nome}_{$TABELA}',
									flex: 1,
									anchor: '100%',{if $field.required != true}									
									allowBlank: true,{/if}								
									fieldLabel: '{$field.label}'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_{$field.nome}_{$TABELA}',
                                    combo_id: '{$field.nome}_{$TABELA}',
                                    action: 'reset_combo'
                                }
                            ]
                        },

{else}
{if $field.xtype == 'text'}
						{
							xtype: 'textfield',
							name: '{$field.nome}',
							id: '{$field.nome}_{$TABELA}',
							anchor: '100%',{if $field.inputType != ''}
				
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
												Ext.getCmp('{$field.nome}_{$TABELA}').markInvalid('{$field.nome|capitalize} Ja Existe...');
											}
										}
									});
								}
							},{/if}
{if $field.validate == 'email'}

							validator: function(value){
								if(value!="" && !isEmail(value)){
									return 'E-mail Inválido...';
								}
								else{
									return true;
								}
							},{/if}
{if $field.required != true}									
							allowBlank: true,{/if}
							
							fieldLabel: '{$field.label}'
						},
{else if $field.xtype == 'number'}
						{
							xtype: 'numberfield',
							name: '{$field.nome}',
							id: '{$field.nome}_{$TABELA}',
							anchor: '100%',{if $field.required != true}									
							allowBlank: true,{/if}						
							fieldLabel: '{$field.label}'
						},
{else if $field.xtype == 'combo'}
						{
                            xtype: 'fieldcontainer',
                            autoHeight: true,
                            layout: {
                                align: 'stretch',
                                type: 'hbox'
                            },
                            items: [
                                {
									xtype: 'combobox',
                                    store: 'StoreCombo{$field.store|capitalize}',
                                    name: '{$field.nome}',
									id: '{$field.nome}_{$TABELA}',
									button_id: 'button_{$field.nome}_{$TABELA}',
									flex: 1,{if $field.required != true}									
									allowBlank: true,{/if}									
									anchor: '100%',
									fieldLabel: '{$field.label}'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_{$field.nome}_{$TABELA}',
                                    combo_id: '{$field.nome}_{$TABELA}',
                                    action: 'reset_combo'
                                },
                                {
                                    xtype: 'buttonadd',
									tabela: '{$field.store|capitalize}',
                                    action: 'add_win'
                                }
                            ]
                        },
{else if $field.xtype == 'date'}
{if $field.tipo_real == 'datetime' or $field.tipo_real == 'timestamp'}
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: '{$field.label}',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: '{$field.nome}_date_{$TABELA}',
		                            name: '{$field.nome}_date',
		                            margins: '0 5 0 0',{if $field.required != true}									
									allowBlank: true,{/if}
									
		                            hideLabel: true
		                        },
		                        {
		                            xtype: 'textfield',
		                            mask: '99:99:99',
									plugins: 'textmask',
									returnWithMask: true,
									flex: 1,
		                            id: '{$field.nome}_time_{$TABELA}',
		                            name: '{$field.nome}_time',{if $field.required != true}									
									allowBlank: true,{/if}
									
		                            hideLabel: true
		                        }
		                    ]
		                },
{else if $field.tipo_real == 'date'}
		                {
							xtype: 'datefield',
							format: 'd/m/Y',{if $field.required != true}									
							allowBlank: true,{/if}		
							name: '{$field.nome}',
							id: '{$field.nome}_{$TABELA}',
							anchor: '100%',
							fieldLabel: '{$field.label}'
						},
{else if $field.tipo_real == 'time'}
						{
							xtype: 'textfield',
                            mask: '99:99:99',
							returnWithMask: true,
							plugins: 'textmask',{if $field.required != true}									
							allowBlank: true,{/if}
							
							name: '{$field.nome}',
							id: '{$field.nome}_{$TABELA}',
							anchor: '100%',
							fieldLabel: '{$field.label}'
						},
						
{/if}{/if}{/if}
{/foreach}
						{
							xtype: 'hidden',
							name: '{$CHAVE}',
							hidden: true,
							id: '{$CHAVE}_{$TABELA}',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_{$TABELA}',
							value: 'INSERIR',
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
                            xtype: 'tbseparator'
                        },
                        {
                            xtype: 'button',
                            id: 'button_resetar_{$TABELA}',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: '{$reset_form}'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_{$TABELA}',
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: '{$button_save}'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);

    }

});
