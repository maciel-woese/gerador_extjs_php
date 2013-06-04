Ext.define('ShSolutions.view.gerador.Login', {
    extend: 'Ext.window.Window',
    alias: 'widget.addgeradorwin',

	id: 'AddGeradorWin',
    layout: {
        type: 'fit'
    },
	
	title: 'Login Banco',
	
	field_tipo_banco: 'Tipo de Banco',
	field_radio_mysql: 'Mysql',
	field_radio_pgsql: 'PostgreSql',
	field_servidor: 'Servidor',
	field_usuario: 'Usu&aacute;rio',
	field_senha: 'Senha',
	field_banco: 'Banco',
	field_schema: 'Schema',
	
	buttonLoginBanco: 'Logar <b>Alt+L</b>',
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			title: me.title,
			
            items: [
                {
                    xtype: 'form',
                    id: 'FormGerador',
                    bodyPadding: 10,
                    url: 'server/modulos/gerador/login.php',
                    items: [
                        {
                            xtype: 'fieldset',
                            items: [
                                {
									xtype: 'radiogroup',
									id: 'tipo_banco',
									fieldLabel: me.field_tipo_banco,
									items: [
										{
											xtype: 'radiofield',
											name: 'tipo',
											boxLabel: me.field_radio_mysql,
											checked: true,
											inputValue: 'mysql'
										},
										{
											xtype: 'radiofield',
											name: 'tipo',
											boxLabel: me.field_radio_pgsql,
											inputValue: 'pgsql'
										}
									]
								},
								{
                                    xtype: 'textfield',
                                    id: 'ServidorBanco',
                                    name: 'servidor',
									allowBlank: false,
                                    value: '127.0.0.1',
                                    fieldLabel: me.field_servidor,
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'UsuarioBanco',
                                    name: 'usuario',
                                    value: 'root',
									allowBlank: false,
                                    fieldLabel: me.field_usuario,
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'SenhaBanco',
                                    inputType: 'password',
                                    name: 'senha',
                                    value: '',
                                    allowBlank: true,
                                    fieldLabel: me.field_senha,
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'DatabaseBanco',
                                    name: 'banco',
									allowBlank: false,
                                    fieldLabel: me.field_banco,
                                    anchor: '100%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'SchemaBanco',
									disabled: true,
                                    name: 'schema',
                                    value: 'public',
                                    fieldLabel: me.field_schema,
                                    anchor: '100%'
                                }
                            ]
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
							id: 'login_banco_login',
							action: 'login_banco',
                            iconCls: 'bt_login',
                            text: me.buttonLoginBanco
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});