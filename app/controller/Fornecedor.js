/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Fornecedor', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Fornecedor',

	refs: [
        {
        	ref: 'list',
        	selector: 'fornecedorlist'
        },
        {
        	ref: 'form',
        	selector: 'addfornecedorwin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'fornecedorlist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterfornecedorwin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterfornecedorwin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addfornecedorwin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelFornecedor'
	],
	stores: [
		'StoreComboFornecedor',
		'StoreFornecedor'		
	],
	
    views: [
        'fornecedor.List',
        'fornecedor.Filtro',
        'fornecedor.Edit'
    ],

    init: function(application) {
    	this.control({
    		'fornecedorlist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'fornecedorlist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'fornecedorlist button[action=adicionar]': {
                click: this.add
            },
            'fornecedorlist button[action=editar]': {
                click: this.btedit
            },
            'fornecedorlist button[action=deletar]': {
                click: this.btdel
            },
            
            'fornecedorlist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addfornecedorwin button[action=salvar]': {
                click: this.update
            },
            'addfornecedorwin button[action=resetar]': {
                click: this.reset
            },
            'addfornecedorwin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addfornecedorwin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addfornecedorwin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterfornecedorwin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterfornecedorwin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterfornecedorwin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterfornecedorwin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/fornecedor/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddFornecedorWin');
        if(!win) win = Ext.widget('addfornecedorwin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Fornecedor');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/fornecedor/list.php');
	    Ext.getCmp('action_fornecedor').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'fornecedor', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('fornecedor')+'?', function(btn){
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
		var win = Ext.getCmp('AddFornecedorWin');
        if(!win) win = Ext.widget('addfornecedorwin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterFornecedorWin');
    	if(!win) win = Ext.widget('filterfornecedorwin');
    	win.show();
    }

});
