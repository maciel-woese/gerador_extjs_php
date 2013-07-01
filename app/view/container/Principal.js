Ext.define('ShSolutions.view.container.Principal', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.view_principal',

    layout: {
        type: 'border'
    },
	
	button_gerador: 'Gerador <b>Ctrl+R</b>',
	button_config: 'Configura&ccedil;&otilde;es <b>Shift+O</b>',
	button_info: 'Informa&ccedil;&otilde;es <b>Shift+B</b>',
	button_version: 'Adiquirir Vers&atilde;o Principal <b>Shift+V</b>',
	button_info_bugs: 'Informar Bugs <b>Ctrl+B</b>',
	button_api: 'Baixar API <b>Shift+L</b>',
	button_logout: 'Sair <b>F4</b>',
	
	item_init_app: 'Iniciar App <b>Ctrl+I</b>',
	item_app_gerada: 'Apps Geradas <b>Ctrl+G</b>',
	item_usuarios: 'Usu&aacute;rios <b>Shift+U</b>',
	item_sobre: 'Sobre <b>Shift+X</b>',
	
	infoAlert: {
		desenvolvido_por: 'Desenvolvidor Por: ',
		desenvolvedor: 'Desenvolvedor: ',
		email: 'E-Mail',
		telefone: 'Telefone'
	},
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'toolbar',
                    margins: '5 5 0 5',
                    region: 'north',
                    height: 43,
                    items: [
                        {
                            xtype: 'image',
                            height: 30,
							src: 'resources/images/logo01.png',
                            width: 76
                        },
						{
							xtype: 'tbfill'
						},
						{
							xtype: 'button',
							iconCls: 'grid',
							id: 'button_gerador_manual',
							action: 'add_panel_center',
							text: me.button_gerador,
							menu: {
								xtype: 'menu',
								items: [
									{
										xtype: 'menuitem',
										iconCls: 'cad',
										tabela: 'Gerador',
										action: 'list',
										id: 'menuitem_init_app',
										callback: false,
										text: me.item_init_app
									},
									{
										xtype: 'menuitem',
										iconCls: 'grid',
										tabela: 'Generated',
										action: 'list',
										id: 'menuitem_app_gerada',
										callback: false,
										text: me.item_app_gerada
									}
								]
							}
						},
						{
							xtype: 'button',
							iconCls: 'grid',
							id: 'button_config_admin',
							action: 'add_panel_center',
							text: me.button_config,
							menu: {
								xtype: 'menu',
								items: [
									{
										xtype: 'menuitem',
										iconCls: 'grid',
										tabela: 'Usuarios',
										action: 'list',
										id: 'menuitem_usuarios',
										callback: false,
										text: me.item_usuarios
									}
								]
							}
						},
						{
							xtype: 'button',
							iconCls: 'information',
							text: me.button_info,
							id: 'button_about_item',
							menu: {
								xtype: 'menu',
								items: [
									{
										xtype: 'menuitem',
										id: 'menuitem_about_item',
										iconCls: 'information',
										handler: function(){
											Ext.Msg.alert(me.infoAlert.desenvolvido_por, ''+
											'<b>'+me.infoAlert.desenvolvedor+'</b> Maciel Sousa<br>'+
											'<b>'+me.infoAlert.email+'</b> macielcr7@gmail.com<br>'+
											'<b>'+me.infoAlert.telefone+'</b> +55 (85) 8516-6042');
										},
										text: me.item_sobre
									},
									{
										xtype: 'menuitem',
										iconCls: 'information',
										id: 'button_version',
										handler: function(){
											var win = Ext.getCmp('AddEmailWin');
											if(!win) win = Ext.widget('addemailwin');
											win.show();
											Ext.getCmp('assunto_email').setValue('BUY');
										},
										text: me.button_version
									},
									{
										xtype: 'menuitem',
										iconCls: 'information',
										id: 'button_info_bugs',
										handler: function(){
											var win = Ext.getCmp('AddEmailWin');
											if(!win) win = Ext.widget('addemailwin');
											win.show();
											Ext.getCmp('assunto_email').setValue('BUG');
										},
										text: me.button_info_bugs
									},
									{
										xtype: 'menuitem',
										iconCls: 'information',
										id: 'button_api',
										handler: function(){
											window.open('server/modulos/api/download.php');
										},
										text: me.button_api
									}
								]
							}
						},	
						{
							xtype: 'button',
							iconCls: 'logout',
							action: 'logout',
							text: me.button_logout
						}
                    ]
                },
                {
                    xtype: 'tabpanel',
                    margins: 5,
					plugins: [
                       {
                    	   ptype: 'tabclosemenu'
                       }
                    ],
                    region: 'center',
                    id: 'TabPanelCentral'
                }
            ]
        });

        me.callParent(arguments);
    }

});