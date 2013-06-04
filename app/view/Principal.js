Ext.define('ShSolutions.view.Principal', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.containerprincipal',
        
    renderTo: Ext.getBody(),
    
    layout: {
        type: 'border'
    },

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'tabpanel',
                    activeTab: 0,
                    plugins: [
                       {
                    	   ptype: 'tabclosemenu'
                       }
                    ],
                    id: 'PanelCentral',
                    margins: '5 5 5 0',
                    region: 'center'
                },
                {
                    xtype: 'panel',
                    width: 200,
					layout: {
                        type: 'fit'
                    },
                    bodyBorder: true,
                    collapsible: true,
                    margins: '5 0 5 5',
                    split: true,
                    title: 'M&oacute;dulos',
                    region: 'west',
                    items: [
                        {
                            xtype: 'treepanel',
                            store: 'TreeStoreMenu',
                            rootVisible: false,
                            bodyBorder: false,
							border: false,
							padding: '5 2 2 2',
							id: 'TreeModulosMenu',
                            useArrows: true,
                            viewConfig: {

                            }
                        }
                    ]
                },
                {
                    xtype: 'toolbar',
                    height: 45,
                    id: 'toolbar_container',
                    region: 'north',
                    items: [
                        {
                        	xtype: 'displayfield',
                        	margins: '-8 0 8 4',
                        	value: '<h1 style="font-size: 16px!important">'+TITULO_SYSTEM+'</h1>'
                        },
						{
							xtype: 'combobox',
							store: 'StoreComboFilial',
							name: 'filial_id',
							labelAlign: 'left',
							labelWidth: 35,
							margin: '0 0 0 20',
							id: 'filial_id_principal',
							width: 250,
							typeAhead : false,
							editable: false,
							readOnly: true,
							hidden: true,
							fieldLabel: 'Filial'
						},
				        {
				            xtype: 'tbfill'
				        },
				        {
				            xtype: 'button',
				            iconCls: 'pass',
							action: 'altera_senha',
				            text: '<b>Alterar Senha</b>'
				        },
				        {
				            xtype: 'button',
				            iconCls: 'logout',
				            text: '<b>Sair</b>',
				            handler: function(){
				            	Ext.Msg.confirm('Confirmar', 'Deseja Sair do Sistema?', function(btn){
				    				if(btn=='yes'){
				    					window.location = 'logout.php';
				    				}
				    			});
				            }
				        }
                    ]
                },
				{
                    xtype: 'toolbar',
                    id: 'toolbar_container_bottom',
					margins: '0 5 5 5',
                    height: 25,
					region: 'south',
					layout: {
						type: 'hbox'
					},
                    items: [
						{
							xtype: 'displayfield',
							flex: 1,
							value: ''
						},
						{
							xtype: 'displayfield',
							flex: 1,
							value: '<div style="text-align: center;">By Powered <b>Maciel Sousa</b></div>'
						},
						{
							xtype: 'displayfield',
							flex: 1,
							value: ''
						}
					]
				}
            ]
        });

        me.callParent(arguments);
    }

});
