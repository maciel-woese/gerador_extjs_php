{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.Preferences', {
    extend: 'Ext.app.Controller',

    models: [
        'ModelPreferences'
    ],
    stores: [
        'StorePreferencesAutoRun',
        'StorePreferencesQuickStart',
        'StorePreferencesMenuStart',
        'StorePreferencesIconDesktop'
    ],
    views: [
        'preferences.Preferences'
    ],
    
    init: function(application) {
    	this.control({
    		'preferences button[text=Salvar]': {
                click: this.save
            }            
    	});
    },
    
    updateIconsDesktop: function(records, action){
    	var me = this.application.getController('Desktop');
   		if(action=='save-quick-start'){
   			me.winquickBar.removeAll();
   	    	Ext.each(records, function(r){
   	    		var cls = r.get('id_modulo').split('-');
   				me.addQuickButton({
   	    			id: r.get('id_modulo'),
   	    			title: r.get('text'),
   	    			iconCls: Ext.util.Format.lowercase(cls[1])
   	    		});
   	    	});
   		}
		else if(action=='save-menu-start'){
   			info('Aviso!', 'Salvo com Sucesso!');
   		}
   		else if(action=='save-icon-desktop'){
   			Ext.each(Ext.select("#icon-desktop-view div.ux-desktop-shortcut", true).elements, function(el){
   			    el.remove();
   			});
   			
   			me.x = 0;
	    	me.y = 0;
			me.initColRow();
			
   			Ext.each(records, function(r){
	   			me.addIconDesktop({
					id: r.get('id_modulo'),
					name: r.get('text'),
					iconCls: r.get('iconCls')+'-shortcut',
					tooltip: r.get('text')
				});
   			});
   		}
    },
    
    save: function(button){
    	var action = button.action, json = [], rec = 0, me = this;
    	
    	if(action=='save-auto-run'){
    		rec = Ext.getCmp('auto-run-tree').getChecked();
    	}
    	else if(action=='save-quick-start'){
    		var rec = Ext.getCmp('quick-start-tree').getChecked();
    	}
    	else if(action=='save-icon-desktop'){
    		var rec = Ext.getCmp('icon-desktop-tree').getChecked();
    	}
    	else if(action=='save-menu-start'){
    		var rec = Ext.getCmp('icon-menu-start').getChecked();
    	}
    	Ext.each(rec, function(item){
    		var s = item.data.id_modulo.split('-');
    		
			json.push(Ext.encode({
				modulo: Ext.util.Format.lowercase(s[1])
			}));
		});
    	
    	Ext.Ajax.request({
    		url: 'server/modulos/preferences/save.php',
    		params: {
    			action: action,
    			json: [json]
    		},
    		success: function(o){
    			var d = Ext.decode(o.responseText);
    			if(d.success==true){
    				me.updateIconsDesktop(rec, action);
    			}
    			else{
    				info('Alert!', d.msg);
    			}
    		}
    	});
    }

});
