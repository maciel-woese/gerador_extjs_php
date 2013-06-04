Ext.define(NameApp+'.plugins.IconDesktop', {
	mixins: {
        observable: 'Ext.util.Observable'
    },
    
    x: 0,
    y: 0,
    btnPadding: 8,
    btnHeight: 78,
    btnWidth: 64,
    row: null,
    col: null,
    
    tplIconMenuDeskotp: new Ext.Template([
        '<div class="ux-desktop-shortcut" id="{id}-shortcut" className="{className}" Controller="{Controller}">',
			'<div class="ux-desktop-shortcut-icon {iconCls}">',
	    		'<img src="',Ext.BLANK_IMAGE_URL,'" title="{name}">',
	    	'</div>',
			'<span class="ux-desktop-shortcut-text">{name}</span>',
		'</div>'
    ]),
    
    initColRow: function(){
    	var me = this;
   		me.col = {index: 1, x: me.btnPadding};
	    me.row = {index: 1, y: me.btnPadding + me.y};
	},
	
	isOverflow: function(y){
		var me = this;
		if(y > (me.getViewHeight())){
			return true;
		}
		return false;
	},
	
	setXY: function(item, me, init){
		var bottom = me.row.y + me.btnHeight;
		var overflow = me.isOverflow(me.row.y + me.btnHeight);

		if(overflow && bottom > (me.btnHeight + me.btnPadding)){
			me.col = {
			    index: me.col.index++,
			    x: me.col.x + me.btnWidth + me.btnPadding
			};
			me.row = {
				index: 1,
				y: me.btnPadding + me.y
	        };
	    }

		if(init){
			if(init=='left'){var from = {x: -200,y: 100};}
			else if(init=='right'){var from = {x: 2000,y: 100};}
			else if(init=='bottom'){var from = {x: 1000,y: 2000};}
			else if(init=='top'){var from = {x: 1000,y: -200};}
			else {var from = {x: 0,y: 0};}
			
			item.animate({
				duration: 2000,
				from: from,
			    to: {
			        x: me.col.x,
			        y: me.row.y
			    }
			});
		}
		else{
			item.animate({
				duration: 1000,
			    to: {
			        opacity: 60,
			        x: me.col.x,
			        y: me.row.y
			    }
			});
		}

		me.row.index++;
		me.row.y = me.row.y + me.btnHeight + me.btnPadding;
	},
	
    updateIconDesktopSize: function(){
    	var me = this
    	me.x = 0;
    	me.y = 0;
    	me.initColRow();
    	
    	Ext.each(Ext.getCmp('icon-desktop-view').el.dom.childNodes, function(div){
    		me.setXY(Ext.get(div.id), me);
    	});
    },
    
    addIconDesktop: function(config){
    	var me = this;
    	var t = me.tplIconMenuDeskotp;
      	t.compile();
      	t.append(Ext.getCmp('icon-desktop-view').el, {
      		id: config.id, 
      		name: config.name, 
      		iconCls: config.iconCls,
      		Controller: config.Controller,
      		className: config.className
      	});
      	
      	me.setXY(Ext.get(config.id+'-shortcut'), me, 'right');
      	
 		Ext.create('Ext.tip.ToolTip', {
    	    target: config.id+'-shortcut',
    	    html: config.tooltip
    	});
 		
      	Ext.get(config.id+'-shortcut').on('dblclick', function(){
      		me.getWindow(config.id, config.Controller, config.className);
      	});
      	 	
      	new Ext.dd.DD(Ext.get(config.id+'-shortcut'), 'icon-dektop-move');
    },
    
    getViewHeight: function(){
    	return (Ext.getBody().getHeight() - 35);
    },
	
   	constructor: function (config) {
        this.mixins.observable.constructor.call(this, config);
    }
   	
});

