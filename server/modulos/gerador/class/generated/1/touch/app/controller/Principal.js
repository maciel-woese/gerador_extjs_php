/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Principal', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerprincipal',

    config: {
		
		refs: {
			list: {
				selector: 'containerprincipal',
				xtype: 'containerprincipal',
				autoCreate: true
			}
		},
		
        models: [
            'ModelPrincipal'
        ],
        stores: [
            'StorePrincipal'
        ],
        views: [
            'Principal'
        ],
		
		control: {
        	'containerprincipal' : {
        		itemtap: 'setPanelView'
			}
        }
    },
	
	setPanelView: function(comp, index, target, record){
		if(record.get('action')=='list'){
			var controller = ShSolutions.app.getController(record.get('modulo'));
			controller.showList();
			
		}
		else if(record.get('action')=='logout'){
			window.location = "logout.php";
		}
	}
});