
function isEmail(email){
	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(!filter.test(email)){
		return false;
	}
	else return true;

}

Ext.define('ShSolutions.view.cadastro.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.addcadastrowin',

    autoHeight: true,
    modal: true,
    draggable: false,
    resizable: false,
    id: 'AddCadastroWin',
    width: 350,
    height: 290,
    layout: {
        type: 'border'
    },
	
    title: 'Cadastro do Sistema',
	reset: 'Resetar',
	aguarde: 'Aguarde...',
	save: 'Salvar',
	nome: 'Nome',
	login: 'Login',
	pass: 'Senha',
	email: 'E-mail',
	invalid_email: 'E-mail Inv&aacute;lido...',
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			title: me.title,
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
                    id: 'FormCadastro',
                    bodyPadding: 10,
                    method: 'POST',
                    url: 'server/modulos/cadastro/save.php',
                    items: [
                        {
                            xtype: 'textfield',
                            id: 'NomeCadastro',
                            name: 'nome_user',
                            fieldLabel: me.nome,
                            allowBlank: false,
                            labelWidth: 60,
                            anchor: '100%'
                        },
						{
                            xtype: 'textfield',
                            id: 'EmailCadastro',
                            name: 'email_user',
                            fieldLabel: me.email,
                            allowBlank: false,
                            labelWidth: 60,
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
                            xtype: 'textfield',
                            id: 'LoginCadastro',
                            name: 'login_user',
                            fieldLabel: me.login,
                            labelWidth: 60,
                            allowBlank: false,
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            id: 'SenhaCadastro',
                            inputType: 'password',
                            name: 'senha_user',
                            fieldLabel: me.pass,
                            labelWidth: 60,
                            allowBlank: false,
                            anchor: '100%'
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							name: 'action',
							id: 'action_cadastro',
							value: 'INSERIR'
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
						    text: me.reset,
						    handler: function(){
						    	Ext.getCmp('FormCadastro').getForm().reset();
						    }
						},
						{
							xtype: 'tbseparator'
						},
                        {
                            xtype: 'button',
                            iconCls: 'bt_save',
                            text: me.save,
                            listeners: {
                                click: {
                                    fn: me.CadastroSys,
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
	
	enviaC: 0,
	
	confirm: function(){
		var me = this;
		Ext.Ajax.request({
			url: 'server/modulos/email/confirm_cadastro.php',
			success: function(o){
				var o = Ext.decode(o.responseText);
				console.info(o);
				if(o.success==true){
					Ext.Msg.alert('Sucess', o.msg);
					Ext.getCmp('AddLoginWin').getEl().unmask();
				}
				else{
					if(me.enviaC>2){
						Ext.Msg.alert('Error', o.msg);
						Ext.getCmp('AddLoginWin').getEl().unmask();
					}
					else{
						me.enviaC ++;
						me.confirm();
					}
				}
			},
			failure: function(o){
				if(me.enviaC>2){
						Ext.Msg.alert('Error', 'Error!');
						Ext.getCmp('AddLoginWin').getEl().unmask();
					}
					else{
						me.enviaC ++;
						me.confirm();
					}
			}
		});
	},

    CadastroSys: function(button, e, options) {
		var me = this;
    	if(!Ext.getCmp('FormCadastro').getForm().isValid()){
    		return true;
    	}
    	button.setDisabled(true);
    	Ext.getCmp('FormCadastro').getEl().mask(me.aguarde);
		
        Ext.getCmp('FormCadastro').getForm().submit({
			params:{
				language: Ext.getCmp('LocaleLogin').getValue().locale
			},
            success: function(f, o){
                if(o.result.success===true){
					Ext.getCmp('AddLoginWin').getEl().mask(me.aguarde);

					me.confirm();
					
					Ext.getCmp('AddCadastroWin').close();
                }
                else{
                    Ext.Msg.alert('Erro', o.result.msg);
                    button.setDisabled(false);
                    Ext.getCmp('FormCadastro').getEl().unmask();
                }
            },
            failure: function(f, o){
				console.info(o);
                Ext.Msg.alert('Erro', o.result.msg);
                button.setDisabled(false);
                Ext.getCmp('FormCadastro').getEl().unmask();
            }
        });
    }

});
