{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.Principal', {
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
{if $permissoes=='sim'}	
    
    getPermissoes: function(list, tabela){
    	var me = this;
		var data = {$app|capitalize}.app.dados[tabela];
    	var items = list.down('toolbar[docked=bottom]').items.items;
    	Ext.each(items, function(p){
			Ext.each(data, function(j){
				if(p.config.action && p.config.action==j.acao){
					p.setHidden(false);
				}
			});
		});
    },
    
{/if}	
	setPanelView: function(comp, index, target, record){
		if(record.get('action')=='list'){
			var controller = {$app|capitalize}.app.getController(record.get('modulo'));
			controller.showList();
{if $permissoes=='sim'}				
			this.getPermissoes(controller.getList(), controller.tabela.toLowerCase());
{/if}			
		}
		else if(record.get('action')=='logout'){
			window.location = "logout.php";
		}
	}
});