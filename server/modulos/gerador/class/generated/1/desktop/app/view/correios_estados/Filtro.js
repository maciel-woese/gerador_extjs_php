/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_estados.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filtercorreios_estadoswin',

    id: 'FilterCorreios_EstadosWin',
    layout: {
        type: 'fit'
    },
	modal: true,
    minimizable: false,
    
    title: 'Filtro de Correios_Estados',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilterCorreios_Estados',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
						{
							xtype: 'textfield',
							name: 'uf',
							id: 'uf_filter_correios_estados',							
							anchor: '100%',
							fieldLabel: 'Uf'
						},
						{
							xtype: 'textfield',
							name: 'descricao',
							id: 'descricao_filter_correios_estados',							
							anchor: '100%',
							fieldLabel: 'Descricao'
						},
						{
							xtype: 'textfield',
							name: 'ativo',
							id: 'ativo_filter_correios_estados',							
							anchor: '100%',
							fieldLabel: 'Ativo'
						},
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: 'cadastrado_por',
							id: 'cadastrado_por_filter_correios_estados',
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
		                            id: 'data_cadastro_date_filter_correios_estados',
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
		                            id: 'data_cadastro_time_filter_correios_estados',
		                            name: 'data_cadastro_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_correios_estados',
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
