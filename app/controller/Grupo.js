Ext.define('ShSolutions.controller.Grupo', {
    extend: 'Ext.app.Controller',
    mixins: {
        controls: 'ShSolutions.controller.Util'
    },
   
    refs: [
        {
        	ref: 'list',
        	selector: 'grupolist'
        },
        {
        	ref: 'form',
        	selector: 'addgrupowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'grupolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtergrupowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtergrupowin form'
        },
        {
        	ref: 'Win',
        	selector: 'addgrupowin'
        }
    ],
 
    models: [
		'ModelCombo',
		'ModelGrupo'
	],
	stores: [
		'StoreComboGrupo',
		'StoreGrupo'		
	],
	
    views: [
		'grupo.List',
		'grupo.Filtro',
		'grupo.Edit'
    ],

    init: function(application) {
    	this.control({
    		'grupolist': {
                itemdblclick: this.edit,
                render: this.gridLoad
            },
            'grupolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'grupolist button[action=adicionar]': {
                click: this.add
            },
            'grupolist button[action=editar]': {
                click: this.btedit
            },
            'grupolist button[action=deletar]': {
                click: this.btdel
            },
            'addgrupowin button[action=salvar]': {
                click: this.update
            },
            'addgrupowin button[action=resetar]': {
                click: this.reset
            },
            'filtergrupowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtergrupowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
			'filtergrupowin': {
                show: this.filterSetFields
            }
        });
    },
	
	resetFielter: function(button){
		this.getFilterBtn().setText('Filtrar');
    	this.getList().store.proxy.extraParams = {
    		action: 'LIST'
    	};
    	this.getList().store.load();
    	this.getFilterWin().close();
	},
	
	setFielter: function(button){
		var Params = {
    		grupo: Ext.getCmp('grupo_filter_grupo').getValue(),    		
			action: 'FILTER'
		};
    	
    	this.getList().store.proxy.extraParams = Params;
    	this.getFilterBtn().setText(this.filteredText);
    	this.getList().store.load();
    	this.getFilterWin().close();
	},
    
    filterSetFields: function(){
    	var p = this.getList().store.proxy.extraParams;
        if(p.action=='FILTER'){
			this.getFilterForm().getForm().setValues(p);
        }
    },
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddPerfilWin');
		if(!win) win = Ext.widget('addperfilwin');
		win.show();
		me.getValuesForm('perfil', record, false);
		Ext.getCmp('action_perfil').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
		//tabela, params, button, callback
		me.deleteAjax('grupo', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('grupo')+'?', function(btn){
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
    	var win = Ext.getCmp('AddGrupoWin');
		if(!win) win = Ext.widget('addgrupowin');
		win.show();
    },

    update: function(button) {
    	var me = this;
		//button, callbackSuccess, callbackFailure
		me.saveForm(button, false, false);
    },

    reset: function(button){
    	Ext.each(this.getForm().getForm().getFields().items, function(field){
    		if(field.isVisible()==true){
    			field.reset();
    		}
    	});
    },

    btStoreLoadFielter: function(button){
    	var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.grupo.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
