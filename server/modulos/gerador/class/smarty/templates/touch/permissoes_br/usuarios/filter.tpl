Ext.define('{$app|capitalize}.view.usuarios.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuariosfilter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormUsuariosFilter',
        url: 'server/modulos/usuarios/list.php',
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Usuarios',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: 'Voltar',
						action: 'back'
                    }
                ]
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                items: [
                    {
                        xtype: 'spacer'
                    },
					{
                        xtype: 'button',
                        ui: 'decline',
						action: 'reset',
                        text: 'Resetar'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'filter',
                        text: 'Filtrar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
	
					{
                        xtype: 'textfield',
						id: 'nome_filter_usuarios',
                        label: 'Nome',
						name: 'nome'
                    },
	
	
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
								store: 'StoreComboPerfil',
								name: 'perfil_id',
								id: 'perfil_id_filter_usuarios',
								button_id: 'button_perfil_id_filter_usuarios',
								flex: 1,
								label: 'Perfil'
							},
							{
								xtype: 'button',
								iconCls: 'compose',
								hidden: true,
								id: 'button_perfil_id_filter_usuarios',
								combo_id: 'perfil_id_filter_usuarios',
								action: 'reset_combo'
							}
						]
					},
	
					{
                        xtype: 'textfield',
						id: 'email_filter_usuarios',
                        label: 'Email',
						name: 'email'
                    },
	
					{
                        xtype: 'textfield',
						id: 'login_filter_usuarios',
                        label: 'Login',
						name: 'login'
                    },
	
					{
                        xtype: 'passwordfield',
                        label: 'Senha',
						id: 'senha_filter_usuarios',
						name: 'senha'
                    },
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
								name: 'administrador',
								loadDisabled: true,
								id: 'administrador_filter_usuarios',
								button_id: 'button_administrador_filter_usuarios',
								store: 'StoreComboAdministradorUsuarios',
								flex: 1,
								label: 'Administrador'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_administrador_filter_usuarios',
								combo_id: 'administrador_filter_usuarios',
								action: 'reset_combo'
							}
						]
					},
	
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
								name: 'status',
								loadDisabled: true,
								id: 'status_filter_usuarios',
								button_id: 'button_status_filter_usuarios',
								store: 'StoreComboStatusUsuarios',
								flex: 1,
								label: 'Status'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_status_filter_usuarios',
								combo_id: 'status_filter_usuarios',
								action: 'reset_combo'
							}
						]
					},
	
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_usuarios',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


