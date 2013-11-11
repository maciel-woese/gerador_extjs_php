/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Clientes', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Clientes',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'clienteslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addclienteswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'clienteslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterclienteswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterclienteswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addclienteswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelClientes'
	],
	stores: [
		'StoreComboTipo_ClienteClientes',
		'StoreComboSexoClientes',
		'StoreComboClientes',
		'StoreClientes'		
	],
	
    views: [
        'clientes.List',
        'clientes.Filtro',
        'clientes.Edit'
    ],

    init: function(application) {
    	this.control({
    		'clienteslist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'clienteslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'clienteslist button[action=adicionar]': {
                click: this.add
            },
            'clienteslist button[action=editar]': {
                click: this.btedit
            },
            'clienteslist button[action=deletar]': {
                click: this.btdel
            },            
            'clienteslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addclienteswin button[action=salvar]': {
                click: this.update
            },
            'addclienteswin button[action=resetar]': {
                click: this.reset
            },
            'addclienteswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addclienteswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addclienteswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterclienteswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterclienteswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterclienteswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterclienteswin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/clientes/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddClientesWin', 'Clientes', 'clientes.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Clientes');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('cod_cliente'), 'server/modulos/clientes/list.php');
	        Ext.getCmp('action_clientes').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'clientes', {
			action: 'DELETAR',
			id: record.get('cod_cliente')
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('cod_cliente')+'?', function(btn){
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
        me.getDesktopWindow('Clientes', 'Clientes', 'clientes.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.clientes.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
