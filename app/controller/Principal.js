Ext.define('ShSolutions.controller.Principal', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controller_principal',
	
    views: [
        'container.Principal',
        'email.Edit'
    ],
	
	sair: 'Sair...',
	msg_sair: 'Desejar Sair?',
	
	init: function(app){
		this.control({
            'view_principal': {
                afterrender: this.shortcut
            },
			'view_principal toolbar button[action=add_panel_center] menu': {
                click: this.clickMenu
            },
            'view_principal toolbar button[action=logout]': {
            	click: this.logout
            }
		});
	},
	
	logout: function(button){
		Ext.Msg.confirm(this.sair, this.msg_sair, function(btn){
			if(btn=='yes'){
				window.location = 'logout.php';
			}
		});
	},
	
	clickMenu: function(menu, item){
		var me 		 = this;
		var tabela   = item.tabela.toLowerCase();
		var action   = item.action;
		var alias    = tabela+'list';
		var idGrid   = 'Grid'+item.tabela;
		var callback = item.callback;
		var ID 		 = 'LISTAGEM_'+tabela.toUpperCase()+'_TAB';
		if(action=='list'){
			var novaAba = Ext.getCmp('TabPanelCentral').items.findBy(function( aba ){ return aba.id === ID; });
			
			if(!novaAba){
				novaAba = Ext.getCmp('TabPanelCentral').add({
					  title	: item.text,
					  iconCls: item.iconCls,
					  closable: true,
					  layout: {
						type: 'fit'
					  },
					  id: ID,
					  items: {
						  xtype: alias
					  }
				});
			}
			
			Ext.getCmp('TabPanelCentral').setActiveTab(ID);
		}
		else if(action=='insert'){
			me.application.getController(item.tabela).add(item);
		}
		else if(action=='chart'){
			var alias    = tabela+'chart';
			var idGrid   = 'Grid'+item.tabela+'Chart';
			var ID 		 = 'LISTAGEM_'+tabela.toUpperCase()+'CHART_TAB';
			var novaAba = Ext.getCmp('TabPanelCentral').items.findBy(function( aba ){ return aba.id === ID; });
			
			if(!novaAba){
				novaAba = Ext.getCmp('TabPanelCentral').add({
					  title	: item.text,
					  iconCls: item.iconCls,
					  closable: true,
					  layout: {
						type: 'fit'
					  },
					  id: ID,
					  items: {
						  xtype: alias
					  }
				});
			}
			
			Ext.getCmp('TabPanelCentral').setActiveTab(ID);
		}
		
		if(typeof callback == 'function'){
			callback();
		}
	},
	
	shortcut: function(comp){
		var me = this;
		shortcut.add('ctrl+r', function(){
			Ext.getCmp('button_gerador_manual').showMenu();
		});
		
		shortcut.add('ctrl+i', function(){
			me.clickMenu(comp, Ext.getCmp('menuitem_init_app'));
		});
		
		shortcut.add('ctrl+g', function(){
			me.clickMenu(comp, Ext.getCmp('menuitem_app_gerada'));
		});
		
		shortcut.add('Ctrl+B', function(){
			if(!Ext.getCmp('button_info_bugs').isVisible()){
				Ext.getCmp('button_info_bugs').handler();
			}
		});
		
		shortcut.add('Shift+V', function(){
			if(!Ext.getCmp('button_version').isVisible()){
				Ext.getCmp('button_version').handler();
			}
		});
		
		shortcut.add('Shift+I', function(){
			if(Ext.getCmp('button_api').isVisible()){
				Ext.getCmp('button_api').handler();
			}
		});
		
		shortcut.add('Shift+X', function(){
			if(Ext.getCmp('menuitem_about_item').isVisible()){
				Ext.getCmp('menuitem_about_item').handler();
			}
		});
		
		shortcut.add('Shift+B', function(){
			Ext.getCmp('button_about_item').showMenu();
		});
		
		shortcut.add('Shift+L', function(){
			if(Ext.getCmp('button_api').isVisible()){
				Ext.getCmp('button_api').handler();
			}	
		});
		
		shortcut.add('f4', function(){
			me.logout(comp);
		});
		
		shortcut.add('ctrl+l', function(){
			if(Ext.getCmp('button_login_banco')){
				me.application.getController('Gerador').login(Ext.getCmp('button_login_banco'));
			}
		});
		
		shortcut.add('Shift+t', function(){
			if((Ext.getCmp('button_select_tabelas')) && (!Ext.getCmp('button_select_tabelas').isDisabled())){
				me.application.getController('Gerador').selectTabelas(Ext.getCmp('button_select_tabelas'));
			}
		});
		
		shortcut.add('Shift+P', function(){
			if((Ext.getCmp('button_prepare_crud')) && (!Ext.getCmp('button_prepare_crud').isDisabled())){
				me.application.getController('Gerador').prepareCrud(Ext.getCmp('button_prepare_crud'));
			}
		});
		
		shortcut.add('Shift+S', function(){
			if((Ext.getCmp('button_sync_crud')) && (!Ext.getCmp('button_sync_crud').isDisabled())){
				me.application.getController('Gerador').syncCrud(Ext.getCmp('button_sync_crud'));
			}
		});
		
		shortcut.add('Shift+E', function(){
			if((Ext.getCmp('button_export_crud')) && (!Ext.getCmp('button_export_crud').isDisabled())){
				me.application.getController('Gerador').exportCrud(Ext.getCmp('button_export_crud'));
			}
		});
		
		shortcut.add('Shift+G', function(){
			if((Ext.getCmp('button_test_crud')) && (!Ext.getCmp('button_test_crud').isDisabled())){
				me.application.getController('Gerador').testarCrud(Ext.getCmp('button_test_crud'));
			}
		});
		
		shortcut.add('Alt+L', function(){
			if((Ext.getCmp('login_banco_login')) && (!Ext.getCmp('login_banco_login').isDisabled())){
				me.application.getController('Gerador').loginBanco(Ext.getCmp('login_banco_login'));
			}
		});
		
		shortcut.add('Shift+o', function(){
			if((Ext.getCmp('button_config_admin'))){
				Ext.getCmp('button_config_admin').showMenu();
			}
		});
		
		shortcut.add('Shift+u', function(){
			if((Ext.getCmp('menuitem_usuarios'))){
				me.clickMenu(comp, Ext.getCmp('menuitem_usuarios'));
			}
		});
	
	}
	
});
