/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.pacientes_transporte.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addpacientes_transportewin',

    id: 'AddPacientes_TransporteWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Pacientes',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormPacientes_Transporte',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/pacientes_transporte/save.php',
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
									id: 'paciente_id_pacientes_transporte',
									button_id: 'button_paciente_id_pacientes_transporte',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Paciente'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_paciente_id_pacientes_transporte',
                                    combo_id: 'paciente_id_pacientes_transporte',
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
							xtype: 'numberfield',
							name: 'acompanhado',
							id: 'acompanhado_pacientes_transporte',
							anchor: '100%',						
							fieldLabel: 'Acompanhado'
						},
						{
							xtype: 'textfield',
							name: 'local_consulta',
							id: 'local_consulta_pacientes_transporte',
							anchor: '100%',							
							fieldLabel: 'Local Consulta'
						},
						{
							xtype: 'textfield',
							name: 'espera',
							id: 'espera_pacientes_transporte',
							anchor: '100%',							
							fieldLabel: 'Espera'
						},
						{
							xtype: 'textfield',
                            mask: '99:99:99',
							returnWithMask: true,
							plugins: 'textmask',							
							name: 'hora',
							id: 'hora_pacientes_transporte',
							anchor: '100%',
							fieldLabel: 'Hora'
						},
						{
							xtype: 'textfield',
							name: 'fone',
							id: 'fone_pacientes_transporte',
							anchor: '100%',							
							mask: '(99) 9999-9999',
							plugins: 'textmask',							
							fieldLabel: 'Fone'
						},
						{
							xtype: 'textarea',
							name: 'obs',
							id: 'obs_pacientes_transporte',
							anchor: '100%',							
							fieldLabel: 'Obs'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_pacientes_transporte',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'agendamento_transporte_id',
							hidden: true,
							id: 'agendamento_transporte_id_pacientes_transporte',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_pacientes_transporte',
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
                            id: 'button_resetar_pacientes_transporte',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_pacientes_transporte',
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
