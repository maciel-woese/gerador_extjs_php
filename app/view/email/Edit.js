
Ext.define('ShSolutions.view.email.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.addemailwin',

    autoHeight: true,
    modal: true,
    draggable: false,
    resizable: false,
    id: 'AddEmailWin',
    width: 350,
    height: 310,
    layout: {
        type: 'border'
    },
    title: 'Email',

	field_nome: 'Nome',
	field_message: 'Mensagem',
	invalid_email: 'E-mail Inv&aacute;lido...',
	
	button_reset: 'Resetar',
	button_save: 'Salvar',
	
	loading: 'Aguarde...',
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
				{
                    xtype: 'panel',
                    border: false,
                    region: 'north',
                    html: '<div style="text-align:center;padding:3px"><img src="resources/images/logo.png"/></div>',
                    height: 95
                },
                {
                    xtype: 'form',
                    border: false,
                    autoScroll: true,
                    region: 'center',
                    id: 'FormEmail',
                    bodyPadding: 10,
                    method: 'POST',
                    url: 'server/modulos/email/envia.php',
                    items: [
                        {
                            xtype: 'textfield',
                            id: 'NomeEmail',
                            name: 'nome',
                            fieldLabel: me.field_nome,
                            allowBlank: false,
							labelWidth: 70,
                            anchor: '100%'
                        },
						{
                            xtype: 'textfield',
                            id: 'EmailEmail',
                            name: 'email',
                            fieldLabel: 'E-mail',
                            allowBlank: false,
                            labelWidth: 70,
							anchor: '100%',
							validator: function(value){
								if(value!="" && !isEmail(value)){
									return me.invalid_email;
								}
								else{
									return true;
								}
							}
                        },
                        {
                            xtype: 'textareafield',
                            id: 'MsgEmail',
                            name: 'message',
                            fieldLabel: me.field_message,
                            labelWidth: 70,
                            allowBlank: false,
                            anchor: '100%'
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							name: 'assunto',
							id: 'assunto_email',
							value: 'BUG'
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							name: 'action',
							id: 'action_email',
							value: 'ENVIAR'
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
						    xtype: 'button',
						    iconCls: 'bt_cancel',
						    text: me.button_reset,
						    handler: function(){
						    	Ext.getCmp('FormEmail').getForm().reset();
						    }
						},
						{
							xtype: 'tbseparator'
						},
                        {
                            xtype: 'button',
                            iconCls: 'bt_save',
                            text: me.button_save,
                            listeners: {
                                click: {
                                    fn: me.EmailSys,
                                    scope: me
                                }
                            }
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    },

    EmailSys: function(button, e, options) {
		var me = this;
    	if(!Ext.getCmp('FormEmail').getForm().isValid()){
    		return true;
    	}
    	button.setDisabled(true);
    	Ext.getCmp('FormEmail').getEl().mask(me.loading);
		
        Ext.getCmp('FormEmail').getForm().submit({
            success: function(f, o){
				if((!o.result) || (!o.result.success)){
					console.info(o);
					Ext.Msg.alert('Erro', "Erro!");
					button.setDisabled(false);
                    Ext.getCmp('FormEmail').getEl().unmask();
					return true;
				}
				
                if(o.result.success===true){
                    Ext.Msg.alert('Sucess', o.result.msg);
					Ext.getCmp('AddEmailWin').close();
                }
                else{
                    Ext.Msg.alert('Erro', o.result.msg);
                    button.setDisabled(false);
                    Ext.getCmp('FormEmail').getEl().unmask();
                }
            },
            failure: function(f, o){
				console.info(o);
                Ext.Msg.alert('Erro', o.result.msg);
                button.setDisabled(false);
                Ext.getCmp('FormEmail').getEl().unmask();
            }
        });
    }

});
