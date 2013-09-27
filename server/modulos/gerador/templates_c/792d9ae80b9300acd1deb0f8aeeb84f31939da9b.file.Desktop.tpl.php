<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/controller/Desktop.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210474309652457e13473df5-66093537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '792d9ae80b9300acd1deb0f8aeeb84f31939da9b' => 
    array (
      0 => 'class/smarty/templates/desktop/controller/Desktop.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210474309652457e13473df5-66093537',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e1352c0e5_01818087',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e1352c0e5_01818087')) {function content_52457e1352c0e5_01818087($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Desktop', {
    extend: 'Ext.app.Controller',
    mixins: {
        iconsDesk		: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.IconDesktop',
        winRegisterDesk : '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.winRegisterDesktop',
        winTaskBar		: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.TaskBar',
        contextMenuDesk : '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.ContextMenuDesktop'
    },

    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.IconDesktop',
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.ContextMenuDesktop',
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.TaskBar',
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.winRegisterDesktop'
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
<?php }} ?>