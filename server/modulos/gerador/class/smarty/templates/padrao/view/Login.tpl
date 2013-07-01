Ext.define('{$app|capitalize}.view.Login', {
    extend: 'Ext.window.Window',
    alias: 'widget.addloginwin',

    modal: true,
    draggable: false,
    closable: false,
    resizable: false,
    id: 'AddLoginWin',
    width: 350,
	height: 250,
    layout: {
        type: 'border'
    },
    title: '{$title_login}',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
				{
                    xtype: 'panel',
                    border: false,
                    id: 'panel_img',
                    region: 'north',
                    html: '<div style="text-align:center;padding:3px"><img src="resources/images/logoLogin.png"/></div>',
                    height: 95
                },
                {
                    xtype: 'form',
                    border: false,
                    autoScroll: true,
                    region: 'center',
                    id: 'FormLogin',
                    bodyPadding: 10,
                    method: 'POST',
                    url: 'server/modulos/login.php',
                    items: [
                        {
                            xtype: 'textfield',
                            id: 'LoginLogin',
                            name: 'login',
                            fieldLabel: '{$login_login}',
                            allowBlank: false,
                            labelWidth: 60,
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            id: 'SenhaLogin',
                            inputType: 'password',
                            name: 'senha',
                            fieldLabel: '{$password_login}',
                            labelWidth: 60,
                            allowBlank: false,
                            anchor: '100%'
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							name: 'action',
							id: 'action_login',
							value: 'LOGIN'
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
						    text: '{$reset_form}',
						    handler: function(){
						    	Ext.getCmp('FormLogin').getForm().reset();
						    }
						},
						{
							xtype: 'tbseparator'
						},
                        {
                            xtype: 'button',
                            iconCls: 'bt_login',
                            text: '{$button_connect}',
                            listeners: {
                                click: {
                                    fn: me.LoginSys,
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

    LoginSys: function(button, e, options) {
    	if(!Ext.getCmp('FormLogin').getForm().isValid()){
    		return true;
    	}
    	button.setDisabled(true);
    	Ext.getCmp('FormLogin').getEl().mask('{$aguarde}');
        Ext.getCmp('FormLogin').getForm().submit({
            success: function(f, o){
                if(o.result.success===true){
                    window.location = 'index.php';
                }
                else{
                    Ext.Msg.alert('{$error}', o.result.msg);
                    button.setDisabled(false);
                    Ext.getCmp('FormLogin').getEl().unmask();
                }
            },
            failure: function(f, o){
				console.info(o);
                Ext.Msg.alert('{$error}', o.result.msg);
                button.setDisabled(false);
                Ext.getCmp('FormLogin').getEl().unmask();
            }
        });
    }

});
