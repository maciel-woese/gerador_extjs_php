/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_contato.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addclientes_contatowin',

    id: 'AddClientes_ContatoWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
	
    title: 'Cadastro de Clientes_Contato',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormClientes_Contato',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/clientes_contato/save.php',
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
									id: 'cod_cliente_clientes_contato',
									button_id: 'button_cod_cliente_clientes_contato',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Cliente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_cod_cliente_clientes_contato',
                                    combo_id: 'cod_cliente_clientes_contato',
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
							name: 'tipo_contato',
							id: 'tipo_contato_clientes_contato',
							anchor: '100%',							
							fieldLabel: 'Tipo Contato'
						},
						{
							xtype: 'textfield',
							name: 'descricao',
							id: 'descricao_clientes_contato',
							anchor: '100%',							
							fieldLabel: 'Descrição'
						},
						{
							xtype: 'textfield',
							name: 'observacao',
							id: 'observacao_clientes_contato',
							anchor: '100%',							
							fieldLabel: 'Observação'
						},
						{
							xtype: 'hidden',
							name: 'controle',
							hidden: true,
							id: 'controle_clientes_contato',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_clientes_contato',
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
                            id: 'button_resetar_clientes_contato',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_clientes_contato',
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
