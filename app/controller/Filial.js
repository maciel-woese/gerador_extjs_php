/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Filial', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Filial',

	refs: [
        {
        	ref: 'list',
        	selector: 'filiallist'
        },
        {
        	ref: 'form',
        	selector: 'addfilialwin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'filiallist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterfilialwin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterfilialwin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addfilialwin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelFilial'
	],
	stores: [
		'StoreComboEstados',
		'StoreComboCidades',
		'StoreComboFilial',
		'StoreFilial'		
	],
	
    views: [
        'filial.List',
        'filial.Filtro',
        'filial.Edit'
    ],

    init: function(application) {
    	this.control({
    		'filiallist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'filiallist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'filiallist button[action=adicionar]': {
                click: this.add
            },
            'filiallist button[action=editar]': {
                click: this.btedit
            },
            'filiallist button[action=deletar]': {
                click: this.btdel
            },
            
            'filiallist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
			
            'addfilialwin button[action=salvar]': {
                click: this.update
            },
            'addfilialwin button[action=resetar]': {
                click: this.reset
            },
            'addfilialwin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addfilialwin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addfilialwin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
			'addfilialwin form fieldcontainer combobox[name=uf_id]': {
                change: this.loadCidade
            },
			
			'filterfilialwin form fieldcontainer combobox[name=uf_id]': {
                change: this.loadCidade
            },
            'filterfilialwin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterfilialwin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterfilialwin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterfilialwin': {
                show: this.filterSetFields
            }
        });
    },
   
	loadCidade: function(combo){
		if(!combo.store.getById(combo.getValue())){
			return true;
		}
		
		if(this.getForm()){
			var comboCidade = Ext.getCmp('cidade_id_filial');
		}
		else{
			var comboCidade = Ext.getCmp('cidade_id_filter_filial');
		}
		if(comboCidade.isDisabled()){
			comboCidade.setDisabled(false);
		}
		comboCidade.store.load({
			params: {
				estado_id: combo.getValue()
			}
		});
	},
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/filial/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddFilialWin');
        if(!win) win = Ext.widget('addfilialwin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Filial');
		
		Ext.getCmp('email_filial').setDisabled(true);
		Ext.getCmp('login_filial').setDisabled(true);
		Ext.getCmp('senha_filial').setDisabled(true);
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/filial/list.php');
	    Ext.getCmp('action_filial').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'filial', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('filial')+'?', function(btn){
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
		var win = Ext.getCmp('AddFilialWin');
        if(!win) win = Ext.widget('addfilialwin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterFilialWin');
    	if(!win) win = Ext.widget('filterfilialwin');
    	win.show();
    }

});
