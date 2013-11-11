Ext.define('ShSolutions.view.Desktop', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.desktopwin',
    
    requires: [
        'ShSolutions.plugins.StartMenu',
        'ShSolutions.plugins.TrayClock'
    ],
    
    renderTo: Ext.getBody(),
    
    layout: {
        type: 'fit'
    },

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'panel',
                    id: 'panel-desktop',
                    layout: {
                        type: 'fit'
                    },
                    border: false,
                    xTickSize: 1,
                    yTickSize: 1,
                    dockedItems: [
                        {
                            xtype: 'toolbar',
                            id: 'toolbar-taskbar-desktop',
                            cls: 'ux-taskbar',
                            dock: 'bottom',
                            items: [
                                {
                                    xtype: 'button',
                                    cls: 'ux-start-button',
                                    id: 'start-menu-desktop',
									iconCls: 'ux-start-button-icon',
									menuAlign: 'bl-tl',
									menu: {
										xtype: 'startmenu',
										id: 'startmenu-desktop',
										title: 'Maciel',
										iconCls: 'usuario',
										height: 300
									},
                                    text: 'Menu Iniciar'
                                },
                                {
                                    xtype: 'toolbar',
                                    id: 'toolbar-quick-win',
                                    minWidth: 20,
                                    width: 60,
                                    enableOverflow: true
                                },
                                {
                                    xtype: 'splitter',
                                    cls: 'x-toolbar-separator x-toolbar-separator-horizontal',
                                    height: 14,
                                    width: 2,
                                    html: '&#160;'
                                },
                                {
                                    xtype: 'toolbar',
                                    cls: 'ux-desktop-windowbar',
                                    items: [ '&#160;' ],
                                    layout: { overflowHandler: 'Scroller' },
                                    id: 'toolbar-button-win',
                                    flex: 1
                                },
                                {
                                    xtype: 'tbseparator'
                                },
                                {
                                    xtype: 'toolbar',
                                    width: 80,
                                    items: [
                                        {
                                        	xtype: 'button',
                                        	tooltip: { 
                                        		text: 'Mostrar Area de trabalho', 
                                        		align: 'bl-tl' 
                                        	},
                                        	iconCls: 'view-desktop',
                                        	id: 'view-desktop'
                                        },
										{
											xtype: 'trayclock',
											flex: 1
										}
                                    ]
                                }
                            ]
                        }
                    ],
                    items: [
                        {
                            xtype: 'component',
                            cls: 'ux-wallpaper',
                            id: 'component-wallpaper',
                            stretch: false,
							wallpaper: null,
							stateful  : true,
							stateId  : 'desk-wallpaper',
                            html: '<img src="resources/wallpapers/Blue-Sencha.jpg">'
                        },
                        {
                            xtype: 'component',
                            id: 'icon-desktop-view',
                            style: {
                                position: 'absolute'
                            },
                            x: 0, 
                            y: 0
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});