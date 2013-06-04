/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.estados.Edit', {
    extend: 'Ext.window.Window',
	alias: 'widget.addestadoswin',

    id: 'AddEstadosWin',
    layout: {
        type: 'fit'
    },
    title: 'Cadastro de Estados',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'FormEstados',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/estados/save.php',
                    items: [
						{
							xtype: 'textfield',
							name: 'sigla',
							id: 'sigla_estados',
							anchor: '100%',							enableKeyEvents: true,
							listeners: {
								blur: function(obj, event){
									var v = obj.getValue();
									Ext.Ajax.request({
										url: 'server/modulos/estados/list.php',
										method: 'POST',
										params:{
											action: 'VALID_UNIQUE',
											param: 'sigla',
											valor: this.getValue()
										},
										success: function(s, o){
											var dados = Ext.decode(s.responseText);
											if(dados.success==false){
												Ext.getCmp('sigla_estados').markInvalid('Sigla Ja Existe...');
											}
										}
									});
								}
							},							
							fieldLabel: 'Sigla'
						},
						{
							xtype: 'textfield',
							name: 'descricao',
							id: 'descricao_estados',
							anchor: '100%',							
							fieldLabel: 'Descrição'
						},
						{
							xtype: 'hidden',
							name: 'id',
							hidden: true,
							id: 'id_estados',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_estados',
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
                            id: 'button_resetar_estados',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: 'Resetar'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_estados',
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
