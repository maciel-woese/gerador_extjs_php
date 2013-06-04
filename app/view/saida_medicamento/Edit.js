/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.saida_medicamento.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addsaida_medicamentowin',

    id: 'AddSaida_MedicamentoWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Saida_Medicamento',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormSaida_Medicamento',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/saida_medicamento/save.php',
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
                                    store: 'StoreComboPacientes',
                                    name: 'paciente_id',
									id: 'paciente_id_saida_medicamento',
									button_id: 'button_paciente_id_saida_medicamento',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_paciente_id_saida_medicamento',
                                    combo_id: 'paciente_id_saida_medicamento',
                                    action: 'reset_combo'
                                },
                                {
                                    xtype: 'buttonadd',
									tabela: 'Pacientes',
                                    action: 'add_win'
                                }
                            ]
                        },
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_saida_medicamento',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_saida_medicamento',
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
                            id: 'button_resetar_saida_medicamento',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_saida_medicamento',
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
