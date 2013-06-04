/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Saida_Produtos', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Saida_Produtos',

	refs: [
        {
        	ref: 'list',
        	selector: 'saida_produtoslist'
        },
        {
        	ref: 'form',
        	selector: 'addsaida_produtoswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'saida_produtoslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtersaida_produtoswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtersaida_produtoswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addsaida_produtoswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelSaida_Produtos'
	],
	stores: [
		'StoreComboSaida_Medicamento',
		'StoreComboMedicamento',
		'StoreSaida_Produtos'		
	],
	
    views: [
        'saida_produtos.List',
        'saida_produtos.Filtro',
        'saida_produtos.Edit'
    ],

    init: function(application) {
    	this.control({
    		'saida_produtoslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'saida_produtoslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'saida_produtoslist button[action=adicionar]': {
                click: this.add
            },
            'saida_produtoslist button[action=editar]': {
                click: this.btedit
            },
            'saida_produtoslist button[action=deletar]': {
                click: this.btdel
            },
            'saida_produtoslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
			
            'addsaida_produtoswin': {
                show: this.getSaidaId
            },
			'addsaida_produtoswin button[action=salvar]': {
                click: this.update
            },
            'addsaida_produtoswin button[action=resetar]': {
                click: this.reset
            },
            'addsaida_produtoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
			'addsaida_produtoswin form fieldcontainer combobox[id=medicamento_id_saida_produtos]': {
                change: this.setQuantidade
            },
            'addsaida_produtoswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addsaida_produtoswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtersaida_produtoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtersaida_produtoswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtersaida_produtoswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtersaida_produtoswin': {
                show: this.filterSetFields
            }
        });
    },
	
	setQuantidade: function(comp, rec){
		var record = Ext.getCmp('medicamento_id_saida_produtos').store.getById(rec);
		if(record!=null){
			var maxValue = parseInt(record.raw.quantidade);
			Ext.getCmp('quantidade_saida_produtos').setMaxValue(maxValue);
		}
	},
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/saida_produtos/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
	getSaidaId: function(comp){
		var id = this.getList().store.proxy.extraParams.saida_id;
		Ext.getCmp('saida_id_saida_produtos').setValue(id);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddSaida_ProdutosWin');
        if(!win) win = Ext.widget('addsaida_produtoswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Saida de Produtos');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/saida_produtos/list.php');
	    Ext.getCmp('action_saida_produtos').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
		var controlerP = me.application.getController('Medicamento');
     	me.deleteAjax(grid, 'saida_produtos', {
			action: 'DELETAR',
			id: record.get('id'),
			medicamento_id: record.get('medicamento_id'),
			quantidade: record.get('quantidade')
		}, button, function(){
			if(controlerP.getList()){
				controlerP.getList().store.load();
				controlerP.getStoresDependes();
			}
		});

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
		var win = Ext.getCmp('AddSaida_ProdutosWin');
        if(!win) win = Ext.widget('addsaida_produtoswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		var controlerP = me.application.getController('Medicamento');
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, function(){
			if(controlerP.getList()){
				controlerP.getList().store.load();
				controlerP.getStoresDependes();
			}
		}, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterSaida_ProdutosWin');
    	if(!win) win = Ext.widget('filtersaida_produtoswin');
    	win.show();
    }

});
