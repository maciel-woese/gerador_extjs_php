/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_enderecos.Edit', {
    extend: 'ShSolutions.view.WindowMedium',
	alias: 'widget.addcorreios_enderecoswin',

    id: 'AddCorreios_EnderecosWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
    title: 'Cadastro de Correios_Enderecos',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormCorreios_Enderecos',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/correios_enderecos/save.php',
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
									name: 'uf_sigla',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'uf_sigla_correios_enderecos',
									anchor: '100%',									
									fieldLabel: 'Uf Sigla'									
								},								
								{
									xtype: 'numberfield',
									name: 'localidade_id',								    								    
								    flex: 1,
									id: 'localidade_id_correios_enderecos',
									anchor: '100%',									fieldLabel: 'Localidade Id'
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
									name: 'nome',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'nome_correios_enderecos',
									anchor: '100%',									
									fieldLabel: 'Nome'									
								},								
								{
									xtype: 'numberfield',
									name: 'bairro_id_inicial',								    								    
								    flex: 1,
									id: 'bairro_id_inicial_correios_enderecos',
									anchor: '100%',									fieldLabel: 'Bairro Id Inicial'
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
									name: 'bairro_id_final',								    
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'bairro_id_final_correios_enderecos',
									anchor: '100%',									fieldLabel: 'Bairro Id Final'
								},								
								{
									xtype: 'textfield',
									name: 'cep',								    								    
								    flex: 1,
									id: 'cep_correios_enderecos',
									anchor: '100%',									
									fieldLabel: 'Cep'									
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
									name: 'complemento',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'complemento_correios_enderecos',
									anchor: '100%',									
									fieldLabel: 'Complemento'									
								},								
								{
									xtype: 'textfield',
									name: 'tipo',								    								    
								    flex: 1,
									id: 'tipo_correios_enderecos',
									anchor: '100%',									
									fieldLabel: 'Tipo'									
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
									name: 'ativo',									
								    margin: '0 5 0 0',								    
								    flex: 1,
									id: 'ativo_correios_enderecos',
									anchor: '100%',									
									fieldLabel: 'Ativo'									
								},								
								{
									xtype: 'numberfield',
									name: 'cadastrado_por',								    								    
								    flex: 1,
									id: 'cadastrado_por_correios_enderecos',
									anchor: '100%',									fieldLabel: 'Cadastrado Por'
								}								

							]
						},
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
							anchor: '50%',
							margins: '0 5 0 0',
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
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
											id: 'data_cadastro_date_correios_enderecos',
											name: 'data_cadastro_date',
											margins: '0 5 0 0',											hideLabel: true
										},
										{
											xtype: 'textfield',
											mask: '99:99:99',
											plugins: 'textmask',
											returnWithMask: true,
											flex: 1,
											id: 'data_cadastro_time_correios_enderecos',
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
							id: 'id_correios_enderecos',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_correios_enderecos',
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
                            id: 'button_resetar_correios_enderecos',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_correios_enderecos',
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
