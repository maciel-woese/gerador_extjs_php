<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/view/Desktop.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24399016452457e135359c9-03513531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'afb88e687f4971c32c2f90a5d946a5d29b40d432' => 
    array (
      0 => 'class/smarty/templates/desktop/view/Desktop.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24399016452457e135359c9-03513531',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'tree_start_menu' => 0,
    'view_desktop' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e135a6fa5_94162958',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e135a6fa5_94162958')) {function content_52457e135a6fa5_94162958($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>
Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.Desktop', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.desktopwin',
    
    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.StartMenu',
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.plugins.TrayClock'
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
                                    text: '<?php echo $_smarty_tpl->tpl_vars['tree_start_menu']->value;?>
'
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
                                        		text: '<?php echo $_smarty_tpl->tpl_vars['view_desktop']->value;?>
', 
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

});<?php }} ?>