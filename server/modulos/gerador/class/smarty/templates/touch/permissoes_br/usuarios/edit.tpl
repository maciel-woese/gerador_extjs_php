/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.usuarios.Edit', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuariosform',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'FormUsuarios',
        url: 'server/modulos/usuarios/save.php',
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
                        ui: 'confirm',
						action: 'salvar',
                        text: 'Salvar'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
					{
                        xtype: 'textfield',
						id: 'nome_usuarios',
						name: 'nome',
						label: 'Nome'
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
								id: 'perfil_id_usuarios',
								button_id: 'button_perfil_id_usuarios',
								flex: 1,
								labelWidth: '34%',
								label: 'Perfil'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_perfil_id_usuarios',
								combo_id: 'perfil_id_usuarios',
								action: 'reset_combo'
							},
							{
								xtype: 'button',
								iconCls: 'add',
								iconMask: true,
								modulo: 'Perfil',
								action: 'add_win'
							}
						]
					},
					{
                        xtype: 'textfield',
						id: 'email_usuarios',
						name: 'email',
						label: 'Email'
                    },
					{
                        xtype: 'textfield',
						id: 'login_usuarios',
						name: 'login',
						label: 'Login'
                    },
					{
                        xtype: 'passwordfield',
						id: 'senha_usuarios',
                        name: 'senha',
						label: 'Senha'
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
								store: 'StoreComboAdministradorUsuarios',
								name: 'administrador',
								loadDisabled: true,
								id: 'administrador_usuarios',
								button_id: 'button_administrador_usuarios',
								flex: 1,
								label: 'Administrador'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_administrador_usuarios',
								combo_id: 'administrador_usuarios',
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
								store: 'StoreComboStatusUsuarios',
								name: 'status',
								loadDisabled: true,
								id: 'status_usuarios',
								button_id: 'button_status_usuarios',
								flex: 1,
								label: 'Status'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
								id: 'button_status_usuarios',
								combo_id: 'status_usuarios',
								action: 'reset_combo'
							}
						]
					},
					{
						xtype: 'hiddenfield',
						name: 'id',
						hidden: true,
						id: 'id_usuarios',
						value: 0,
						anchor: '100%'
					},
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_usuarios',
						value: 'INSERIR',
						anchor: '100%'
					}
                ]
            }
        ]
    }

});

