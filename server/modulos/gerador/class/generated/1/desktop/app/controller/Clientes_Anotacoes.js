/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Clientes_Anotacoes', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Clientes_Anotacoes',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'clientes_anotacoeslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addclientes_anotacoeswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'clientes_anotacoeslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterclientes_anotacoeswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterclientes_anotacoeswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addclientes_anotacoeswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelClientes_Anotacoes'
	],
	stores: [
		'StoreComboClientes',
		'StoreClientes_Anotacoes'		
	],
	
    views: [
        'clientes_anotacoes.List',
        'clientes_anotacoes.Filtro',
        'clientes_anotacoes.Edit'
    ],

    init: function(application) {
    	this.control({
    		'clientes_anotacoeslist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'clientes_anotacoeslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'clientes_anotacoeslist button[action=adicionar]': {
                click: this.add
            },
            'clientes_anotacoeslist button[action=editar]': {
                click: this.btedit
            },
            'clientes_anotacoeslist button[action=deletar]': {
                click: this.btdel
            },            
            'clientes_anotacoeslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addclientes_anotacoeswin button[action=salvar]': {
                click: this.update
            },
            'addclientes_anotacoeswin button[action=resetar]': {
                click: this.reset
            },
            'addclientes_anotacoeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addclientes_anotacoeswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addclientes_anotacoeswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterclientes_anotacoeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterclientes_anotacoeswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterclientes_anotacoeswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterclientes_anotacoeswin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/clientes_anotacoes/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddClientes_AnotacoesWin', 'Clientes_Anotacoes', 'clientes_anotacoes.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Clientes_Anotacoes');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('controle'), 'server/modulos/clientes_anotacoes/list.php');
	        Ext.getCmp('action_clientes_anotacoes').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'clientes_anotacoes', {
			action: 'DELETAR',
			id: record.get('controle')
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('controle')+'?', function(btn){
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
        me.getDesktopWindow('Clientes_Anotacoes', 'Clientes_Anotacoes', 'clientes_anotacoes.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.clientes_anotacoes.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
