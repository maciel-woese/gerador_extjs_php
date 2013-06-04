/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.filial.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addfilialwin',

    id: 'AddFilialWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Filial',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormFilial',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/filial/save.php',
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
									name: 'filial',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'filial_filial',
									anchor: '100%',									
									fieldLabel: 'Filial'									
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
		                                    store: 'StoreComboEstados',
		                                    name: 'uf_id',
											id: 'uf_id_filial',
											button_id: 'button_uf_id_filial',
											flex: 1,
											anchor: '100%',											
											fieldLabel: 'Estado'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_uf_id_filial',
		                                    combo_id: 'uf_id_filial',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Estados',
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
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,								    
								    margin: '0 5 0 0',								    
								    flex: 1,
		                            layout: {
		                                align: 'stretch',
		                                type: 'hbox'
		                            },
		                            items: [
		                                {
											xtype: 'combobox',
		                                    store: 'StoreComboCidades',
		                                    name: 'cidade_id',
											id: 'cidade_id_filial',
											button_id: 'button_cidade_id_filial',
											flex: 1,
											disabled: true,
											loadDisabled: true,
											anchor: '100%',											
											fieldLabel: 'Cidade'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_cidade_id_filial',
		                                    combo_id: 'cidade_id_filial',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: 'Cidades',
											action: 'add_win'
		                                }
		                            ]
		                        },		                        
								{
									xtype: 'textfield',
									name: 'bairro',								    								    
								    flex: 1,
									id: 'bairro_filial',
									anchor: '100%',									
									fieldLabel: 'Bairro'									
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
									name: 'endereco',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'endereco_filial',
									anchor: '100%',									
									fieldLabel: 'Endereco'									
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_filial',
									anchor: '100%',									
									mask: '99.999-999',
									plugins: 'textmask',									
									fieldLabel: 'Cep'									
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
									xtype: 'textfield',
									name: 'telefone',								    								    
								    flex: 1,
									margin: '0 5 0 0',
									id: 'telefone_filial',
									anchor: '100%',							
									mask: '(99) 9999-9999',
									plugins: 'textmask',									
									fieldLabel: 'Telefone'									
								},
								{
									xtype: 'textfield',
									name: 'email',
								    flex: 1,
									id: 'email_filial',
									anchor: '100%',	validator: function(value){
										if(value!="" && !isEmail(value)){
											return 'E-mail Inválido...';
										}
										else{
											return true;
										}
									},						
									fieldLabel: 'Email'
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
									xtype: 'textfield',
									name: 'login',								    								    
								    flex: 1,
									margin: '0 5 0 0',
									id: 'login_filial',
									anchor: '100%',									
									fieldLabel: 'Login',
									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.getCmp('login_filial').up('form').el.mask('Aguarde...');
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
													Ext.getCmp('login_filial').up('form').el.unmask();
													if(dados.success==false){
														Ext.getCmp('login_filial').markInvalid('LOGIN Ja Existe...');
													}
												},
												failure: function(s, o){
													console.info(s);
													Ext.getCmp('login_filial').up('form').el.unmask();
												}
											});
										}
									}
								},
								{
									xtype: 'textfield',
									name: 'senha',									
								    flex: 1,
									id: 'senha_filial',
									anchor: '100%',				
									inputType: 'password',									
									fieldLabel: 'Senha'
								}
							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_filial',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filial',
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
                            id: 'button_resetar_filial',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_filial',
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
