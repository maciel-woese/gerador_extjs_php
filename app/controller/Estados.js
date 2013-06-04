/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Estados', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Estados',

	refs: [
        {
        	ref: 'list',
        	selector: 'estadoslist'
        },
        {
        	ref: 'form',
        	selector: 'addestadoswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'estadoslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterestadoswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterestadoswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addestadoswin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelEstados'
	],
	stores: [
		'StoreComboEstados',
		'StoreEstados'		
	],
	
    views: [
        'estados.List',
        'estados.Filtro',
        'estados.Edit'
    ],

    init: function(application) {
    	this.control({
    		'estadoslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'estadoslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'estadoslist button[action=adicionar]': {
                click: this.add
            },
            'estadoslist button[action=editar]': {
                click: this.btedit
            },
            'estadoslist button[action=deletar]': {
                click: this.btdel
            },
            'addestadoswin button[action=salvar]': {
                click: this.update
            },
            'addestadoswin button[action=resetar]': {
                click: this.reset
            },
            'addestadoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addestadoswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addestadoswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterestadoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterestadoswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterestadoswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterestadoswin': {
                show: this.filterSetFields
            }
        });
    },
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddEstadosWin');
        if(!win) win = Ext.widget('addestadoswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Estados');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/estados/list.php');
	    Ext.getCmp('action_estados').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'estados', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('descricao')+'?', function(btn){
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
		var win = Ext.getCmp('AddEstadosWin');
        if(!win) win = Ext.widget('addestadoswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterEstadosWin');
    	if(!win) win = Ext.widget('filterestadoswin');
    	win.show();
    }

});
