/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.saida_produtos.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addsaida_produtoswin',

    id: 'AddSaida_ProdutosWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Saida_Produtos',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormSaida_Produtos',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/saida_produtos/save.php',
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
                                    store: 'StoreComboMedicamento',
                                    name: 'medicamento_id',
									id: 'medicamento_id_saida_produtos',
									button_id: 'button_medicamento_id_saida_produtos',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Medicamento'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_medicamento_id_saida_produtos',
                                    combo_id: 'medicamento_id_saida_produtos',
                                    action: 'reset_combo'
                                },
                                {
                                    xtype: 'buttonadd',
									tabela: 'Medicamento',
                                    action: 'add_win'
                                }
                            ]
                        },
						{
							xtype: 'numberfield',
							name: 'quantidade',
							id: 'quantidade_saida_produtos',
							anchor: '100%',						
							fieldLabel: 'Quantidade'
						},
						{
							xtype: 'hidden',
							name: 'saida_id',
							id: 'saida_id_saida_produtos',
							hidden: true,
							value: 0,
							anchor: '100%'
						},						
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_saida_produtos',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_saida_produtos',
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
                            id: 'button_resetar_saida_produtos',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_saida_produtos',
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
