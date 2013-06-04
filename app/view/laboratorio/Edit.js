/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.laboratorio.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addlaboratoriowin',

    id: 'AddLaboratorioWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Laboratorio',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormLaboratorio',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/laboratorio/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'laboratorio',
							id: 'laboratorio_laboratorio',
							anchor: '100%',							
							fieldLabel: 'Laboratorio'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_laboratorio',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_laboratorio',
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
                            id: 'button_resetar_laboratorio',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_laboratorio',
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
