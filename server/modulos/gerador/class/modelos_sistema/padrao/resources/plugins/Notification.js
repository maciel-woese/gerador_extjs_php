Ext.define('Ext.plugins.Notification', {
	extend : 'Ext.window.Window',
	alias : 'widget.uxNotification',
	
	cls : 'ux-notification-window',
	autoHide : true,
	modal : false,
	autoHeight : true,
	plain : false,
	draggable : false,
	shadow : false,
	focus : Ext.emptyFn,
	manager : null,
	useXAxis : false,
	position : 'br',
	spacing : 6,
	paddingX : 30,
	paddingY : 10,
	slideInAnimation : 'easeIn',
	slideBackAnimation : 'bounceOut',
	slideInDuration : 800,
	slideBackDuration : 1000,
	hideDuration : 500,
	autoHideDelay : 7000,
	stickOnClick : true,
	stickWhileHover : true,
	isHiding : false,
	readyToHide : false,
	xPos : 0,
	yPos : 0,
	
	statics : {
		defaultManager : {
			el : null
		}
	},
	
	getXposAlignedToManager : function () {
		var me = this;
		var xPos = 0;
		if (me.manager && me.manager.el && me.manager.el.dom) {
			if (!me.useXAxis) {
				return me.el.getLeft();
			} else {
				if (me.position == 'br' || me.position == 'tr' || me.position == 'r') {
					xPos += me.manager.el.getAnchorXY('r')[0];
					xPos -= (me.el.getWidth() + me.paddingX);
				} else {
					xPos += me.manager.el.getAnchorXY('l')[0];
					xPos += me.paddingX;
				}
			}
		}
		
		return xPos;
	},
	
	getYposAlignedToManager : function () {
		var me = this;
		var yPos = 0;
		if (me.manager && me.manager.el && me.manager.el.dom) {
			if (me.useXAxis) {
				return me.el.getTop();
			} else {
				if (me.position == 'br' || me.position == 'bl' || me.position == 'b') {
					yPos += me.manager.el.getAnchorXY('b')[1];
					yPos -= (me.el.getHeight() + me.paddingY);
				} else {
					yPos += me.manager.el.getAnchorXY('t')[1];
					yPos += me.paddingY;
				}
			}
		}
		
		return yPos;
	},
	
	getXposAlignedToSibling : function (sibling) {
		var me = this;
		
		if (me.useXAxis) {
			if (me.position == 'tl' || me.position == 'bl' || me.position == 'l') {
				return (sibling.xPos + sibling.el.getWidth() + sibling.spacing);
			} else {
				return (sibling.xPos - me.el.getWidth() - me.spacing);
			}
		} else {
			return me.el.getLeft();
		}
		
	},
	
	getYposAlignedToSibling : function (sibling) {
		var me = this;
		
		if (me.useXAxis) {
			return me.el.getTop();
		} else {
			if (me.position == 'tr' || me.position == 'tl' || me.position == 't') {
				return (sibling.yPos + sibling.el.getHeight() + sibling.spacing);
			} else {
				return (sibling.yPos - me.el.getHeight() - sibling.spacing);
			}
		}
	},
	
	getNotifications : function (alignment) {
		var me = this;
		
		if (!me.manager.notifications[alignment]) {
			me.manager.notifications[alignment] = [];
		}
		
		return me.manager.notifications[alignment];
	},
	
	beforeShow : function () {
		var me = this;
		if (Ext.isDefined(me.corner)) {
			me.position = me.corner;
		}
		if (Ext.isDefined(me.slideDownAnimation)) {
			me.slideBackAnimation = me.slideDownAnimation;
		}
		if (Ext.isDefined(me.autoDestroyDelay)) {
			me.autoHideDelay = me.autoDestroyDelay;
		}
		if (Ext.isDefined(me.slideInDelay)) {
			me.slideInDuration = me.slideInDelay;
		}
		if (Ext.isDefined(me.slideDownDelay)) {
			me.slideBackDuration = me.slideDownDelay;
		}
		if (Ext.isDefined(me.fadeDelay)) {
			me.hideDuration = me.fadeDelay;
		}
		me.position = me.position.replace(/c/, '');
		
		switch (me.position) {
		case 'br':
			me.paddingFactorX = -1;
			me.paddingFactorY = -1;
			me.siblingAlignment = "br-br";
			if (me.useXAxis) {
				me.managerAlignment = "bl-br";
			} else {
				me.managerAlignment = "tr-br";
			}
			break;
		case 'bl':
			me.paddingFactorX = 1;
			me.paddingFactorY = -1;
			me.siblingAlignment = "bl-bl";
			if (me.useXAxis) {
				me.managerAlignment = "br-bl";
			} else {
				me.managerAlignment = "tl-bl";
			}
			break;
		case 'tr':
			me.paddingFactorX = -1;
			me.paddingFactorY = 1;
			me.siblingAlignment = "tr-tr";
			if (me.useXAxis) {
				me.managerAlignment = "tl-tr";
			} else {
				me.managerAlignment = "br-tr";
			}
			break;
		case 'tl':
			me.paddingFactorX = 1;
			me.paddingFactorY = 1;
			me.siblingAlignment = "tl-tl";
			if (me.useXAxis) {
				me.managerAlignment = "tr-tl";
			} else {
				me.managerAlignment = "bl-tl";
			}
			break;
		case 'b':
			me.paddingFactorX = 0;
			me.paddingFactorY = -1;
			me.siblingAlignment = "b-b";
			me.useXAxis = 0;
			me.managerAlignment = "t-b";
			break;
		case 't':
			me.paddingFactorX = 0;
			me.paddingFactorY = 1;
			me.siblingAlignment = "t-t";
			me.useXAxis = 0;
			me.managerAlignment = "b-t";
			break;
		case 'l':
			me.paddingFactorX = 1;
			me.paddingFactorY = 0;
			me.siblingAlignment = "l-l";
			me.useXAxis = 1;
			me.managerAlignment = "r-l";
			break;
		case 'r':
			me.paddingFactorX = -1;
			me.paddingFactorY = 0;
			me.siblingAlignment = "r-r";
			me.useXAxis = 1;
			me.managerAlignment = "l-r";
			break;
		}
		
		if (typeof me.manager == 'string') {
			me.manager = Ext.getCmp(me.manager);
		}
		if (!me.manager) {
			me.manager = me.statics().defaultManager;
			
			if (!me.manager.el) {
				me.manager.el = Ext.getBody();
			}
		}
		
		if (typeof me.manager.notifications == 'undefined') {
			me.manager.notifications = {};
		}
		
		if (me.stickOnClick) {
			if (me.body && me.body.dom) {
				Ext.fly(me.body.dom).on('click', function () {
					me.cancelAutoHide();
					me.addCls('notification-fixed');
				}, me);
			}
		}
		
		me.el.hover(
			function () {
			me.mouseIsOver = true;
		},
			function () {
			me.mouseIsOver = false;
		},
			me);
		
		if (me.autoHide) {
			me.task = new Ext.util.DelayedTask(me.doAutoHide, me);
			me.task.delay(me.autoHideDelay);
		}
		
		var notifications = me.getNotifications(me.managerAlignment);
		
		if (notifications.length) {
			me.el.alignTo(notifications[notifications.length - 1].el, me.siblingAlignment, [0, 0]);
			me.xPos = me.getXposAlignedToSibling(notifications[notifications.length - 1]);
			me.yPos = me.getYposAlignedToSibling(notifications[notifications.length - 1]);
		} else {
			me.el.alignTo(me.manager.el, me.managerAlignment, [(me.paddingX * me.paddingFactorX), (me.paddingY * me.paddingFactorY)]);
			me.xPos = me.getXposAlignedToManager();
			me.yPos = me.getYposAlignedToManager();
		}
		
		Ext.Array.include(notifications, me);
		
		me.stopAnimation();
		
		me.el.animate({
			to : {
				x : me.xPos,
				y : me.yPos,
				opacity : 1
			},
			easing : me.slideInAnimation,
			duration : me.slideInDuration,
			dynamic : true
		});
		
	},
	
	slideBack : function () {
		var me = this;
		
		var notifications = me.getNotifications(me.managerAlignment);
		var index = Ext.Array.indexOf(notifications, me)
			
			if (!me.isHiding && me.el && me.manager && me.manager.el && me.manager.el.dom && me.manager.el.isVisible()) {
				
				if (index) {
					me.xPos = me.getXposAlignedToSibling(notifications[index - 1]);
					me.yPos = me.getYposAlignedToSibling(notifications[index - 1]);
				} else {
					me.xPos = me.getXposAlignedToManager();
					me.yPos = me.getYposAlignedToManager();
				}
				
				me.stopAnimation();
				
				me.el.animate({
					to : {
						x : me.xPos,
						y : me.yPos
					},
					easing : me.slideBackAnimation,
					duration : me.slideBackDuration,
					dynamic : true
				});
			}
	},
	
	cancelAutoHide : function () {
		var me = this;
		
		if (me.autoHide) {
			me.task.cancel();
			me.autoHide = false;
		}
	},
	
	doAutoHide : function () {
		var me = this;
		me.el.hover(
			function () {},
			function () {
			me.hide();
		},
			me);
		
		if (!(me.stickWhileHover && me.mouseIsOver)) {
			me.hide();
		}
	},
	
	hide : function () {
		var me = this;
		if (!me.isHiding && me.el) {
			
			me.isHiding = true;
			
			me.cancelAutoHide();
			me.stopAnimation();
			
			me.el.animate({
				to : {
					opacity : 0
				},
				easing : 'easeIn',
				duration : me.hideDuration,
				dynamic : false,
				listeners : {
					afteranimate : function () {
						if (me.manager) {
							var notifications = me.getNotifications(me.managerAlignment);
							var index = Ext.Array.indexOf(notifications, me);
							if (index != -1) {
								Ext.Array.erase(notifications, index, 1);
								for (; index < notifications.length; index++) {
									notifications[index].slideBack();
								}
							}
						}
						
						me.readyToHide = true;
						me.hide();
					}
				}
			});
		}
		
		if (me.readyToHide) {
			me.isHiding = false;
			me.readyToHide = false;
			me.removeCls('notification-fixed');
			this.callParent(arguments);
		}
	}
	
});

function info(title, msg) {
	var msg2 = 'Erro Inesperado';
	
	var s = Ext.create('widget.uxNotification', {
			title : title || 'Aviso!',
			position : 'br',
			manager : 'demo1',
			iconCls : 'information',
			width : 350,
			autoHideDelay : 5000,
			bodyPadding : 10,
			html : msg || msg2
		}).show();
	
	s.getEl().setStyle('z-index', '80000');
	return s;
};
