/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_cidades.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addcorreios_cidadeswin',

    id: 'AddCorreios_CidadesWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
    title: 'Cadastro de Correios_Cidades',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormCorreios_Cidades',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/correios_cidades/save.php',
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
									name: 'loc_nome_abreviado',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'loc_nome_abreviado_correios_cidades',
									anchor: '100%',									
									fieldLabel: 'Loc Nome Abreviado'									
								},								
								{
									xtype: 'textfield',
									name: 'loc_nome',								    								    
								    flex: 1,
									id: 'loc_nome_correios_cidades',
									anchor: '100%',									
									fieldLabel: 'Loc Nome'									
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
									name: 'cep',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'cep_correios_cidades',
									anchor: '100%',									
									fieldLabel: 'Cep'									
								},								
								{
									xtype: 'textfield',
									name: 'uf_sigla',								    								    
								    flex: 1,
									id: 'uf_sigla_correios_cidades',
									anchor: '100%',									
									fieldLabel: 'Uf Sigla'									
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
									name: 'loc_tipo',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'loc_tipo_correios_cidades',
									anchor: '100%',									
									fieldLabel: 'Loc Tipo'									
								},								
								{
									xtype: 'textfield',
									name: 'ativo',								    								    
								    flex: 1,
									id: 'ativo_correios_cidades',
									anchor: '100%',									
									fieldLabel: 'Ativo'									
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
									xtype: 'numberfield',
									name: 'cadastrado_por',								    
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'cadastrado_por_correios_cidades',
									anchor: '100%',									fieldLabel: 'Cadastrado Por'
								},								
								{
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},																		
									flex: 1,
									labelAlign: 'top',
									labelStyle: 'font-weight: bold;font-size: 11px;',			    
									fieldLabel: 'Data Cadastro',
									items: [
										{
											xtype: 'datefield',
											format: 'd/m/Y',
											flex: 1,
											id: 'data_cadastro_date_correios_cidades',
											name: 'data_cadastro_date',
											margins: '0 5 0 0',											hideLabel: true
										},
										{
											xtype: 'textfield',
											mask: '99:99:99',
											plugins: 'textmask',
											returnWithMask: true,
											flex: 1,
											id: 'data_cadastro_time_correios_cidades',
											name: 'data_cadastro_time',											hideLabel: true
										}
									]
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_correios_cidades',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_correios_cidades',
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
                            id: 'button_resetar_correios_cidades',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_correios_cidades',
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
