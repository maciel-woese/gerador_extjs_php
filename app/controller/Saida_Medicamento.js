/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Saida_Medicamento', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Saida_Medicamento',

	refs: [
        {
        	ref: 'list',
        	selector: 'saida_medicamentolist'
        },
        {
        	ref: 'form',
        	selector: 'addsaida_medicamentowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'saida_medicamentolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtersaida_medicamentowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtersaida_medicamentowin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addsaida_medicamentowin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelSaida_Medicamento'
	],
	stores: [
		'StoreComboUsuarios',
		'StoreComboPacientes',
		'StoreComboSaida_Medicamento',
		'StoreSaida_Medicamento'		
	],
	
    views: [
        'saida_medicamento.List',
        'saida_medicamento.Filtro',
        'saida_medicamento.Edit'
    ],

    init: function(application) {
    	this.control({
    		'saida_medicamentolist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'saida_medicamentolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'saida_medicamentolist button[action=adicionar]': {
                click: this.add
            },
            'saida_medicamentolist button[action=editar]': {
                click: this.btedit
            },
            'saida_medicamentolist button[action=deletar]': {
                click: this.btdel
            },
			'saida_medicamentolist button[action=remover_itens]': {
                click: this.btDelItens
            },
            
            'saida_medicamentolist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addsaida_medicamentowin button[action=salvar]': {
                click: this.update
            },
            'addsaida_medicamentowin button[action=resetar]': {
                click: this.reset
            },
            'addsaida_medicamentowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addsaida_medicamentowin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addsaida_medicamentowin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtersaida_medicamentowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtersaida_medicamentowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtersaida_medicamentowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtersaida_medicamentowin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
				window.open('server/modulos/saida_medicamento/pdf.php?id='+record.get('id')
			);
		}
		else{
			info(this.titleErro, this.editPDFText);
			return true;
		}
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddSaida_MedicamentoWin');
        if(!win) win = Ext.widget('addsaida_medicamentowin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Saida de Medicamento');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/saida_medicamento/list.php');
	    Ext.getCmp('action_saida_medicamento').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'saida_medicamento', {
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
	
	
    btDelItens: function(button) {
		var me = this;
        if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			var controllerP = me.application.getController('Saida_Produtos');
			var win = Ext.getCmp('Container_Saida_Produtos');
			if(!win){
				var win = Ext.widget('containerwin', {
					title: 'Saida de Itens',
					modal: true,
					id: 'Container_Saida_Produtos',
					items: [
						{
							xtype: 'saida_produtoslist',
							loadDisabled: true
						}
					]
				});
			}
			win.show();
			controllerP.getList().store.proxy.extraParams.saida_id = record.get('id');
			controllerP.getList().store.load();
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: Saida de Medicamento?', function(btn){
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
		var win = Ext.getCmp('AddSaida_MedicamentoWin');
        if(!win) win = Ext.widget('addsaida_medicamentowin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterSaida_MedicamentoWin');
    	if(!win) win = Ext.widget('filtersaida_medicamentowin');
    	win.show();
    }

});
