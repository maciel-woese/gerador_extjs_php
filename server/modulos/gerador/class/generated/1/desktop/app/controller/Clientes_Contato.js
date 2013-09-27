/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Clientes_Contato', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Clientes_Contato',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'clientes_contatolist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addclientes_contatowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'clientes_contatolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterclientes_contatowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterclientes_contatowin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addclientes_contatowin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelClientes_Contato'
	],
	stores: [
		'StoreComboClientes',
		'StoreClientes_Contato'		
	],
	
    views: [
        'clientes_contato.List',
        'clientes_contato.Filtro',
        'clientes_contato.Edit'
    ],

    init: function(application) {
    	this.control({
    		'clientes_contatolist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'clientes_contatolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'clientes_contatolist button[action=adicionar]': {
                click: this.add
            },
            'clientes_contatolist button[action=editar]': {
                click: this.btedit
            },
            'clientes_contatolist button[action=deletar]': {
                click: this.btdel
            },            
            'clientes_contatolist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addclientes_contatowin button[action=salvar]': {
                click: this.update
            },
            'addclientes_contatowin button[action=resetar]': {
                click: this.reset
            },
            'addclientes_contatowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addclientes_contatowin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addclientes_contatowin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterclientes_contatowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterclientes_contatowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterclientes_contatowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterclientes_contatowin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/clientes_contato/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddClientes_ContatoWin', 'Clientes_Contato', 'clientes_contato.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Clientes_Contato');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('controle'), 'server/modulos/clientes_contato/list.php');
	        Ext.getCmp('action_clientes_contato').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'clientes_contato', {
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
        me.getDesktopWindow('Clientes_Contato', 'Clientes_Contato', 'clientes_contato.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.clientes_contato.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
