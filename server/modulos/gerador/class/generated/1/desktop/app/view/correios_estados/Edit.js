/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_estados.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addcorreios_estadoswin',

    id: 'AddCorreios_EstadosWin',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
	
    title: 'Cadastro de Correios_Estados',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormCorreios_Estados',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/correios_estados/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'uf',
							id: 'uf_correios_estados',
							anchor: '100%',							
							fieldLabel: 'Uf'
						},
						{
							xtype: 'textfield',
							name: 'descricao',
							id: 'descricao_correios_estados',
							anchor: '100%',							
							fieldLabel: 'Descricao'
						},
						{
							xtype: 'textfield',
							name: 'ativo',
							id: 'ativo_correios_estados',
							anchor: '100%',							
							fieldLabel: 'Ativo'
						},
						{
							xtype: 'numberfield',
							name: 'cadastrado_por',
							id: 'cadastrado_por_correios_estados',
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
		                            id: 'data_cadastro_date_correios_estados',
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
		                            id: 'data_cadastro_time_correios_estados',
		                            name: 'data_cadastro_time',									
		                            hideLabel: true
		                        }
		                    ]
		                },
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_correios_estados',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_correios_estados',
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
                            id: 'button_resetar_correios_estados',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_correios_estados',
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
