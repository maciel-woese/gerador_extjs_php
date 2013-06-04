/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.usuarios.Filtro', {
    extend: '{$app|capitalize}.view.WindowMedium',
    alias: 'widget.filterusuarioswin',

    id: 'FilterUsuariosWin',
    layout: {
        type: 'fit'
    },
    
    title: 'Filter Users',

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
									fieldLabel: 'Name'
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
		                                    store: 'StoreComboPerfil',
		                                    name: 'perfil_id',
											id: 'perfil_id_filter_usuarios',
											button_id: 'button_perfil_id_filter_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Profile'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_perfil_id_filter_usuarios',
		                                    combo_id: 'perfil_id_filter_usuarios',
		                                    action: 'reset_combo'
		                                },
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
									id: 'email_filter_usuarios',		
									validator: function(value){
										if(!isEmail(value)){
											return 'E-mail Invalid...';
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
									id: 'login_filter_usuarios',																											
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
		                                    store: 'StoreComboStatusUsuarios',
		                                    name: 'status',
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
		                                    store: 'StoreComboAdministradorUsuarios',
		                                    name: 'administrador',
											id: 'administrador_filter_usuarios',
											button_id: 'button_administrador_filter_usuarios',
											flex: 1,
											anchor: '100%',
											fieldLabel: 'Administrator'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_administrador_filter_usuarios',
		                                    combo_id: 'administrador_filter_usuarios',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        }

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
                            text: 'Reset Filter'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: 'Filter'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
