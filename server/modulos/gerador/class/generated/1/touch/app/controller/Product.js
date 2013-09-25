/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Product', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerproduct',
	
	mixins: {
		controls: 'ShSolutions.controller.Util'
    },
    
	tabela: 'Product',
	
    config: {
		id: 'Product',
		
		refs: {
			filter: {
				selector: 'productfilter',
				xtype: 'productfilter',
				autoCreate: true
			},
			form: {
				selector: 'productform',
				xtype: 'productform',
				autoCreate: true
			},
			list: {
				selector: 'productlist',
				xtype: 'productlist',
				autoCreate: true
			}
		},
		
		models: [
			'ModelProduct'
		],
		stores: [
			'StoreProduct'		
		],
        
        views: [
            'product.Edit',
            'product.Filtro',
            'product.List'
        ],
		
		control: {
        	'productform toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'productform toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'productform container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'productlist toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'productlist toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'productlist toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'productlist toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'productlist toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'productlist toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'productfilter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'productfilter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'productfilter toolbar button[action=back]' : {
        		tap: 'showList'
			}
        }
    },
    
    getWin: function(button){
    	ShSolutions.app.getController(button.config.modulo).showEdit(button, this.getForm());
    },
	
	deletar: function(button){
		var me = this;
		if(me.getList().getSelectionCount()>0){
			var record = me.getList().getSelection()[0];
			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('id')+'?', function(btn){
				if(btn=='yes'){
					me.deleteAjax(me.getList(), 'product', {
						action: 'DELETE',
						id: record.get('id')
					}, false);
				}
			});
		}
		else{
			Ext.Msg.alert(this.titleErro, this.delErroGrid);
		}
	},
	
	atualizar: function(button){
		var usr = Ext.create('ShSolutions.model.ModelProduct', this.getForm().getValues()),
		errs = usr.validate(),
		msg = '';
		if (!errs.isValid()){
			errs.each(function (err) {
				msg += err.getMessage() + '<br/>';
			});
			Ext.Msg.alert(this.titleErro, msg);
		} 
		else {
			this.save(this.getList(), this.getForm(), false);
		}
		usr.destroy();
	}
	
});