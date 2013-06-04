/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.usuarios.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addusuarioswin',

    id: 'AddUsuariosWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Usu&aacute;rios',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormUsuarios',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/usuarios/save.php',
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
									xtype: 'textfield',
									name: 'nome',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'nome_usuarios',
									anchor: '100%',									
									fieldLabel: 'Nome'
									
								},								
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,
									disabled: responseUsuario.filial_id_admin == 0 ? false : true,
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
		                                {
											xtype: 'combobox',
		                                    store: 'StoreComboPerfil',
		                                    name: 'perfil_id',
											id: 'perfil_id_usuarios',
											button_id: 'button_perfil_id_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Perfil'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_perfil_id_usuarios',
		                                    combo_id: 'perfil_id_usuarios',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Perfil',
											action: 'add_win'
		                                }
		                            ]
		                        }		                        

							]
						},
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'textfield',
									name: 'email',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'email_usuarios',
									anchor: '100%',		
									validator: function(value){
										if(value!="" && !isEmail(value)){
											return 'E-mail Inválido...';
										}
										else{
											return true;
										}
									},									
									fieldLabel: 'Email'
									
								},								
								{
									xtype: 'textfield',
									name: 'login',								    								    
								    flex: 1,
									id: 'login_usuarios',
									anchor: '100%',									
									fieldLabel: 'Login',
									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.getCmp('login_usuarios').up('form').el.mask('Aguarde...');
											Ext.Ajax.request({
												url: 'server/modulos/usuarios/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: 'login',
													valor: v
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													Ext.getCmp('login_usuarios').up('form').el.unmask();
													if(dados.success==false){
														Ext.getCmp('login_usuarios').markInvalid('LOGIN Ja Existe...');
													}
												},
												failure: function(s, o){
													console.info(s);
													Ext.getCmp('login_usuarios').up('form').el.unmask();
												}
											});
										}
									}
								}								

							]
						},
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
								{
									xtype: 'textfield',
									name: 'senha',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'senha_usuarios',
									anchor: '100%',				
									inputType: 'password',									
									fieldLabel: 'Senha'
								},
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,								    								    
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
		                                {
											xtype: 'combobox',
		                                    store: 'StoreComboStatusUsuarios',
		                                    name: 'status',
											loadDisabled: true,
											id: 'status_usuarios',
											button_id: 'button_status_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Status'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_status_usuarios',
		                                    combo_id: 'status_usuarios',
		                                    action: 'reset_combo'
		                                }
		                            ]
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_usuarios',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_usuarios',
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
                            id: 'button_resetar_usuarios',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_usuarios',
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
