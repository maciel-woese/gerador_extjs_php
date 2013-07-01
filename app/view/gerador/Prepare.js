Ext.define('ShSolutions.view.gerador.Prepare', {
    extend: 'Ext.window.Window',
    alias: 'widget.preparewin',

	id: 'PrepareWin',
    layout: {
        type: 'fit'
    },
	
    title: 'Gerar Crud',
	
	field_radio_padrao: 'Padr&atilde;o',
	field_radio_desktop: 'Desktop',
	field_radio_touch: 'Touch',
	
	field_container_touch_layout: 'Tela Principal',
	field_container_perm_users: 'Permiss&otilde;es de Usu&aacute;rios',
	
	field_pdf: 'Gerar PDF',
	field_titulo: 'Titulo Sistema',
	field_version: 'Vers&atilde;o Sistema',
	
	boxLista: 'Lista',
	boxIcone: 'Icones',
	boxYes: 'Sim',
	boxNo: 'N&atilde;o',
	
	button_gerar_crud: 'Gerar Crud',
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			title: me.title,
            items: [
                {
                    xtype: 'form',
                    id: 'FormPrepare',
                    bodyPadding: 10,
                    title: 'Config.',
					defaults: {
						labelWidth: 140
					},
                    items: [
                        {
                            xtype: 'radiogroup',
                            id: 'layout_crud_prepare',
                            fieldLabel: 'Layout',
                            items: [
                                {
                                    xtype: 'radiofield',
                                    name: 'tipo',
                                    inputValue: 'padrao',
                                    boxLabel: me.field_radio_padrao,
                                    checked: true
                                },
								{
                                    xtype: 'radiofield',
                                    name: 'tipo',
                                    inputValue: 'desktop',
                                    boxLabel: me.field_radio_desktop
                                },
								{
                                    xtype: 'radiofield',
                                    name: 'tipo',
                                    inputValue: 'touch',
                                    boxLabel: me.field_radio_touch
                                }
                            ]
                        },
						{
							xtype: 'fieldcontainer',
							layout: {
								type: 'hbox'
							},
							id: 'touch_layout_crud_prepare',
							hidden: true,
                            fieldLabel: me.field_container_touch_layout,
							items: [
								{
									xtype: 'radiogroup',
									hideLabel: true,
									flex: 1,
									items: [
										{
											xtype: 'radiofield',
											name: 'touch_tela',
											inputValue: 'lista',
											boxLabel: me.boxLista,
											checked: true
										},
										{
											xtype: 'radiofield',
											inputValue: 'icone',
											name: 'touch_tela',
											boxLabel: me.boxIcone
										}
									]
								},
								{
									xtype: 'button',
									id: 'information_tl',
									iconCls: 'information',
									action: 'help_tl'
								}
							]
						},
                        {
							xtype: 'combobox',
							store: 'StoreComboTabelasPDF',
							name: 'tabelas[]',
							multiSelect: true,
							allowBlank: true,
							id: 'tabelas_prepare',
							flex: 1,
							anchor: '100%',
							fieldLabel: me.field_pdf
						},
                        {
                        	xtype: 'textfield',
                        	anchor: '100%',
                        	name: 'titulo',
							allowBlank: false,
                        	value: '',
                        	fieldLabel: me.field_titulo
                        },
                        {
                            xtype: 'textfield',
                            anchor: '100%',
                            name: 'version',
                            allowBlank: false,
							value: '1.0.1',
                            fieldLabel: me.field_version
                        },
						{
							xtype: 'fieldcontainer',
							layout: {
								type: 'hbox'
							},
                            fieldLabel: me.field_container_perm_users,
							items: [
								{
									xtype: 'radiogroup',
									hideLabel: true,
									flex: 1,
									items: [
										{
											xtype: 'radiofield',
											name: 'permissoes_usuarios',
											inputValue: 'sim',
											boxLabel: me.boxYes,
											checked: true
										},
										{
											xtype: 'radiofield',
											inputValue: 'nao',
											name: 'permissoes_usuarios',
											boxLabel: me.boxNo
										}
									]
								},
								{
									xtype: 'button',
									id: 'information_pu',
									iconCls: 'information',
									action: 'help_pu'
								}
							]
						},
						{
							xtype: 'hiddenfield',
							name: 'autor',
							value: 'sim'
						},
						{
							xtype: 'hiddenfield',
							name: 'class',
                            value: 'ShSolutions'
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
							action: 'gerar_crud',
                            iconCls: 'bt_gerar',
                            text: me.button_gerar_crud
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});