<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/view/Principal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80849772551d18a17f228f1-89287542%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '759ee241c116ad7df4befc84cd5c9124b16a6092' => 
    array (
      0 => 'class/smarty/templates/padrao/view/Principal.tpl',
      1 => 1352468817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80849772551d18a17f228f1-89287542',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'title_menu' => 0,
    'sair' => 0,
    'confirm' => 0,
    'sair_sistema' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a18005c72_73868804',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a18005c72_73868804')) {function content_51d18a18005c72_73868804($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.Principal', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.containerprincipal',
        
    renderTo: Ext.getBody(),
    
    layout: {
        type: 'border'
    },

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'tabpanel',
                    activeTab: 0,
                    plugins: [
                       {
                    	   ptype: 'tabclosemenu'
                       }
                    ],
                    id: 'PanelCentral',
                    margins: '5 5 5 0',
                    region: 'center'
                },
                {
                    xtype: 'panel',
                    width: 200,
					layout: {
                        type: 'fit'
                    },
                    bodyBorder: true,
                    collapsible: true,
                    margins: '5 0 5 5',
                    split: true,
                    title: '<?php echo $_smarty_tpl->tpl_vars['title_menu']->value;?>
',
                    region: 'west',
                    items: [
                        {
                            xtype: 'treepanel',
                            store: 'TreeStoreMenu',
                            rootVisible: false,
                            bodyBorder: false,
							border: false,
							padding: '5 2 2 2',
							id: 'TreeModulosMenu',
                            useArrows: true,
                            viewConfig: {

                            }
                        }
                    ]
                },
                {
                    xtype: 'toolbar',
                    height: 45,
                    id: 'toolbar_container',
                    region: 'north',
                    items: [
                        {
                        	xtype: 'displayfield',
                        	margins: '-8 0 8 4',
                        	value: '<h1 style="font-size: 16px!important">'+TITULO_SYSTEM+'</h1>'
                        },
				        {
				            xtype: 'tbfill'
				        },
				        {
				            xtype: 'button',
				            iconCls: 'logout',
				            text: '<b><?php echo $_smarty_tpl->tpl_vars['sair']->value;?>
</b>',
				            handler: function(){
				            	Ext.Msg.confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['sair_sistema']->value;?>
', function(btn){
				    				if(btn=='yes'){
				    					window.location = 'logout.php';
				    				}
				    			});
				            }
				        }
                    ]
                },
				{
                    xtype: 'toolbar',
                    id: 'toolbar_container_bottom',
					margins: '0 5 5 5',
                    height: 25,
					region: 'south',
					layout: {
						type: 'hbox'
					},
                    items: [
						{
							xtype: 'displayfield',
							flex: 1,
							value: ''
						},
						{
							xtype: 'displayfield',
							flex: 1,
							value: '<div style="text-align: center;">By Powered <b>Maciel Sousa</b></div>'
						},
						{
							xtype: 'displayfield',
							flex: 1,
							value: ''
						}
					]
				}
            ]
        });

        me.callParent(arguments);
    }

});
<?php }} ?>