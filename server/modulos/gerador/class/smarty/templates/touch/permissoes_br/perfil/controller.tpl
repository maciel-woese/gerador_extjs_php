/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.controller.Perfil', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerperfil',
	
	mixins: {
		controls: '{$app|capitalize}.controller.Util'
    },
    
	storePai: true,
	tabela: 'Perfil',
	
    config: {
		id: 'Perfil',
		
		refs: {
			filter: {
				selector: 'perfilfilter',
				xtype: 'perfilfilter',
				autoCreate: true
			},
			form: {
				selector: 'perfilform',
				xtype: 'perfilform',
				autoCreate: true
			},
			list: {
				selector: 'perfillist',
				xtype: 'perfillist',
				autoCreate: true
			}
		},
		
		models: [
			'ModelCombo',
			'ModelPerfil'
		],
		stores: [
			'StoreComboPerfil',
			'StorePerfil'		
		],
        
        views: [
            'perfil.Edit',
            'perfil.Filtro',
            'perfil.List'
        ],
		
		control: {
        	'perfilform toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'perfilform toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'perfilform container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'perfillist toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'perfillist toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'perfillist toolbar button[action=modulos]' : {
        		tap: 'modulos'
			},
			'perfillist toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'perfillist toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'perfillist toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'perfillist toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'perfilfilter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'perfilfilter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'perfilfilter toolbar button[action=back]' : {
        		tap: 'showList'
			}
        }
    },
	
	modulos: function(button){
		var me = this;
		if(me.getList().getSelectionCount()>0){
			var record = me.getList().getSelection()[0];
			var con = {$app|capitalize}.app.getController('Permissoes');
			con.getList().getStore().getProxy().config.extraParams.perfil_id = record.get('id');
			con.getList().getStore().getProxy().config.extraParams.usuario_id = 0;
			con.getList().getStore().getProxy().config.extraParams.action = 'PERFIL';
			con.showList(button);
			con.backEdit = this.getList();
		}
		else{
			Ext.Msg.alert('ERROR', "Selecione um Registro!");
		}
		
	},
    
    getWin: function(button){
    	{$app|capitalize}.app.getController(button.config.modulo).showEdit(button, this.getForm());
    },
	
	deletar: function(button){
		var me = this;
		if(me.getList().getSelectionCount()>0){
			var record = me.getList().getSelection()[0];
			Ext.Msg.confirm('Deletar...', 'Deseja Deletar: '+record.get('perfil')+'?', function(btn){
				if(btn=='yes'){
					me.deleteAjax(me.getList(), 'perfil', {
						action: 'DELETE',
						id: record.get('id')
					}, false);
				}
			});
		}
		else{
			Ext.Msg.alert('ERROR', "Selecione um Registro!");
		}
	},
	
	atualizar: function(button){
		var usr = Ext.create('{$app|capitalize}.model.ModelPerfil', this.getForm().getValues()),
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