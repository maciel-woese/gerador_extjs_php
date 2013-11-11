<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/view/Login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:72421181952457e13af29c1-78711549%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bee0b64897ddf19ab117b3e7174a3b5f7c9b90b' => 
    array (
      0 => 'class/smarty/templates/desktop/view/Login.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72421181952457e13af29c1-78711549',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'title_login' => 0,
    'login_login' => 0,
    'password_login' => 0,
    'reset_form' => 0,
    'button_connect' => 0,
    'aguarde' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13b7ed45_93133587',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13b7ed45_93133587')) {function content_52457e13b7ed45_93133587($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.Login', {
    extend: 'Ext.window.Window',
    alias: 'widget.addloginwin',

    modal: true,
    draggable: false,
    closable: false,
    resizable: false,
    id: 'AddLoginWin',
    width: 350,
	height: 250,
    layout: {
        type: 'border'
    },
    title: '<?php echo $_smarty_tpl->tpl_vars['title_login']->value;?>
',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
				{
                    xtype: 'panel',
                    border: false,
                    id: 'panel_img',
                    region: 'north',
                    html: '<div style="text-align:center;padding:3px"><img src="resources/images/logoLogin.png"/></div>',
                    height: 95
                },
                {
                    xtype: 'form',
                    border: false,
                    autoScroll: true,
                    region: 'center',
                    id: 'FormLogin',
                    bodyPadding: 10,
                    method: 'POST',
                    url: 'server/modulos/login.php',
                    items: [
                        {
                            xtype: 'textfield',
                            id: 'LoginLogin',
                            name: 'login',
                            fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['login_login']->value;?>
',
                            allowBlank: false,
                            labelWidth: 60,
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            id: 'SenhaLogin',
                            inputType: 'password',
                            name: 'senha',
                            fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['password_login']->value;?>
',
                            labelWidth: 60,
                            allowBlank: false,
                            anchor: '100%'
                        },
                        {
							xtype: 'hiddenfield',
							hidden: true,
							name: 'action',
							id: 'action_login',
							value: 'LOGIN'
                        } 
                    ]
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    items: [
                        {
                        	xtype: 'tbfill'
                        },
						{
						    xtype: 'button',
						    iconCls: 'bt_cancel',
						    text: '<?php echo $_smarty_tpl->tpl_vars['reset_form']->value;?>
',
						    handler: function(){
						    	Ext.getCmp('FormLogin').getForm().reset();
						    }
						},
						{
							xtype: 'tbseparator'
						},
                        {
                            xtype: 'button',
                            iconCls: 'bt_login',
                            text: '<?php echo $_smarty_tpl->tpl_vars['button_connect']->value;?>
',
                            listeners: {
                                click: {
                                    fn: me.LoginSys,
                                    scope: me
                                }
                            }
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    },

    LoginSys: function(button, e, options) {
    	if(!Ext.getCmp('FormLogin').getForm().isValid()){
    		return true;
    	}
    	button.setDisabled(true);
    	Ext.getCmp('FormLogin').getEl().mask('<?php echo $_smarty_tpl->tpl_vars['aguarde']->value;?>
');
        Ext.getCmp('FormLogin').getForm().submit({
            success: function(f, o){
                if(o.result.success===true){
                    window.location = 'index.php';
                }
                else{
                    Ext.Msg.alert('<?php echo $_smarty_tpl->tpl_vars['error']->value;?>
', o.result.msg);
                    button.setDisabled(false);
                    Ext.getCmp('FormLogin').getEl().unmask();
                }
            },
            failure: function(f, o){
				console.info(o);
                Ext.Msg.alert('<?php echo $_smarty_tpl->tpl_vars['error']->value;?>
', o.result.msg);
                button.setDisabled(false);
                Ext.getCmp('FormLogin').getEl().unmask();
            }
        });
    }

});
<?php }} ?>