/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Principal', {
    extend: 'Ext.app.Controller',

	views: [
        'Principal'
    ],
    
    models: [
    	'ModelImages',
    	'ModelCombo',
    	'ModelMenu'
    ],
    
    stores: [
    	'StoreImages',
    	'StoreComboFilial',
    	'TreeStoreMenu'
    ],
    
    init: function(application) {
        var me = this;
		this.control({
            'containerprincipal combobox[id=filial_id_principal]': {
				render: this.loadCombo,
				change: this.ajaxCombo
			},
            'containerprincipal': {
				afterrender: this.loadImages
			},
			'containerprincipal button[action=altera_senha]': {
				click: this.alterarSenha
			},
            'containerprincipal panel treepanel': {
                itemclick: this.addTabPanel
            }
		});
    },
	
	alterarSenha: function(button){
		var me = this;
		var id = Ext.decode(decodeURIComponent(getParams('functions.js').response)).id;
		var win = Ext.getCmp('AddSenhaWin');
        if(!win) win = Ext.widget('addsenhawin');
        win.show();
		Ext.getCmp('id_senha').setValue(id);
	},
	
	ajaxCombo: function(comp){
		Ext.Ajax.request({
			url: 'server/modulos/filial/alterar_filial.php',
			params:{
				action: 'ALTERAR',
				id: comp.getValue(),
				nome: comp.getRawValue()
			},
			success: function(o){
				var o = Ext.decode(o.responseText);
				if(o.success==true){
					var e = Ext.ComponentQuery.query('gridpanel', Ext.getCmp('PanelCentral'));
					for(var i in e){
						e[i].store.load();
					}
				}
			}
		});
	},
	
	loadCombo: function(comp){
		var usuario = Ext.decode(decodeURIComponent(getParams('functions.js').response));
		if(parseInt(usuario.filial_id_admin)==1){
			comp.store.load({
				callback: function(){
					if(usuario.filial_id=='0'){
						comp.setValue(comp.store.getAt(0).get('id'));
					}
					else{
						comp.setValue(usuario.filial_id);
					}
				}
			});
			comp.setReadOnly(false);
			comp.setVisible(true);
		}	
	},
	
	loadImages: function(container){
		var me = this;
		Ext.getCmp('PanelCentral').add({
			  title: 'Inicializar',
			  layout: {
				type: 'fit'
			  },
			  id: 'images-view',
			  items: Ext.create('Ext.view.View', {
				id: 'images-view-view',
				store: Ext.data.StoreManager.lookup('StoreImages'),
				tpl: [
					'<tpl for=".">',
						'<div class="thumb-wrap" id="{modulo}">',
						'<div class="thumb"><img src="{src}" title="{descricao}"/></div>',
						'<span>{shortName}</span></div>',
					'</tpl>',
					'<div class="x-clear"></div>'
				],
				trackOver: true,
				overItemCls: 'x-item-over',
				itemSelector: 'div.thumb-wrap',
				prepareData: function(data) {
					Ext.apply(data, {
						shortName: Ext.util.Format.ellipsis(data.descricao, 10)
					});
					return data;
				},
				listeners: {
					itemclick: function(dv, node){
						var ID = 'listagem_'+node.get('modulo');
						var TITLE = node.get('descricao');
						var TABLE = node.get('modulo');
						
						var novaAba = Ext.getCmp('PanelCentral').items.findBy(function( aba ){ return aba.id === ID; });
						if(!novaAba){
							novaAba = Ext.getCmp('PanelCentral').add({
								  title	: TITLE,
								  closable: true,
								  iconCls: node.get('modulo'),
								  layout: {
									type: 'fit'
								  },
								  id: ID,
								  items: {
									  xtype: TABLE+'list',
									  border: false
								  }
							});
						}
						
						Ext.getCmp('PanelCentral').setActiveTab(ID);
					}
				}
			})
		});
		Ext.getCmp('PanelCentral').setActiveTab('images-view');
		Ext.getCmp('images-view-view').store.load();
	},
	
	addTabPanel: function(view, model){
		if(model.data.leaf!=true){
			return true;
		}
		if(model.raw.tab!==""){
			var ID = model.raw.idtemp.toUpperCase();
			var TITLE = model.raw.text;
			var TABLE = model.raw.tab.toLowerCase();
			var tipo = model.raw.tipo;
			var str = model.raw.tab;
			
			if(tipo=='cad'){
				this.application.getController(str).add(view);
				return true;
			}
			
			var novaAba = Ext.getCmp('PanelCentral').items.findBy(function( aba ){ return aba.id === ID; });
			
			if(!novaAba){
				novaAba = Ext.getCmp('PanelCentral').add({
					  title	: TITLE,
					  closable: true,
					  iconCls: model.raw.iconCls,
					  layout: {
						type: 'fit'
					  },
					  id: ID,
					  items: {
						  xtype: TABLE+'list',
						  border: false
					  }
				});
			}
			
			Ext.getCmp('PanelCentral').setActiveTab(ID);
		}
	}
});

