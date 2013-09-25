Ext.define(NameApp + '.plugins.winRegisterDesktop', {
	mixins : {
		observable : 'Ext.util.Observable'
	},
	activeWindowCls : 'ux-desktop-active-win',
	inactiveWindowCls : 'ux-desktop-inactive-win',
	lastActiveWindow : null,
	windows : null,
	xTickSize : 1,
	yTickSize : 1,
	winBarId : 'toolbar-button-win',
	registerWin : function (win, config) {
		var me = this;
		if (!win) {
			return false;
		}
		if (me.isRegistered(win.id)) {
			return win;
		}
		if (config && Ext.getCmp(win.id)) {
			Ext.getCmp(win.id).close();
		}
		if (!Ext.getCmp(win.id)) {
			if (config) {
				var win = Ext.create(win.$className, config);
			} else {
				var win = Ext.create(win.$className);
			}
		}
		me.windows.add(win);
		win.taskButton = me.addTaskButton(win);
		win.animateTarget = win.taskButton.el;
		win.on({
			activate : me.updateActiveWindow,
			beforeshow : me.updateActiveWindow,
			deactivate : me.updateActiveWindow,
			minimize : me.minimizeWindow,
			destroy : me.onWindowClose,
			scope : me
		});
		return win;
	},
	unregisterWin : function (win) {
		var me = this;
		if (me.isRegistered(win.id)) {
			me.windows.remove(me.windows.get(win.id));
		}
		return true;
	},
	isRegistered : function (id) {
		var win = this.windows.get(id);
		if (!win) {
			return false;
		}
		return true;
	},
	getModule : function (id) {
		return this.windows.get(id);
	},
	getDesktopZIndexManager : function () {
		var windows = this.windows;
		return (windows.getCount() && windows.getAt(0).zIndexManager) || null;
	},
	getActiveWindow : function () {
		var win = null,
		zmgr = this.getDesktopZIndexManager();
		if (zmgr) {
			zmgr.eachTopDown(function (comp) {
				if (comp.isWindow && !comp.hidden) {
					win = comp;
					return false;
				}
				return true;
			});
		}
		return win;
	},
	updateActiveWindow : function () {
		var me = this,
		activeWindow = me.getActiveWindow(),
		last = me.lastActiveWindow;
		if (activeWindow === last) {
			return;
		}
		if (last) {
			if (last.el.dom) {
				last.addCls(me.inactiveWindowCls);
				last.removeCls(me.activeWindowCls);
			}
			last.active = false;
		}
		me.lastActiveWindow = activeWindow;
		if (activeWindow) {
			activeWindow.addCls(me.activeWindowCls);
			activeWindow.removeCls(me.inactiveWindowCls);
			activeWindow.minimized = false;
			activeWindow.active = true;
		}
		me.setActiveButton(activeWindow && activeWindow.taskButton);
	},
	minimizeWindow : function (win) {
		win.minimized = true;
		win.hide();
	},
	onWindowClose : function (win) {
		var me = this;
		me.windows.remove(win);
		me.removeTaskButton(win.taskButton);
		me.updateActiveWindow();
	},
	alterPermissao : function (controller, remove) {
		Ext.each(remove, function (r) {
			if (r.action == 'REMOVE_BUTTON') {
				Ext.getCmp(r.id).destroy(true);
			} else if (r.action == 'DISABLED_GRID_DBLCLICK') {}
			
		});
	},
	getPermissao : function (controller, callbackSuccess, callbackFailure) {
		callbackSuccess();
		return true;
	},
	getWindow : function (id, Controller, className, callback) {
		console.info(id);
		console.info(Controller);
		console.info(className);
		console.info(callback);
		var me = this;
		var win = me.getModule(id);
		var modulo = info('Aguarde...', 'Inicializando Modulo');
		if (!win) {
			var id = me.application.winRegistered.get(id);
			if (!id && Controller && className) {
				var control = me.application.getController(Controller);
				if (control.started == false) {
					control.init(me.application);
					control.started = true;
				} else {}
				window.con = control;
				var win = control.getView(className).create();
				if (win.isWindow) {
					var id = me.application.winRegistered.add(win);
					var win = me.registerWin(id);
					modulo.update('Modulo carregado!');
					win.show();
					modulo.hide();
					if (callback) {
						callback();
					}
				} else {
					console.info('Não é uma Window!');
				}
			} else if (id) {
				var win = me.registerWin(id);
				modulo.update('Modulo carregado!');
				win.show();
				modulo.hide();
				if (callback) {
					callback();
				}
			} else {
				console.info(id);
				console.info(Controller);
				console.info(className);
				modulo.update('Erro ao criar modulo!');
				modulo.hide();
			}
		} else {
			console.info('getModule Return true');
		}
	},
	constructor : function (config) {
		this.mixins.observable.constructor.call(this, config);
	}
});
