Ext.define(NameApp+'.plugins.TaskBar', {
	mixins: {
        observable: 'Ext.util.Observable'
    },
   
    windowBar: null,
    winquickBar: null,
    windowMenu: null,
    
    setActiveButton: function(btn) {
        if (btn) {
            btn.toggle(true);
        } else {
            this.windowBar.items.each(function (item) {
                if (item.isButton) {
                    item.toggle(false);
                }
            });
        }
    },
    
    removeTaskButton: function (btn) {
        var found, me = this;
        me.windowBar.items.each(function (item) {
            if (item === btn) {
                found = item;
            }
            return !found;
        });
        if (found) {
            me.windowBar.remove(found);
        }
        return found;
    },
    
    onWindowBtnClick: function (btn) {
        var win = btn.win;

        if (win.minimized || win.hidden) {
            win.show();
        } else if (win.active) {
            win.minimize();
        } else {
            win.toFront();
        }
    },
    
    addTaskButton: function(win) {
        var config = {
            iconCls: win.iconCls,
            enableToggle: true,
            toggleGroup: 'all',
            width: 140,
            margins: '0 2 0 3',
            text: Ext.util.Format.ellipsis(win.title, 20),
            listeners: {
                click: this.onWindowBtnClick,
                scope: this
            },
            win: win
        };

        var cmp = this.windowBar.add(config);
        cmp.toggle(true);
        return cmp;
    },
    
    onQuickStartClick: function (btn) {
    	this.getWindow(btn.module, btn.Controller, btn.className);
    },
    
    addQuickButton: function(item){
    	var me = this;
    	this.winquickBar.add({
            tooltip: { text: item.title, align: 'bl-tl' },
            overflowText: item.title,
            iconCls: item.iconCls,
            module: item.id,
            Controller: item.Controller,
      		className:  item.className,
            handler: me.onQuickStartClick,
            scope: me
        });
    	
    },
    
    getWindowBtnFromEl: function (el) {
        var c = this.windowBar.getChildByElement(el);
        return c || null;
    },
    
    onButtonContextMenu: function (e) {
        var me = this, t = e.getTarget(), btn = me.getWindowBtnFromEl(t);
        if (btn) {
            e.stopEvent();
            me.windowMenu.theWin = btn.win;
            me.windowMenu.showBy(t);
        }
    },
    
    afterLayout: function () {
        var me = this;
        me.windowBar.el.on('contextmenu', me.onButtonContextMenu, me);
    },
    
    constructor: function (config) {
        this.mixins.observable.constructor.call(this, config);
    }
   	
});