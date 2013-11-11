/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_bairros.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addcorreios_bairroswin',

    id: 'AddCorreios_BairrosWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
	
    title: 'Cadastro de Correios_Bairros',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormCorreios_Bairros',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/correios_bairros/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'uf_sigla',
							id: 'uf_sigla_correios_bairros',
							anchor: '100%',							
							fieldLabel: 'Uf Sigla'
						},
						{
							xtype: 'numberfield',
							name: 'localidade_id',
							id: 'localidade_id_correios_bairros',
							anchor: '100%',						
							fieldLabel: 'Localidade Id'
						},
						{
							xtype: 'textfield',
							name: 'bairro_nome',
							id: 'bairro_nome_correios_bairros',
							anchor: '100%',							
							fieldLabel: 'Bairro Nome'
						},
						{
							xtype: 'textfield',
							name: 'bairro_nome_abreviado',
							id: 'bairro_nome_abreviado_correios_bairros',
							anchor: '100%',							
							fieldLabel: 'Bairro Nome Abreviado'
						},
						{
							xtype: 'textfield',
							name: 'ativo',
							id: 'ativo_correios_bairros',
							anchor: '100%',							
							fieldLabel: 'Ativo'
						},
						{
							xtype: 'numberfield',
							name: 'cadastrado_por',
							id: 'cadastrado_por_correios_bairros',
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
		                            id: 'data_cadastro_date_correios_bairros',
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
		                            id: 'data_cadastro_time_correios_bairros',
		                            name: 'data_cadastro_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_correios_bairros',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_correios_bairros',
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
                            id: 'button_resetar_correios_bairros',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_correios_bairros',
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
