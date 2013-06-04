/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.entrada_medicamento.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addentrada_medicamentowin',

    id: 'AddEntrada_MedicamentoWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Entrada de Medicamento',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormEntrada_Medicamento',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/entrada_medicamento/save.php',
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
                                    store: 'StoreComboFornecedor',
                                    name: 'fornecedor_id',
									id: 'fornecedor_id_entrada_medicamento',
									button_id: 'button_fornecedor_id_entrada_medicamento',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Fornecedor'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_fornecedor_id_entrada_medicamento',
                                    combo_id: 'fornecedor_id_entrada_medicamento',
                                    action: 'reset_combo'
                                },
                                {
                                    xtype: 'buttonadd',
									tabela: 'Fornecedor',
                                    action: 'add_win'
                                }
                            ]
                        },
						{
							xtype: 'textfield',
							name: 'nota',
							id: 'nota_entrada_medicamento',
							anchor: '100%',							
							fieldLabel: 'Nota'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_entrada_medicamento',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_entrada_medicamento',
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
                            id: 'button_resetar_entrada_medicamento',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_entrada_medicamento',
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
