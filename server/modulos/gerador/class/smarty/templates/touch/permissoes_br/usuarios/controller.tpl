
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.controller.Usuarios', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerusuarios',
	
	mixins: {
		controls: '{$app|capitalize}.controller.Util'
    },
    
	tabela: 'Usuarios',
	
    config: {
		id: 'Usuarios',
		
		refs: {
			filter: {
				selector: 'usuariosfilter',
				xtype: 'usuariosfilter',
				autoCreate: true
			},
			form: {
				selector: 'usuariosform',
				xtype: 'usuariosform',
				autoCreate: true
			},
			list: {
				selector: 'usuarioslist',
				xtype: 'usuarioslist',
				autoCreate: true
			}
		},
		
		models: [
			'ModelComboLocal',
			'ModelUsuarios'
		],
		stores: [
			'StoreComboPerfil',
			'StoreComboAdministradorUsuarios',
			'StoreComboStatusUsuarios',
			'StoreUsuarios'		
		],
        
        views: [
            'usuarios.Edit',
            'usuarios.Filtro',
            'usuarios.List'
        ],
		
		control: {
        	'usuariosform toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'usuariosform toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'usuariosform container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'usuarioslist toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'usuarioslist toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'usuarioslist toolbar button[action=modulos]' : {
        		tap: 'modulos'
			},
			'usuarioslist toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'usuarioslist toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'usuarioslist toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'usuarioslist toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'usuariosfilter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'usuariosfilter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'usuariosfilter toolbar button[action=back]' : {
        		tap: 'showList'
			}
        }
    },
    	
	modulos: function(button){
		var me = this;
		if(me.getList().getSelectionCount()>0){
			var record = me.getList().getSelection()[0];
			var con = {$app|capitalize}.app.getController('Permissoes');
			con.getList().getStore().getProxy().config.extraParams.perfil_id = record.get('perfil_id');
			con.getList().getStore().getProxy().config.extraParams.usuario_id = record.get('id');
			con.getList().getStore().getProxy().config.extraParams.action = 'USUARIO';
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
			Ext.Msg.confirm('Deletar...', 'Deseja Deletar: '+record.get('nome')+'?', function(btn){
				if(btn=='yes'){
					me.deleteAjax(me.getList(), 'usuarios', {
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
		var usr = Ext.create('{$app|capitalize}.model.ModelUsuarios', this.getForm().getValues()),
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