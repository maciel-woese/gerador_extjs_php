/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_bairros.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filtercorreios_bairroswin',

    id: 'FilterCorreios_BairrosWin',
    layout: {
        type: 'fit'
    },
	modal: true,
    minimizable: false,
    
    title: 'Filtro de Correios_Bairros',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterCorreios_Bairros',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'uf_sigla',
							id: 'uf_sigla_filter_correios_bairros',							
							anchor: '100%',
							fieldLabel: 'Uf Sigla'
						},
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'localidade_id',
							id: 'localidade_id_filter_correios_bairros',
							anchor: '100%',
							fieldLabel: 'Localidade Id'
						},
						{
							xtype: 'textfield',
							name: 'bairro_nome',
							id: 'bairro_nome_filter_correios_bairros',							
							anchor: '100%',
							fieldLabel: 'Bairro Nome'
						},
						{
							xtype: 'textfield',
							name: 'bairro_nome_abreviado',
							id: 'bairro_nome_abreviado_filter_correios_bairros',							
							anchor: '100%',
							fieldLabel: 'Bairro Nome Abreviado'
						},
						{
							xtype: 'textfield',
							name: 'ativo',
							id: 'ativo_filter_correios_bairros',							
							anchor: '100%',
							fieldLabel: 'Ativo'
						},
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'cadastrado_por',
							id: 'cadastrado_por_filter_correios_bairros',
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
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: 'Data Cadastro',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: 'data_cadastro_date_filter_correios_bairros',
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
		                            id: 'data_cadastro_time_filter_correios_bairros',
		                            name: 'data_cadastro_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_correios_bairros',
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
