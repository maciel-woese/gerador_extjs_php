Ext.define('ShSolutions.view.login.AddLoginWin', {
    extend: 'Ext.window.Window',
    alias: 'widget.addloginwin',

    autoHeight: true,
    modal: true,
    draggable: false,
    closable: false,
    resizable: false,
    id: 'AddLoginWin',
    width: 350,
    height: 270,
    layout: {
        type: 'border'
    },
    title: 'Login do Sistema',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
				{
                    xtype: 'panel',
                    border: false,
                    id: 'panel_img',
                    region: 'north',
                    html: '<div style="text-align:center;padding:3px"><img src="resources/images/logo.png"/></div>',
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
                    url: 'server/modulos/login/list.php',
                    items: [
                        {
                            xtype: 'textfield',
                            id: 'LoginLogin',
                            name: 'login_user',
                            fieldLabel: 'Login',
                            allowBlank: false,
                            labelWidth: 60,
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            id: 'SenhaLogin',
                            inputType: 'password',
                            name: 'senha_user',
                            fieldLabel: 'Senha',
                            labelWidth: 60,
                            allowBlank: false,
                            anchor: '100%'
                        },
						{
                            xtype: 'radiogroup',
                            id: 'LocaleLogin',
							labelWidth: 60,
                            fieldLabel: 'Traduzir',
                            items: [
                                {
                                    xtype: 'radiofield',
                                    name: 'locale',
                                    inputValue: 'br',
                                    boxLabel: 'Portugu&ecirc;s',
                                    checked: true
                                },
								{
                                    xtype: 'radiofield',
                                    name: 'locale',
                                    inputValue: 'en',
                                    boxLabel: 'English'
                                }
                            ],
							listeners: {
								change: me.setLanguage,
                                scope: me
							}
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							id: 'tipo_usuario',
							name: 'tipo',
							value: 'administrador'
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							name: 'action',
							id: 'action_login',
							value: 'LOGIN_USER'
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
						    xtype: 'button',
						    iconCls: 'bt_add',
							id: 'button_cadastro_login',
						    text: 'Cadastrar-se',
						    handler: function(){
						    	var win = Ext.getCmp('AddCadastroWin');
								if(!win) win = Ext.widget('addcadastrowin');
								win.show();
						    }
						},
						{
                        	xtype: 'tbfill'
                        },
						{
						    xtype: 'button',
						    iconCls: 'bt_cancel',
							id: 'button_resetar_login',
						    text: 'Resetar',
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
							id: 'button_connectar_login',
                            text: 'Conectar',
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
	
	setEn: function(){
		Ext.getCmp('button_cadastro_login').setText('Join');
		Ext.getCmp('button_resetar_login').setText('Reset');
		Ext.getCmp('button_connectar_login').setText('Connect');
		
		Ext.getCmp('LocaleLogin').setFieldLabel('Translate');
		Ext.getCmp('SenhaLogin').setFieldLabel('Password');
		Ext.getCmp('LoginLogin').setFieldLabel('Login');
		
		Ext.getCmp('AddLoginWin').setTitle('Login System');
		
		Ext.define("Ext.locale.en.cadastro.Edit", {
			override: "ShSolutions.view.cadastro.Edit",
			
			title: 'Sign Up',
			reset: 'Reset',
			aguarde: 'Wait...',
			save: 'Save',
			nome: 'Name',
			login: 'Login',
			pass: 'Password',
			email: 'E-mail',
			invalid_email: 'E-mail Invalid...'
		});
	},
	
	setBr: function(){
		Ext.getCmp('button_cadastro_login').setText('Cadastre-se');
		Ext.getCmp('button_resetar_login').setText('Resetar');
		Ext.getCmp('button_connectar_login').setText('Conectar');
		
		Ext.getCmp('LocaleLogin').setFieldLabel('Traduzir');
		Ext.getCmp('SenhaLogin').setFieldLabel('Senha');
		Ext.getCmp('LoginLogin').setFieldLabel('Login');
		
		Ext.getCmp('AddLoginWin').setTitle('Login do Sistema');
			
		Ext.define("Ext.locale.en.cadastro.Edit", {
			override: "ShSolutions.view.cadastro.Edit",
			
			title: 'Registre-se',
			reset: 'Resetar',
			aguarde: 'Aguarde...',
			save: 'Salvar',
			nome: 'Nome',
			login: 'Login',
			pass: 'Senha',
			email: 'E-mail',
			invalid_email: 'E-mail Inv&aacute;lido...'
		});
		
	},
	
	setLanguage: function(comp, nv, ov){
		var me = this;
		if(nv.locale=='en'){
			me.setEn();
		}
		else{
			me.setBr();
		}
	},

    LoginSys: function(button, e, options) {
    	if(!Ext.getCmp('FormLogin').getForm().isValid()){
    		return true;
    	}
    	button.setDisabled(true);
    	Ext.getCmp('FormLogin').getEl().mask('Aguarde...');
        Ext.getCmp('FormLogin').getForm().submit({
            success: function(f, o){
                if(o.result.success===true){
                    window.location = 'index.php';
                }
                else{
                    Ext.Msg.alert('Erro', o.result.msg);
                    button.setDisabled(false);
                    Ext.getCmp('FormLogin').getEl().unmask();
                }
            },
            failure: function(f, o){
				console.info(o);
                Ext.Msg.alert('Erro', o.result.msg);
                button.setDisabled(false);
                Ext.getCmp('FormLogin').getEl().unmask();
            }
        });
    }

});
