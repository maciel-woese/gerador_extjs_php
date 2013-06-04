/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Veiculos', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Veiculos',

	refs: [
        {
        	ref: 'list',
        	selector: 'veiculoslist'
        },
        {
        	ref: 'form',
        	selector: 'addveiculoswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'veiculoslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterveiculoswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterveiculoswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addveiculoswin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelVeiculos'
	],
	stores: [
		'StoreComboVeiculos',
		'StoreVeiculos'		
	],
	
    views: [
        'veiculos.List',
        'veiculos.Filtro',
        'veiculos.Edit'
    ],

    init: function(application) {
    	this.control({
    		'veiculoslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'veiculoslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'veiculoslist button[action=adicionar]': {
                click: this.add
            },
            'veiculoslist button[action=editar]': {
                click: this.btedit
            },
            'veiculoslist button[action=deletar]': {
                click: this.btdel
            },
            
            'veiculoslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addveiculoswin button[action=salvar]': {
                click: this.update
            },
            'addveiculoswin button[action=resetar]': {
                click: this.reset
            },
            'addveiculoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addveiculoswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addveiculoswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterveiculoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterveiculoswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterveiculoswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterveiculoswin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/veiculos/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddVeiculosWin');
        if(!win) win = Ext.widget('addveiculoswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Veiculos');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/veiculos/list.php');
	    Ext.getCmp('action_veiculos').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'veiculos', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('veiculo')+'?', function(btn){
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
		var win = Ext.getCmp('AddVeiculosWin');
        if(!win) win = Ext.widget('addveiculoswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterVeiculosWin');
    	if(!win) win = Ext.widget('filterveiculoswin');
    	win.show();
    }

});
