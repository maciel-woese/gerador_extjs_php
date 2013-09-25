Ext.define('ShSolutions.view.verification.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.verificationfilter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormVerificationFilter',
        url: 'server/modulos/verification/list.php',
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
                        ui: 'decline',
						action: 'reset',
                        text: 'Resetar'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'filter',
                        text: 'Filtrar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
	
					{
                        xtype: 'numberfield',
						id: 'user_id_filter_verification',
                        label: 'User Id',
						name: 'user_id'
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
								id: 'date_start_date_filter_verification',
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: 'Hora',
                                style: 'border-bottom: 1px solid #DDD;',
								name: 'date_start_time',
								id: 'date_start_time_filter_verification',
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
								id: 'date_finish_date_filter_verification',
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: 'Hora',
                                style: 'border-bottom: 1px solid #DDD;',
								name: 'date_finish_time',
								id: 'date_finish_time_filter_verification',
								flex: 1
							}
						]
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_verification',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


