{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.Principal', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerprincipal',

    config: {
		
		refs: {
			list: {
				selector: 'containerprincipal',
				xtype: 'containerprincipal',
				autoCreate: true
			}
		},
		
        views: [
            'Principal'
        ],
		
		control: {
        	'containerprincipal' : {
        		activeitemchange: 'active'
			}
        }
    },
{if $permissoes=='sim'}	
    
    getPermissoes: function(list, tabela){
    	var me = this;
		var data = {$app|capitalize}.app.dados[tabela];
    	var items = list.down('toolbar[docked=bottom]').items.items;
    	Ext.each(items, function(p){
			Ext.each(data, function(j){
				if(p.config.action && p.config.action==j.acao){
					p.setHidden(false);
				}
			});
		});
    },
    
{/if}	
	setPanelView: function(modulo, action){
		if(action=='list'){
			var controller = {$app|capitalize}.app.getController(modulo);
			controller.showList();
{if $permissoes=='sim'}				
			this.getPermissoes(controller.getList(), controller.tabela.toLowerCase());
{/if}			
		}
		else if(action=='logout'){
			window.location = "logout.php";
		}
	},
	
	x: 0,
    y: 40,
    btnPadding: 8,
    btnHeight: 78,
    btnWidth: 64,
    row: null,
    col: null,
	overflowW: false,
	countCarousel: 1,
	itemsCarousel: 0,
	
	onListed: [],
	Models: [],
	orientation: null,
	
	active: function(comp, nv, ov){
		var me = this;
		
		if(ov){
			me.ajusteIcons(nv);
		}
	},
	
	ajaxCarousel: function(){
		var me = this;
		me.orientation = Ext.Viewport.getOrientation();
		
		Ext.Ajax.request({
			url: 'server/modulos/menu.php',
			success: function(o){
				var o = Ext.decode(o.responseText);
				if(o.dados){
					me.Models = o.dados;
					me.initColRow(me);
					for(var i in o.dados){
						me.prepareXY(me);
					}
					me.initCarousel(o.dados);
					
					Ext.Viewport.on('orientationchange', function(com, ori){
						var olds = [];
						
						for(var i=1; i<=me.countCarousel;i++){
							if(Ext.getCmp('carousel_'+i+'_'+me.orientation)){
								var id = Ext.getCmp('carousel_'+i+'_'+me.orientation).innerElement.id;
								Ext.get(id).un('click');
								
								olds.push(Ext.getCmp('carousel_'+i+'_'+me.orientation));
								Ext.getCmp('carousel_'+i+'_'+me.orientation).setHtml('');
							}	
						}
						
						me.x = 0;
						me.y = 40;
						me.btnPadding = 8;
						me.btnHeight = 78;
						me.btnWidth = 64;
						me.overflowW = false;
						me.countCarousel = 1;
						me.itemsCarousel = 0;
						me.orientation = ori;
						me.initColRow(me);
							
						for(var i in me.Models){
							me.prepareXY(me);
						}
						me.initCarousel(me.Models);
						
						for(var i in olds){
							olds[i].destroy();
						}
						
						var els = Ext.getCmp('carousel_1_'+me.orientation).innerElement.dom.childNodes[0].childNodes;
						me.initColRow(me);
						for(var i in els){
							if(Ext.get(els[i].id)){
								me.setXY(Ext.get(els[i].id));
							}
						}
						
					});
					
				}
			}
		});
	},
	
	initCarousel: function(dados){
		var me = this;
		for(var i = 1; i<=me.countCarousel; i++){
			Ext.getCmp('Principal').add({
				xtype: 'container',
				id: 'carousel_'+i+'_'+me.orientation
			});
		}
		
		var p = 0;
		var items = "";
		var itemsId = [];
		var c = 1;
		for(var i in dados){
			var id = Ext.id()+'_'+me.orientation;
			var t = new Ext.Template([
				{$item_tpl}
			]);
			
			if(me.itemsCarousel==p){
				p = 0;
				Ext.getCmp('carousel_'+c+'_'+me.orientation).setHtml(items);
				c++;
				items = "";
				
				me.initColRow(me);
				
				items += t.apply(dados[i]);
				itemsId.push(id);
				p++;
			}
			else{
				items += t.apply(dados[i]);
				itemsId.push(id);
				p++;
			}
			
			if(i==dados.length-1){
				Ext.getCmp('carousel_'+c+'_'+me.orientation).setHtml(items);
			}
		}
		
		for(var i = 1; i<=me.countCarousel; i++){
			var id = Ext.getCmp('carousel_'+i+'_'+me.orientation).innerElement.id;
			Ext.get(id).on('click', function(s, p){
				var modulo = p.getAttribute('modulo');
				var action = p.getAttribute('action');
				if((modulo) && (action)){
					me.setPanelView(modulo, action);
				}
			});
		}
		
		
		
		me.ajusteIcons(Ext.getCmp('carousel_1_'+me.orientation));
		
	},
	
	ajusteIcons: function(comp){
		var me = this;
		var els = comp.innerElement.dom.childNodes[0]
		if(els){
			els = els.childNodes;
		}	
		me.initColRow(me);
		for(var i in els){
			if(Ext.get(els[i].id)){
				me.setXY(Ext.get(els[i].id));
			}
		}
	},
	
	initColRow: function(me){
   		me.col = { index: 1, x: me.btnPadding };
	    me.row = { index: 1, y: me.btnPadding + me.y };
	},
	
    getViewHeight: function(){
    	return (Ext.getBody().getHeight() - 10);
    },
	
    getViewWidth: function(){
    	return (Ext.getBody().getWidth() - 8);
    },
	
	isOverflowH: function(y){
		var me = this;
		if(y > (me.getViewHeight())){
			return true;
		}
		return false;
	},
	
	isOverflowW: function(x){
		var me = this;
		if(x > (me.getViewWidth())){
			return true;
		}
		return false;
	},
	
	prepareXY: function(me){
		var bottom = me.row.y + me.btnHeight;
		var overflowH = me.isOverflowH(me.row.y + me.btnHeight);
		if(overflowH && bottom > (me.btnHeight + me.btnPadding)){
			me.col = {
			    index: me.col.index++,
			    x: me.col.x + me.btnWidth + me.btnPadding
			};
			me.row = {
				index: 1,
				y: me.btnPadding + me.y
	        };
	    }
		
		me.row.index++;
		me.row.y = me.row.y + me.btnHeight + me.btnPadding;
		
		var overflowW = me.isOverflowW(me.col.x + me.btnWidth);
		if(overflowW){
			me.countCarousel++;
			me.overflowW = true;
			me.initColRow(me);
		}
		else{
			if(!me.overflowW){
				me.itemsCarousel++;
			}
		}
	},
	
	setXY: function(item){
		var me = this;
		var bottom = me.row.y + me.btnHeight;
		var overflow = me.isOverflowH(me.row.y + me.btnHeight);
		
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
		item.setXY([me.col.x, me.row.y]);
		me.row.index++;
		me.row.y = me.row.y + me.btnHeight + me.btnPadding;
	}
});