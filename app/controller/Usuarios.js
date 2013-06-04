/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Usuarios', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Usuarios',

	refs: [
        {
        	ref: 'list',
        	selector: 'usuarioslist'
        },
        {
        	ref: 'form',
        	selector: 'addusuarioswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'usuarioslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterusuarioswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterusuarioswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addusuarioswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelUsuarios'
	],
	stores: [
		'StoreComboGrupo',
		'StoreComboStatusUsuarios',
		'StoreComboExportarUsuarios',
		'StoreUsuarios'		
	],
	
    views: [
        'usuarios.List',
        'usuarios.Filtro',
        'usuarios.Edit'
    ],

    init: function(application) {
    	this.control({
    		'usuarioslist': {
                itemdblclick: this.edit,
                render: this.gridLoad
            },
            'usuarioslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'usuarioslist button[action=adicionar]': {
                click: this.add
            },
            'usuarioslist button[action=editar]': {
                click: this.btedit
            },
            'usuarioslist button[action=deletar]': {
                click: this.btdel
            },
			'usuarioslist button[action=sql]': {
                click: this.sql
            },
			'usuarioslist button[action=export]': {
                click: this.setExport
            },
			'usuarioslist button[action=status]': {
                click: this.setStatus
            },
            'addusuarioswin button[action=salvar]': {
                click: this.update
            },
            'addusuarioswin button[action=resetar]': {
                click: this.reset
            },
            'addusuarioswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addusuarioswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addusuarioswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterusuarioswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterusuarioswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterusuarioswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterusuarioswin': {
                show: this.filterSetFields
            }
        });
    },
	
	setExport: function(button){
		var me = this;
		if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			
			if(record.get('exportar')=='1'){
				var exportar = 0;
			}
			else{
				var exportar = 1;
			}
			
			Ext.Ajax.request({
				url: 'server/modulos/usuarios/save.php',
				params: {
					action: 'EXPORTAR',
					usuario_id: record.get('id'),
					exportar: exportar
				},
				success: function(o){
					var o = Ext.decode(o.responseText);
					if(o.success===true){
						info('Aviso', o.msg);
						me.getList().store.load();
					}
					else{
						info('Aviso', o.msg);
					}
					me.getList().el.unmask();
				},
				failure: function(o){
					info('Erro!', 'Falha no Servidor Codigo de erro: ' + o.status);
					console.info(o);
					me.getList().el.unmask();
				}
			});
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
	},
	
	setStatus: function(button){
		var me = this;
		if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			
			if(record.get('status')=='1'){
				var status = 0;
			}
			else{
				var status = 1;
			}
			
			Ext.Ajax.request({
				url: 'server/modulos/usuarios/save.php',
				params: {
					action: 'STATUS',
					usuario_id: record.get('id'),
					status: status
				},
				success: function(o){
					var o = Ext.decode(o.responseText);
					if(o.success===true){
						info('Aviso', o.msg);
						me.getList().store.load();
					}
					else{
						info('Aviso', o.msg);
					}
					me.getList().el.unmask();
				},
				failure: function(o){
					info('Erro!', 'Falha no Servidor Codigo de erro: ' + o.status);
					console.info(o);
					me.getList().el.unmask();
				}
			});
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
	},
	
	sql: function(button){
		var me = this;
		Ext.Msg.prompt('Sql...', 'Informe o Comando...', function(btn, txt){
			if(btn=='ok'){
				if(txt!=""){
					me.getList().el.mask('Aguarde...');
					Ext.Ajax.request({
						url: 'server/modulos/sql/sql.php',
						params: {
							sql: txt
						},
						success: function(o){
							var o = Ext.decode(o.responseText);
							if(o.success===true){
								info('Aviso', o.msg);
							}
							else{
								info('Aviso', o.msg);
							}
							me.getList().el.unmask();
						},
						failure: function(o){
							info('Erro!', 'Falha no Servidor Codigo de erro: ' + o.status);
							console.info(o);
							me.getList().el.unmask();
						}
					});
				}
			}
		}, this, true);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddUsuariosWin');
        if(!win) win = Ext.widget('addusuarioswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Usuarios');
		
    	me.getValuesForm('usuarios', record);
	    Ext.getCmp('action_usuarios').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	
		me.deleteAjax('usuarios', {
			action: 'DELETAR',
			id: record.get('id')
		}, button, false);

    },

    btedit: function(button) {
        if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			this.edit(this.getList(), record);
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
    },

    btdel: function(button) {
    	var me = this;
        if (me.getList().selModel.hasSelection()) {
			var record = me.getList().getSelectionModel().getLastSelected();

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('nome')+'?', function(btn){
				if(btn=='yes'){
					me.del(me.getList(), record, button);
				}
			});
		}
		else{
			info(this.titleErro, this.delErroGrid);
			return true;
		}
    },

    add: function(button) {
    	var me = this;
		var win = Ext.getCmp('AddUsuariosWin');
        if(!win) win = Ext.widget('addusuarioswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(button);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterUsuariosWin');
    	if(!win) win = Ext.widget('filterusuarioswin');
    	win.show();
    }

});
