{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.Principal', {
    extend: 'Ext.app.Controller',

	views: [
        'Principal'
    ],
    
    models: [
    	'ModelMenu'
    ],
    
    stores: [
    	'TreeStoreMenu'
    ],
    
    init: function(application) {
        var me = this;
		this.control({
            'containerprincipal panel treepanel': {
                itemclick: this.addTabPanel
            }
		});
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

