/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Verification_Products', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerverification_products',
	
	mixins: {
		controls: 'ShSolutions.controller.Util'
    },
    
	tabela: 'Verification_Products',
	
    config: {
		id: 'Verification_Products',
		
		refs: {
			filter: {
				selector: 'verification_productsfilter',
				xtype: 'verification_productsfilter',
				autoCreate: true
			},
			form: {
				selector: 'verification_productsform',
				xtype: 'verification_productsform',
				autoCreate: true
			},
			list: {
				selector: 'verification_productslist',
				xtype: 'verification_productslist',
				autoCreate: true
			}
		},
		
		models: [
			'ModelVerification_Products'
		],
		stores: [
			'StoreVerification_Products'		
		],
        
        views: [
            'verification_products.Edit',
            'verification_products.Filtro',
            'verification_products.List'
        ],
		
		control: {
        	'verification_productsform toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'verification_productsform toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'verification_productsform container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'verification_productslist toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'verification_productslist toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'verification_productslist toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'verification_productslist toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'verification_productslist toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'verification_productslist toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'verification_productsfilter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'verification_productsfilter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'verification_productsfilter toolbar button[action=back]' : {
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
					me.deleteAjax(me.getList(), 'verification_products', {
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
		var usr = Ext.create('ShSolutions.model.ModelVerification_Products', this.getForm().getValues()),
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