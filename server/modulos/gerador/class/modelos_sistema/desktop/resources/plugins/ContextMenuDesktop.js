Ext.define(NameApp + '.plugins.ContextMenuDesktop', {
	mixins : {
		observable : 'Ext.util.Observable'
	},
	windows : null,
	iconMenu : null,
	onWindowClose : function (win) {
		var me = this;
		me.windows.remove(win);
		me.taskbar.removeTaskButton(win.taskButton);
		me.updateActiveWindow();
	},
	onWindowMenuBeforeShow : function (menu) {
		var items = menu.items.items,
		win = menu.theWin;
		items[0].setDisabled(win.maximized !== true && win.hidden !== true);
		items[1].setDisabled(win.minimized === true);
		items[2].setDisabled(win.maximized === false || win.hidden === false);
		items[2].setDisabled(win.maximizable !== true);
	},
	onWindowMenuClose : function () {
		var me = this,
		win = me.windowMenu.theWin;
		win.close();
	},
	onWindowMenuHide : function (menu) {
		menu.theWin = null;
	},
	onWindowMenuMaximize : function () {
		var me = this,
		win = me.windowMenu.theWin;
		win.maximize();
		win.toFront();
	},
	onWindowMenuMinimize : function () {
		var me = this,
		win = me.windowMenu.theWin;
		win.minimize();
	},
	onWindowMenuRestore : function () {
		var me = this,
		win = me.windowMenu.theWin;
		me.restoreWindow(win);
	},
	restoreWindow : function (win) {
		if (win.isVisible()) {
			win.restore();
			win.toFront();
		} else {
			win.show();
		}
		return win;
	},
	createWindowMenu : function () {
		var me = this;
		return {
			defaultAlign : 'br-tr',
			items : [{
					text : 'Restaurar',
					handler : me.onWindowMenuRestore,
					scope : me
				}, {
					text : 'Minimizar',
					handler : me.onWindowMenuMinimize,
					scope : me
				}, {
					text : 'Maximizar',
					handler : me.onWindowMenuMaximize,
					scope : me
				}, '-', {
					text : 'Fechar',
					handler : me.onWindowMenuClose,
					scope : me
				}
			],
			listeners : {
				beforeshow : me.onWindowMenuBeforeShow,
				hide : me.onWindowMenuHide,
				scope : me
			}
		};
	},
	createIconMenu : function () {
		var me = this;
		return {
			defaultAlign : 'tl-c?',
			theWinId : null,
			items : [{
					text : 'Abrir',
					scope : me,
					handler : function () {
						me.getWindow(me.iconMenu.theWinId);
					}
				}
			]
		};
	},
	createDesktopMenu : function (comp) {
		var me = this,
		ret = {
			items : comp.contextMenuItems || [],
			app : this
		};
		if (ret.items.length) {
			ret.items.push('-');
		}
		ret.items.push({
			text : 'Organizar Icones',
			handler : me.updateIconDesktopSize,
			scope : me,
			minWindows : 0
		}, '-', {
			text : 'Topo',
			handler : me.tileWindows,
			scope : me,
			minWindows : 1
		}, {
			text : 'Cascata',
			handler : me.cascadeWindows,
			scope : me,
			minWindows : 1
		})
		return ret;
	},
	onDesktopMenuBeforeShow : function (menu) {
		var me = this.app,
		count = me.windows.getCount();
		menu.items.each(function (item) {
			var min = item.minWindows || 0;
			item.setDisabled(count < min);
		});
	},
	cascadeWindows : function () {
		var x = 0,
		y = 0,
		zmgr = this.getDesktopZIndexManager();
		zmgr.eachBottomUp(function (win) {
			if (win.isWindow && win.isVisible() && !win.maximized) {
				win.setPosition(x, y);
				x += 20;
				y += 20;
			}
		});
	},
	tileWindows : function () {
		var me = this,
		availWidth = me.body.getWidth(true);
		var x = me.xTickSize,
		y = me.yTickSize,
		nextY = y;
		me.windows.each(function (win) {
			if (win.isVisible() && !win.maximized) {
				var w = win.el.getWidth();
				if (x > me.xTickSize && x + w > availWidth) {
					x = me.xTickSize;
					y = nextY;
				}
				win.setPosition(x, y);
				x += w + me.xTickSize;
				nextY = Math.max(nextY, y + win.el.getHeight() + me.yTickSize);
			}
		});
	},
	snapFitVWindows : function () {
		var me = this,
		availWidth = me.body.getWidth(true),
		availHeight = (me.body.getHeight(true) - 35);
		var x = 0,
		y = 0;
		var snapCount = 0;
		me.windows.each(function (win) {
			if (win.isVisible()) {
				snapCount++;
			}
		});
		var snapSize = parseInt(availHeight / snapCount);
		if (snapSize > 0) {
			me.windows.each(function (win) {
				if (win.isVisible()) {
					win.setWidth(availWidth);
					win.setHeight(snapSize);
					win.setPosition(x, y);
					y += snapSize;
				}
			});
		}
	},
	snapFitWindows : function () {
		var me = this,
		availWidth = me.body.getWidth(true),
		availHeight = (me.body.getHeight(true) - 35);
		var x = 0,
		y = 0;
		var snapCount = 0;
		me.windows.each(function (win) {
			if (win.isVisible()) {
				snapCount++;
			}
		});
		var snapSize = parseInt(availWidth / snapCount);
		if (snapSize > 0) {
			me.windows.each(function (win) {
				if (win.isVisible()) {
					win.setWidth(snapSize);
					win.setHeight(availHeight);
					win.setPosition(x, y);
					x += snapSize;
				}
			});
		}
	},
	hideAllVWindows : function () {
		var me = this;
		me.windows.each(function (win) {
			if (win.isVisible()) {
				win.hide();
			}
		});
	},
	addOpacityAllWin : function () {
		var me = this;
		me.windows.each(function (win) {
			win.el.setOpacity(1, true);
		});
	},
	delOpacityAllWin : function () {
		var me = this;
		me.windows.each(function (win) {
			win.el.setOpacity(.1, true);
		});
	},
	constructor : function (config) {
		this.mixins.observable.constructor.call(this, config);
	}
});
