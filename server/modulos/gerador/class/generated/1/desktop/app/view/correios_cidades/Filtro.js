/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_cidades.Filtro', {
    extend: 'ShSolutions.view.WindowMedium',
    alias: 'widget.filtercorreios_cidadeswin',

    id: 'FilterCorreios_CidadesWin',
    layout: {
        type: 'fit'
    },
    modal: true,
    minimizable: false,
	
    title: 'Filtro de Correios_Cidades',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterCorreios_Cidades',
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
									name: 'loc_nome_abreviado',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'loc_nome_abreviado_filter_correios_cidades',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Loc Nome Abreviado'
								},								
								{
									xtype: 'textfield',
									name: 'loc_nome',								    								    
								    flex: 1,
									id: 'loc_nome_filter_correios_cidades',																											
									allowBlank: false,
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
									id: 'cep_filter_correios_cidades',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Cep'
								},								
								{
									xtype: 'textfield',
									name: 'uf_sigla',								    								    
								    flex: 1,
									id: 'uf_sigla_filter_correios_cidades',																											
									allowBlank: false,
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
									id: 'loc_tipo_filter_correios_cidades',																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: 'Loc Tipo'
								},								
								{
									xtype: 'textfield',
									name: 'ativo',								    								    
								    flex: 1,
									id: 'ativo_filter_correios_cidades',																											
									allowBlank: false,
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
									id: 'cadastrado_por_filter_correios_cidades',
									anchor: '100%',
									fieldLabel: 'Cadastrado Por'
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
											id: 'data_cadastro_date_filter_correios_cidades',
											name: 'data_cadastro_date',
											margins: '0 5 0 0',
											hideLabel: true
										},
										{
											xtype: 'textfield',
											mask: '99:99:99',
											plugins: 'textmask',
											returnWithMask: true,
											flex: 1,
											id: 'data_cadastro_time_filter_correios_cidades',
											name: 'data_cadastro_time',
											hideLabel: true
										}
									]
								}								

							]
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_correios_cidades',
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
                            text: 'Resetar Filtro'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: 'Filtrar'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
