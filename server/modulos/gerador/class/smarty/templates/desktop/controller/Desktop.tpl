{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.Desktop', {
    extend: 'Ext.app.Controller',
    mixins: {
        iconsDesk		: '{$app|capitalize}.plugins.IconDesktop',
        winRegisterDesk : '{$app|capitalize}.plugins.winRegisterDesktop',
        winTaskBar		: '{$app|capitalize}.plugins.TaskBar',
        contextMenuDesk : '{$app|capitalize}.plugins.ContextMenuDesktop'
    },

    requires: [
        '{$app|capitalize}.plugins.IconDesktop',
        '{$app|capitalize}.plugins.ContextMenuDesktop',
        '{$app|capitalize}.plugins.TaskBar',
        '{$app|capitalize}.plugins.winRegisterDesktop'
	],

	views: [
        'Desktop'
    ],
    body: null,
    ContainerDesktop: null,

    menuStart: [],

    init: function(application) {
        var me = this;
    	me.control({
    		'desktopwin': {
                afterrender: me.renderDesktop
            },
            'desktopwin button[id=view-desktop]': {
                click: me.hideAllVWindows,
                mouseover: me.delOpacityAllWin,
                mouseout: me.addOpacityAllWin,
            }
        });
    	window.control = me;
    },


    ajaxDesktopIcons: function(){
    	var me = this;
		
    	Ext.Ajax.request({
    		url: 'server/modulos/menu.php',
    		method: 'GET',
    		params: {
    			action: 'LIST_ALL_PREFERENCES'
    		},
    		success: function(o){
    			var d = Ext.decode(o.responseText);
    			if(d.success==true){
    				if(d.icon_desktop.length>0){
    					for(var i=0;i<d.icon_desktop.length;i++){
    						me.addIconDesktop({
        						id: d.icon_desktop[i].id,
        						name: d.icon_desktop[i].descricao,
        						iconCls: d.icon_desktop[i].iconCls+'-shortcut',
        						tooltip: d.icon_desktop[i].descricao,
        			      		Controller: d.icon_desktop[i].controller,
        			      		className:  d.icon_desktop[i].className
        					});
    					}
    				}
					
    				if(d.menu_start.length>0){
						for(var i=0;i<d.menu_start.length;i++){
							Ext.getCmp('startmenu-desktop').addMenuItem({
								xtype: 'menuitem',
								text: d.menu_start[i].descricao,
								iconCls: d.menu_start[i].iconCls,
								
								model_id: d.menu_start[i].id,
								model_ctl: d.menu_start[i].controller,
								model_cls: d.menu_start[i].className,
								model_me: me,
								handler: function(){
									this.model_me.getWindow(this.model_id, this.model_ctl, this.model_cls);
								}
							});
						}	
    				}
			
    			}
    		}
    	});
    },
    
    initDesktopMenu: function(comp){
    	var me = this;
    	me.contextMenu = new Ext.menu.Menu(me.createDesktopMenu(comp));
    	comp.el.on('contextmenu', function(event){
    		if(!me.contextMenu.rendered){
    			me.contextMenu.on('beforeshow', me.onDesktopMenuBeforeShow);
    		}
    		event.preventDefault();
    		me.contextMenu.showAt(event.getXY());
    		me.contextMenu.doConstrain();
    	});
    },
	
	hideMask: function(){
		Ext.get('loading').hide();
		Ext.get('loading-mask').setOpacity(0, true);
		setTimeout(function(){
			Ext.get('loading-mask').hide();
		},800);
	},
	
    renderDesktop: function(comp, objs){
    	var me = this;
		
		me.hideMask();
		
    	me.body = Ext.getBody();
    	me.ContainerDesktop = comp;
    	me.windows = new Ext.util.MixedCollection();
    	me.windowBar = Ext.getCmp('toolbar-button-win');
    	me.winquickBar = Ext.getCmp('toolbar-quick-win');
    	me.startMenu = Ext.getCmp('startmenu-desktop');
    	me.windowMenu = new Ext.menu.Menu(me.createWindowMenu());
    	me.iconMenu = new Ext.menu.Menu(me.createIconMenu());

    	me.initColRow();
    	me.initDesktopMenu(comp);
    	me.ajaxDesktopIcons();
    	me.afterLayout();
    	
    	Ext.EventManager.onWindowResize(me.updateIconDesktopSize, this, {
			delay:500
		});
    }

});
