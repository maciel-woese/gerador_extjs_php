Ext.define('{$app|capitalize}.view.Login', {
    extend: 'Ext.form.Panel',
    alias: 'widget.addloginwin',

    config: {
		fullscreen: true,
		url: 'server/modulos/login.php',
    	id: 'FormLogin',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Login'
            },
			{
			
				xtype: 'container',
                margin: '0 0 5 0',
                style: 'background:#FFF;border:solid 1px;',
				html: '<div style="text-align:center;padding:3px"><img src="resources/icons/logoLogin.png"/></div>',
				height: 110
			},
            {
                xtype: 'fieldset',
                items: [
                    {
                        xtype: 'textfield',
                        id: 'login_login',
                        label: '{$login_login}',
                        name: 'login'
                    },
                    {
                        xtype: 'passwordfield',
                        id: 'senha_login',
                        label: '{$password_login}',
                        name: 'senha'
                    },
                    {
						xtype: 'hiddenfield',
						hidden: true,
						name: 'action',
						id: 'action_login',
						value: 'LOGIN'
                    } 
                ]
            },
            {
                xtype: 'button',
                text: '{$button_connect}',
                listeners: {
                    tap: function(){
                    	
				    	if(Ext.getCmp('login_login').getValue()=="" && Ext.getCmp('senha_login').getValue()==""){
				    		return false;
				    	}
						
				    	Ext.Viewport.setMasked({
				    		xtype:'loadmask',
				    		message: "{$aguarde}"
				    	});
				        Ext.getCmp('FormLogin').submit({
				            success: function(f, o){
				                if(o.success===true){
				                    window.location = 'index.php';
				                }
				                else{
				                    Ext.Msg.alert('{$error}', o.msg);
				                    Ext.Viewport.setMasked(false);
				                }
				            },
				            failure: function(f, o){
								console.info(o);
				                Ext.Msg.alert('{$error}', o.msg);
				                Ext.Viewport.setMasked(false);
				            }
				        });
                    } 
                }
            }
        ]
    }

});
