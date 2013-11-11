/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_anotacoes.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addclientes_anotacoeswin',

    id: 'AddClientes_AnotacoesWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
	
    title: 'Cadastro de Clientes_Anotacoes',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormClientes_Anotacoes',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/clientes_anotacoes/save.php',
                    items: [
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
                                    store: 'StoreComboClientes',
                                    name: 'cod_cliente',
									id: 'cod_cliente_clientes_anotacoes',
									button_id: 'button_cod_cliente_clientes_anotacoes',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Cliente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_cod_cliente_clientes_anotacoes',
                                    combo_id: 'cod_cliente_clientes_anotacoes',
                                    action: 'reset_combo'
                                },
                                {
                                    xtype: 'buttonadd',
									tabela: 'Clientes',
                                    action: 'add_win'
                                }
                            ]
                        },
						{
							xtype: 'textfield',
							name: 'anotacao',
							id: 'anotacao_clientes_anotacoes',
							anchor: '100%',							
							fieldLabel: 'Anotação'
						},
						{
							xtype: 'numberfield',
							name: 'cadastrado_por',
							id: 'cadastrado_por_clientes_anotacoes',
							anchor: '100%',						
							fieldLabel: 'Cadastrado Por'
						},
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Cadastro',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_cadastro_date_clientes_anotacoes',
		                            name: 'data_cadastro_date',
		                            margins: '0 5 0 0',									
		                            hideLabel: true
		                        },
		                        {
		                            xtype: 'textfield',
		                            mask: '99:99:99',
									plugins: 'textmask',
									returnWithMask: true,
									flex: 1,
		                            id: 'data_cadastro_time_clientes_anotacoes',
		                            name: 'data_cadastro_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
							xtype: 'textfield',
							name: 'ativo',
							id: 'ativo_clientes_anotacoes',
							anchor: '100%',							
							fieldLabel: 'Ativo'
						},
						{
							xtype: 'hidden',
							name: 'controle',
							hidden: true,
							id: 'controle_clientes_anotacoes',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_clientes_anotacoes',
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
                            id: 'button_resetar_clientes_anotacoes',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_clientes_anotacoes',
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: 'Salvar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);

    }

});
