/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.veiculos.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addveiculoswin',

    id: 'AddVeiculosWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Veiculos',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormVeiculos',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/veiculos/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'veiculo',
							id: 'veiculo_veiculos',
							anchor: '100%',							
							fieldLabel: 'Veiculo'
						},
						{
							xtype: 'numberfield',
							name: 'passageiros',
							id: 'passageiros_veiculos',
							anchor: '100%',						
							fieldLabel: 'Passageiros'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_veiculos',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_veiculos',
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
                            id: 'button_resetar_veiculos',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_veiculos',
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
