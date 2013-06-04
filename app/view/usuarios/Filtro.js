/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.usuarios.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filterusuarioswin',

    id: 'FilterUsuariosWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filtro de Usuarios',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterUsuarios',
                    bodyPadding: 10,
                    autoScroll: true,
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
									id: 'nome_filter_usuarios',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Nome'
								},								
								{
									xtype: 'datefield',
									format: 'd/m/Y',																		
									flex: 1,
								
									name: 'data_cadastro',
									id: 'data_cadastro_filter_usuarios',
									anchor: '100%',
									fieldLabel: 'Data Cadastro'
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
									id: 'email_filter_usuarios',									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.Ajax.request({
												url: 'server/modulos/usuarios/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: 'email',
													valor: this.getValue()
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													if(dados.success==false){
														Ext.getCmp('email_usuarios').markInvalid('Usuário Ja Existe...');
													}
												}
											});
										}
									},		
									validator: function(value){
										if(!isEmail(value)){
											return 'E-mail Inválido...';
										}
										else{
											return true;
										}
									},																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Email'
								},								
								{
									xtype: 'textfield',
									name: 'login',								    								    
								    flex: 1,
									id: 'login_filter_usuarios',									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.Ajax.request({
												url: 'server/modulos/usuarios/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: 'login',
													valor: this.getValue()
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													if(dados.success==false){
														Ext.getCmp('login_usuarios').markInvalid('Usuário Ja Existe...');
													}
												}
											});
										}
									},																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Login'
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
		                                    store: 'StoreComboGrupo',
		                                    name: 'id_grupo',
											id: 'id_grupo_filter_usuarios',
											button_id: 'button_id_grupo_filter_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Grupo'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_id_grupo_filter_usuarios',
		                                    combo_id: 'id_grupo_filter_usuarios',
		                                    action: 'reset_combo'
		                                },
		                            ]
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
											id: 'status_filter_usuarios',
											button_id: 'button_status_filter_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Status'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_status_filter_usuarios',
		                                    combo_id: 'status_filter_usuarios',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        }

							]
						},
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							anchor: '50%',
							margins: '0 5 0 0',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
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
		                                    store: 'StoreComboExportarUsuarios',
		                                    name: 'exportar',
											loadDisabled: true,
											id: 'exportar_filter_usuarios',
											button_id: 'button_exportar_filter_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Exportar'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_exportar_filter_usuarios',
		                                    combo_id: 'exportar_filter_usuarios',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        },

							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_usuarios',
							allowBlank: false,
							value: 'FILTER',
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
                            xtype: 'button',
                            iconCls: 'bt_cancel',
                            action: 'resetar_filtro',
                            text: 'Resetar Filtro'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: 'Filtrar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
