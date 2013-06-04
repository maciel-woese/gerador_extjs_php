/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.consulta.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addconsultawin',

    id: 'AddConsultaWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Consulta',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormConsulta',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/consulta/save.php',
                    items: [
						{
							xtype: 'fieldcontainer',
							anchor: '100%',
							autoHeight: true,
							layout: {
								align: 'stretch',
								type: 'hbox'
							},									
							flex: 1,
							labelAlign: 'top',
							labelStyle: 'font-weight: bold;font-size: 11px;',			    
							fieldLabel: 'Data Hora',
							items: [
								{
									xtype: 'datefield',
									format: 'd/m/Y',
									flex: 1,
									value: Ext.util.Format.date(new Date(), "d/m/Y"),
									id: 'data_hora_date_consulta',
									name: 'data_hora_date',
									margins: '0 5 0 0',											
									hideLabel: true
								},
								{
									xtype: 'textfield',
									mask: '99:99:99',
									plugins: 'textmask',
									returnWithMask: true,
									flex: 1,
									value: Ext.util.Format.date(new Date(), "His"),
									id: 'data_hora_time_consulta',
									name: 'data_hora_time',											
									hideLabel: true
								}
							]
						},		                        
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							anchor: '100%',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'combobox',
									store: 'StoreComboPacientes',
									name: 'paciente_id',
									id: 'paciente_id_consulta',
									button_id: 'button_paciente_id_consulta',
									flex: 1,
									anchor: '100%',											
									fieldLabel: 'Paciente'
								},
								{
									xtype: 'buttonadd',
									iconCls: 'bt_cancel',
									hidden: true,
									id: 'button_paciente_id_consulta',
									combo_id: 'paciente_id_consulta',
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
							xtype: 'fieldcontainer',
							autoHeight: true,								    
							flex: 1,
							anchor: '100%',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'combobox',
									store: 'StoreComboMedico',
									name: 'medico_id',
									id: 'medico_id_consulta',
									button_id: 'button_medico_id_consulta',
									flex: 1,
									anchor: '100%',
									fieldLabel: 'Medico'
								},
								{
									xtype: 'buttonadd',
									iconCls: 'bt_cancel',
									hidden: true,
									id: 'button_medico_id_consulta',
									combo_id: 'medico_id_consulta',
									action: 'reset_combo'
								},
								{
									xtype: 'buttonadd',
									tabela: 'Medico',
									action: 'add_win'
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_consulta',
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
                            id: 'button_resetar_consulta',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_consulta',
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
