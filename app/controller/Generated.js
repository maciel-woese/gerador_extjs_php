/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Generated', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },
	
	refs: [
        {
        	ref: 'grid',
        	selector: 'generatedlist'
        }
    ],
	
    models: [
		'ModelGenerated',
		'ModelGeneratedChart'
	],
	stores: [
		'StoreGenerated',
		'StoreGeneratedChart'		
	],
	
    views: [
        'generated.List',
        'generated.Chart'
    ],
	
    init: function(application) {
    	this.control({
    		'generatedlist': {
    			render: this.gridLoad
    		},
			'generatedchart': {
    			render: this.gridLoad
    		},
    		'generatedlist button[action=export]': {
                click: this.exportApp
            },
			'generatedlist button[action=chart]': {
                click: this.chartApp
            },
    		'generatedlist button[action=deletar]': {
                click: this.deleteApp
            }
        });
    },
	
	chartApp: function(button){
		var me = this;
		this.application.getController('Principal').clickMenu(button, {
			action: 'chart',
			text: me.chartTitle,
			tabela: 'Generated',
			callback: false
		});
	},
    
    exportApp: function(button){
		var me = this;
    	 if (this.getGrid().selModel.hasSelection()) {
 			var record = this.getGrid().getSelectionModel().getLastSelected();
 			if((window.tipo_usuario.exportar) && window.tipo_usuario.exportar=='1'){
 				window.open('server/modulos/gerador/export.php?action=EXPORT_GET&nome_projeto='+record.get('project_zip'), '_blank');
 			}
 			else{
 				Ext.Msg.alert(me.avisoText, me.version_principal);
 			}
 			
 		}
 		else{
 			info(me.titleErro, me.exportarText);
 			return true;
 		}
    },
    
    deleteApp: function(button){
		var me = this;
    	 if (this.getGrid().selModel.hasSelection()) {
 			var record = this.getGrid().getSelectionModel().getLastSelected();
 			Ext.Ajax.request({
				url: 'server/modulos/generated/delete.php',
				params: {
					action: 'DELETAR',
					zip: record.get('project_zip'),
					id: record.get('id')
				},
				success: function(o){
					var o = Ext.decode(o.responseText);
					if(o.success===true){
						info('Aviso', o.msg);
						me.getGrid().store.load();
						if(typeof callbackSuccess == 'function'){
							callbackSuccess();
						}
					}
					else{
						info('Aviso', o.msg);
					}
				},
				failure: function(o){
					button.setDisabled(false);
					info(me.titleErro, me.falhaServer + o.status);
					console.info(o);
				}
			});
 			
 		}
 		else{
 			info(me.titleErro, me.delErroGrid);
 			return true;
 		}
    }

});
