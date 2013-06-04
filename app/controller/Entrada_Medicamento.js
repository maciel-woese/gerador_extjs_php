/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Entrada_Medicamento', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Entrada_Medicamento',

	refs: [
        {
        	ref: 'list',
        	selector: 'entrada_medicamentolist'
        },
        {
        	ref: 'form',
        	selector: 'addentrada_medicamentowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'entrada_medicamentolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterentrada_medicamentowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterentrada_medicamentowin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addentrada_medicamentowin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelEntrada_Medicamento'
	],
	stores: [
		'StoreComboUsuarios',
		'StoreComboFornecedor',
		'StoreComboEntrada_Medicamento',
		'StoreEntrada_Medicamento'		
	],
	
    views: [
        'entrada_medicamento.List',
        'entrada_medicamento.Filtro',
        'entrada_medicamento.Edit'
    ],

    init: function(application) {
    	this.control({
    		'entrada_medicamentolist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'entrada_medicamentolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'entrada_medicamentolist button[action=adicionar]': {
                click: this.add
            },
            'entrada_medicamentolist button[action=editar]': {
                click: this.btedit
            },
            'entrada_medicamentolist button[action=deletar]': {
                click: this.btdel
            },
			'entrada_medicamentolist button[action=adicionar_itens]': {
                click: this.btAddItens
            },
            'entrada_medicamentolist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addentrada_medicamentowin button[action=salvar]': {
                click: this.update
            },
            'addentrada_medicamentowin button[action=resetar]': {
                click: this.reset
            },
            'addentrada_medicamentowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addentrada_medicamentowin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addentrada_medicamentowin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterentrada_medicamentowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterentrada_medicamentowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterentrada_medicamentowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterentrada_medicamentowin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			window.open('server/modulos/entrada_medicamento/pdf.php?id='+record.get('id')
			);
		}
		else{
			info(this.titleErro, this.editPDFText);
			return true;
		}
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddEntrada_MedicamentoWin');
        if(!win) win = Ext.widget('addentrada_medicamentowin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Entrada de Medicamento');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/entrada_medicamento/list.php');
	    Ext.getCmp('action_entrada_medicamento').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'entrada_medicamento', {
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
	
    btAddItens: function(button) {
		var me = this;
        if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			var controllerP = me.application.getController('Entrada_Produtos');
			var win = Ext.getCmp('Container_Entrada_Produtos');
			if(!win){
				var win = Ext.widget('containerwin', {
					title: 'Entrada de Itens',
					modal: true,
					id: 'Container_Entrada_Produtos',
					items: [
						{
							xtype: 'entrada_produtoslist',
							loadDisabled: true
						}
					]
				});
			}
			win.show();
			controllerP.getList().store.proxy.extraParams.entrada_id = record.get('id');
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: a Entrada?', function(btn){
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
		var win = Ext.getCmp('AddEntrada_MedicamentoWin');
        if(!win) win = Ext.widget('addentrada_medicamentowin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, function(data){
			if(Ext.getCmp('action_entrada_medicamento').getValue()=='INSERIR'){
				var controllerP = me.application.getController('Entrada_Produtos');
				var win = Ext.getCmp('Container_Entrada_Produtos');
				if(!win){
					var win = Ext.widget('containerwin', {
						title: 'Entrada de Itens',
						modal: true,
						id: 'Container_Entrada_Produtos',
						items: [
							{
								xtype: 'entrada_produtoslist',
								loadDisabled: true
							}
						]
					});
				}
				win.show();
				controllerP.getList().store.proxy.extraParams.entrada_id = data.id;
			}
		}, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterEntrada_MedicamentoWin');
    	if(!win) win = Ext.widget('filterentrada_medicamentowin');
    	win.show();
    }

});
