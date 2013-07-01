Ext.define('Ext.tab.TabCloseMenu', {
	alias : 'plugin.tabclosemenu',
	alternateClassName : 'Ext.ux.TabCloseMenu',
	mixins : {
		observable : 'Ext.util.Observable'
	},
	closeTabText : 'Fechar aba',
	showCloseOthers : true,
	closeOthersTabsText : 'Fechar outras abas',
	showCloseAll : true,
	closeAllTabsText : 'Fechar todas as abas',
	extraItemsHead : null,
	extraItemsTail : null,
	constructor : function (config) {
		this.addEvents('aftermenu', 'beforemenu');
		this.mixins.observable.constructor.call(this, config);
	},
	init : function (tabpanel) {
		this.tabPanel = tabpanel;
		this.tabBar = tabpanel.down("tabbar");
		this.mon(this.tabPanel, {
			scope : this,
			afterlayout : this.onAfterLayout,
			single : true
		});
	},
	onAfterLayout : function () {
		this.mon(this.tabBar.el, {
			scope : this,
			contextmenu : this.onContextMenu,
			delegate : 'div.x-tab'
		});
	},
	onBeforeDestroy : function () {
		Ext.destroy(this.menu);
		this.callParent(arguments);
	},
	onContextMenu : function (event, target) {
		var me = this,
		menu = me.createMenu(),
		disableAll = true,
		disableOthers = true,
		tab = me.tabBar.getChildByElement(target),
		index = me.tabBar.items.indexOf(tab);
		me.item = me.tabPanel.getComponent(index);
		menu.child('*[text="' + me.closeTabText + '"]').setDisabled(!me.item.closable);
		if (me.showCloseAll || me.showCloseOthers) {
			me.tabPanel.items.each(function (item) {
				if (item.closable) {
					disableAll = false;
					if (item != me.item) {
						disableOthers = false;
						return false;
					}
				}
				return true;
			});
			if (me.showCloseAll) {
				menu.child('*[text="' + me.closeAllTabsText + '"]').setDisabled(disableAll);
			}
			if (me.showCloseOthers) {
				menu.child('*[text="' + me.closeOthersTabsText + '"]').setDisabled(disableOthers);
			}
		}
		event.preventDefault();
		me.fireEvent('beforemenu', menu, me.item, me);
		menu.showAt(event.getXY());
	},
	createMenu : function () {
		var me = this;
		if (!me.menu) {
			var items = [{
					text : me.closeTabText,
					scope : me,
					iconCls : 'bt_cancel',
					handler : me.onClose
				}
			];
			if (me.showCloseAll || me.showCloseOthers) {
				items.push('-');
			}
			if (me.showCloseOthers) {
				items.push({
					text : me.closeOthersTabsText,
					scope : me,
					iconCls : 'bt_cancel',
					handler : me.onCloseOthers
				});
			}
			if (me.showCloseAll) {
				items.push({
					text : me.closeAllTabsText,
					scope : me,
					iconCls : 'bt_cancel',
					handler : me.onCloseAll
				});
			}
			if (me.extraItemsHead) {
				items = me.extraItemsHead.concat(items);
			}
			if (me.extraItemsTail) {
				items = items.concat(me.extraItemsTail);
			}
			me.menu = Ext.create('Ext.menu.Menu', {
					items : items,
					listeners : {
						hide : me.onHideMenu,
						scope : me
					}
				});
		}
		return me.menu;
	},
	onHideMenu : function () {
		var me = this;
		me.item = null;
		me.fireEvent('aftermenu', me.menu, me);
	},
	onClose : function () {
		this.tabPanel.remove(this.item);
	},
	onCloseOthers : function () {
		this.doClose(true);
	},
	onCloseAll : function () {
		this.doClose(false);
	},
	doClose : function (excludeActive) {
		var items = [];
		this.tabPanel.items.each(function (item) {
			if (item.closable) {
				if (!excludeActive || item != this.item) {
					items.push(item);
				}
			}
		}, this);
		Ext.each(items, function (item) {
			this.tabPanel.remove(item);
		}, this);
	}
});
