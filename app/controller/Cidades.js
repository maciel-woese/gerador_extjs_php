/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Cidades', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Cidades',

	refs: [
        {
        	ref: 'list',
        	selector: 'cidadeslist'
        },
        {
        	ref: 'form',
        	selector: 'addcidadeswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'cidadeslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtercidadeswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtercidadeswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addcidadeswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelCidades'
	],
	stores: [
		'StoreComboEstados',
		'StoreComboCidades',
		'StoreCidades'		
	],
	
    views: [
        'cidades.List',
        'cidades.Filtro',
        'cidades.Edit'
    ],

    init: function(application) {
    	this.control({
    		'cidadeslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'cidadeslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'cidadeslist button[action=adicionar]': {
                click: this.add
            },
            'cidadeslist button[action=editar]': {
                click: this.btedit
            },
            'cidadeslist button[action=deletar]': {
                click: this.btdel
            },
            'addcidadeswin button[action=salvar]': {
                click: this.update
            },
            'addcidadeswin button[action=resetar]': {
                click: this.reset
            },
            'addcidadeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addcidadeswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addcidadeswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtercidadeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtercidadeswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtercidadeswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtercidadeswin': {
                show: this.filterSetFields
            }
        });
    },
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddCidadesWin');
        if(!win) win = Ext.widget('addcidadeswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Cidades');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/cidades/list.php');
	    Ext.getCmp('action_cidades').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'cidades', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('cidade')+'?', function(btn){
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
		var win = Ext.getCmp('AddCidadesWin');
        if(!win) win = Ext.widget('addcidadeswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterCidadesWin');
    	if(!win) win = Ext.widget('filtercidadeswin');
    	win.show();
    }

});
