/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.cidades.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addcidadeswin',

    id: 'AddCidadesWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Cidades',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormCidades',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/cidades/save.php',
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
									xtype: 'combobox',
                                    store: 'StoreComboEstados',
                                    name: 'estado_id',
									id: 'estado_id_cidades',
									button_id: 'button_estado_id_cidades',
									flex: 1,									
									anchor: '100%',
									fieldLabel: 'Estado'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_estado_id_cidades',
                                    combo_id: 'estado_id_cidades',
                                    action: 'reset_combo'
                                },
                                {
                                    xtype: 'buttonadd',
									tabela: 'Estados',
                                    action: 'add_win'
                                }
                            ]
                        },
						{
							xtype: 'textfield',
							name: 'cidade',
							id: 'cidade_cidades',
							anchor: '100%',							
							fieldLabel: 'Cidade'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_cidades',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_cidades',
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
                            id: 'button_resetar_cidades',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_cidades',
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
