/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Laboratorio', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Laboratorio',

	refs: [
        {
        	ref: 'list',
        	selector: 'laboratoriolist'
        },
        {
        	ref: 'form',
        	selector: 'addlaboratoriowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'laboratoriolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterlaboratoriowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterlaboratoriowin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addlaboratoriowin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelLaboratorio'
	],
	stores: [
		'StoreComboLaboratorio',
		'StoreLaboratorio'		
	],
	
    views: [
        'laboratorio.List',
        'laboratorio.Filtro',
        'laboratorio.Edit'
    ],

    init: function(application) {
    	this.control({
    		'laboratoriolist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'laboratoriolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'laboratoriolist button[action=adicionar]': {
                click: this.add
            },
            'laboratoriolist button[action=editar]': {
                click: this.btedit
            },
            'laboratoriolist button[action=deletar]': {
                click: this.btdel
            },
            
            'laboratoriolist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addlaboratoriowin button[action=salvar]': {
                click: this.update
            },
            'addlaboratoriowin button[action=resetar]': {
                click: this.reset
            },
            'addlaboratoriowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addlaboratoriowin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addlaboratoriowin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterlaboratoriowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterlaboratoriowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterlaboratoriowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterlaboratoriowin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/laboratorio/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddLaboratorioWin');
        if(!win) win = Ext.widget('addlaboratoriowin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Laboratorio');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/laboratorio/list.php');
	    Ext.getCmp('action_laboratorio').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'laboratorio', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('laboratorio')+'?', function(btn){
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
		var win = Ext.getCmp('AddLaboratorioWin');
        if(!win) win = Ext.widget('addlaboratoriowin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterLaboratorioWin');
    	if(!win) win = Ext.widget('filterlaboratoriowin');
    	win.show();
    }

});
