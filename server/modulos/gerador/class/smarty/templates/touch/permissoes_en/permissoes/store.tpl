/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.store.StorePermissoes', {
    extend: 'Ext.data.Store',
    alias: 'store.storepermissoes',

    requires: [
        '{$app|capitalize}.model.ModelPermissoes'
    ],

    config: {
        model: '{$app|capitalize}.model.ModelPermissoes',
        storeId: 'StorePermissoes',
		grouper: {
			groupFn: function(record) {
				return record.get('modulo');
			}
		},
        proxy: {
            type: 'ajax',
			url: 'server/modulos/permissoes/list.php',
			extraParams: {
                action: 'PERFIL'
            },
			actionMethods: {
		        create : 'POST',
		        read   : 'POST',
		        update : 'POST',
		        destroy: 'POST'
		    },
            reader: {
                type: 'json',
                rootProperty: 'dados'
            }
        },
		
		listeners: {
			load: function(comp, rec){
				var res = [];
				Ext.each(rec, function(m){
					if(m.get('checked')==true){
						res.push(m);
					}
				});
				Ext.getCmp('AddPermissoesWin').select(res);
			}
		}
    }
});
