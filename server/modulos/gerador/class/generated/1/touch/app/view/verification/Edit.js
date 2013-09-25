/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.verification.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.verificationform',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormVerification',
        url: 'server/modulos/verification/save.php',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Verification',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: 'Voltar',
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
                        ui: 'confirm',
						action: 'salvar',
                        text: 'Salvar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
					{
                        xtype: 'numberfield',
						id: 'user_id_verification',
						name: 'user_id',
						label: 'User Id'
                    },
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
                                label: 'Data Inicial',
								name: 'date_start_date',
								id: 'date_start_date_verification',
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: 'Hora',
                                style: 'border-bottom: 1px solid #DDD;',
								name: 'date_start_time',
								id: 'date_start_time_verification',
								flex: 1
							}
						]
					},
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
                                label: 'Date Final',
								name: 'date_finish_date',
								id: 'date_finish_date_verification',
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: 'Hora',
                                style: 'border-bottom: 1px solid #DDD;',
								name: 'date_finish_time',
								id: 'date_finish_time_verification',
								flex: 1
							}
						]
					},
					{
						xtype: 'hiddenfield',
						name: 'id',
						hidden: true,
						id: 'id_verification',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_verification',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

