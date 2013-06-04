/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.especialidades.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addespecialidadeswin',

    id: 'AddEspecialidadesWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Especialidades',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormEspecialidades',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/especialidades/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'especialidade',
							id: 'especialidade_especialidades',
							anchor: '100%',							
							fieldLabel: 'Especialidade'
						},
						{
							xtype: 'textarea',
							name: 'obs',
							id: 'obs_especialidades',
							anchor: '100%',							
							fieldLabel: 'Obs'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_especialidades',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_especialidades',
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
                            id: 'button_resetar_especialidades',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_especialidades',
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
