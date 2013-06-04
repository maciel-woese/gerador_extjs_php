/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Entrada_Produtos', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Entrada_Produtos',

	refs: [
        {
        	ref: 'list',
        	selector: 'entrada_produtoslist'
        },
        {
        	ref: 'form',
        	selector: 'addentrada_produtoswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'entrada_produtoslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterentrada_produtoswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterentrada_produtoswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addentrada_produtoswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelEntrada_Produtos'
	],
	stores: [
		'StoreComboEntrada_Medicamento',
		'StoreComboMedicamento',
		'StoreEntrada_Produtos'		
	],
	
    views: [
        'entrada_produtos.List',
        'entrada_produtos.Filtro',
        'entrada_produtos.Edit'
    ],

    init: function(application) {
    	this.control({
    		'entrada_produtoslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'entrada_produtoslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'entrada_produtoslist button[action=adicionar]': {
                click: this.add
            },
            'entrada_produtoslist button[action=editar]': {
                click: this.btedit
            },
            'entrada_produtoslist button[action=deletar]': {
                click: this.btdel
            },
            
            'entrada_produtoslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addentrada_produtoswin': {
                show: this.getEntradaId
            },
			'addentrada_produtoswin button[action=salvar]': {
                click: this.update
            },
            'addentrada_produtoswin button[action=resetar]': {
                click: this.reset
            },
            'addentrada_produtoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addentrada_produtoswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addentrada_produtoswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterentrada_produtoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterentrada_produtoswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterentrada_produtoswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterentrada_produtoswin': {
                show: this.filterSetFields
            }
        });
    },
	
	getEntradaId: function(comp){
		var id = this.getList().store.proxy.extraParams.entrada_id;
		Ext.getCmp('entrada_id_entrada_produtos').setValue(id);
	},
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/entrada_produtos/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddEntrada_ProdutosWin');
        if(!win) win = Ext.widget('addentrada_produtoswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Entrada de Medicamentos');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/entrada_produtos/list.php');
	    Ext.getCmp('action_entrada_produtos').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'entrada_produtos', {
			action: 'DELETAR',
			id: record.get('id'),
			medicamento_id: record.get('medicamento_id'),
			quantidade: record.get('quantidade')
		}, button, function(){
			if(Ext.getCmp('GridMedicamento')){
				Ext.getCmp('GridMedicamento').store.load();
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
		var win = Ext.getCmp('AddEntrada_ProdutosWin');
        if(!win) win = Ext.widget('addentrada_produtoswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, function(){
			if(Ext.getCmp('GridMedicamento')){
				Ext.getCmp('GridMedicamento').store.load();
			}
		}, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterEntrada_ProdutosWin');
    	if(!win) win = Ext.widget('filterentrada_produtoswin');
    	win.show();
    }

});
