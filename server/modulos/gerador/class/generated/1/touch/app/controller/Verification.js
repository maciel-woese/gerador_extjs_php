/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Verification', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerverification',
	
	mixins: {
		controls: 'ShSolutions.controller.Util'
    },
    
	tabela: 'Verification',
	
    config: {
		id: 'Verification',
		
		refs: {
			filter: {
				selector: 'verificationfilter',
				xtype: 'verificationfilter',
				autoCreate: true
			},
			form: {
				selector: 'verificationform',
				xtype: 'verificationform',
				autoCreate: true
			},
			list: {
				selector: 'verificationlist',
				xtype: 'verificationlist',
				autoCreate: true
			}
		},
		
		models: [
			'ModelVerification'
		],
		stores: [
			'StoreVerification'		
		],
        
        views: [
            'verification.Edit',
            'verification.Filtro',
            'verification.List'
        ],
		
		control: {
        	'verificationform toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'verificationform toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'verificationform container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'verificationlist toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'verificationlist toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'verificationlist toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'verificationlist toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'verificationlist toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'verificationlist toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'verificationfilter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'verificationfilter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'verificationfilter toolbar button[action=back]' : {
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
					me.deleteAjax(me.getList(), 'verification', {
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
		var usr = Ext.create('ShSolutions.model.ModelVerification', this.getForm().getValues()),
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