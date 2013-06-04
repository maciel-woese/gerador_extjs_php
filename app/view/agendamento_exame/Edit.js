/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.agendamento_exame.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addagendamento_examewin',

    id: 'AddAgendamento_ExameWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Agendamento de Exame',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormAgendamento_Exame',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/agendamento_exame/save.php',
                    items: [
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Exame',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_exame_date_agendamento_exame',
		                            name: 'data_exame_date',
		                            margins: '0 5 0 0',									
		                            hideLabel: true
		                        },
		                        {
		                            xtype: 'textfield',
		                            mask: '99:99:99',
									plugins: 'textmask',
									returnWithMask: true,
									flex: 1,
		                            id: 'data_exame_time_agendamento_exame',
		                            name: 'data_exame_time',									
		                            hideLabel: true
		                        }
		                    ]
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
		                    fieldLabel: 'Data Entrega',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_entrega_date_agendamento_exame',
		                            name: 'data_entrega_date',
		                            margins: '0 5 0 0',									
		                            hideLabel: true
		                        },
		                        {
		                            xtype: 'textfield',
		                            mask: '99:99:99',
									plugins: 'textmask',
									returnWithMask: true,
									flex: 1,
		                            id: 'data_entrega_time_agendamento_exame',
		                            name: 'data_entrega_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
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
									id: 'paciente_id_agendamento_exame',
									button_id: 'button_paciente_id_agendamento_exame',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_paciente_id_agendamento_exame',
                                    combo_id: 'paciente_id_agendamento_exame',
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
							id: 'id_agendamento_exame',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_agendamento_exame',
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
                            id: 'button_resetar_agendamento_exame',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_agendamento_exame',
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
