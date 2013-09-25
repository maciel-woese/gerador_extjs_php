/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.User', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controlleruser',
	
	mixins: {
		controls: 'ShSolutions.controller.Util'
    },
    
	tabela: 'User',
	
    config: {
		id: 'User',
		
		refs: {
			filter: {
				selector: 'userfilter',
				xtype: 'userfilter',
				autoCreate: true
			},
			form: {
				selector: 'userform',
				xtype: 'userform',
				autoCreate: true
			},
			list: {
				selector: 'userlist',
				xtype: 'userlist',
				autoCreate: true
			}
		},
		
		models: [
			'ModelUser'
		],
		stores: [
			'StoreUser'		
		],
        
        views: [
            'user.Edit',
            'user.Filtro',
            'user.List'
        ],
		
		control: {
        	'userform toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'userform toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'userform container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'userlist toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'userlist toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'userlist toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'userlist toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'userlist toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'userlist toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'userfilter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'userfilter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'userfilter toolbar button[action=back]' : {
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
					me.deleteAjax(me.getList(), 'user', {
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
		var usr = Ext.create('ShSolutions.model.ModelUser', this.getForm().getValues()),
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