/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.view.perfil.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addperfilwin',

    id: 'AddPerfilWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Perfil',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormPerfil',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/perfil/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'perfil',
							id: 'perfil_perfil',
							anchor: '100%',							
							
							fieldLabel: 'Perfil'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_perfil',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_perfil',
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
                            id: 'button_resetar_perfil',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_perfil',
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
