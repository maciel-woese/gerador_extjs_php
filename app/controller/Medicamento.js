/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Medicamento', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Medicamento',

	refs: [
        {
        	ref: 'list',
        	selector: 'medicamentolist'
        },
        {
        	ref: 'form',
        	selector: 'addmedicamentowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'medicamentolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtermedicamentowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtermedicamentowin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addmedicamentowin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelMedicamento'
	],
	stores: [
		'StoreComboLaboratorio',
		'StoreComboStatusMedicamento',
		'StoreComboMedicamento',
		'StoreMedicamento'		
	],
	
    views: [
        'medicamento.List',
        'medicamento.Filtro',
        'medicamento.Edit'
    ],

    init: function(application) {
    	this.control({
    		'medicamentolist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'medicamentolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'medicamentolist button[action=adicionar]': {
                click: this.add
            },
            'medicamentolist button[action=editar]': {
                click: this.btedit
            },
            'medicamentolist button[action=deletar]': {
                click: this.btdel
            },
            
            'medicamentolist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addmedicamentowin button[action=salvar]': {
                click: this.update
            },
            'addmedicamentowin button[action=resetar]': {
                click: this.reset
            },
            'addmedicamentowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addmedicamentowin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addmedicamentowin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtermedicamentowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtermedicamentowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtermedicamentowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtermedicamentowin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/medicamento/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddMedicamentoWin');
        if(!win) win = Ext.widget('addmedicamentowin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Medicamento');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/medicamento/list.php');
	    Ext.getCmp('action_medicamento').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'medicamento', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('medicamento')+'?', function(btn){
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
		var win = Ext.getCmp('AddMedicamentoWin');
        if(!win) win = Ext.widget('addmedicamentowin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterMedicamentoWin');
    	if(!win) win = Ext.widget('filtermedicamentowin');
    	win.show();
    }

});
