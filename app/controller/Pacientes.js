/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Pacientes', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Pacientes',

	refs: [
        {
        	ref: 'list',
        	selector: 'pacienteslist'
        },
        {
        	ref: 'form',
        	selector: 'addpacienteswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'pacienteslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterpacienteswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterpacienteswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addpacienteswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelPacientes'
	],
	stores: [
		'StoreComboSexoPacientes',
		'StoreComboEstados',
		'StoreComboCidades',
		'StoreComboStatusPacientes',
		'StoreComboPacientes',
		'StorePacientes'		
	],
	
    views: [
        'pacientes.List',
        'pacientes.Filtro',
        'pacientes.Edit'
    ],

    init: function(application) {
    	this.control({
    		'pacienteslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'pacienteslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'pacienteslist button[action=adicionar]': {
                click: this.add
            },
            'pacienteslist button[action=editar]': {
                click: this.btedit
            },
            'pacienteslist button[action=deletar]': {
                click: this.btdel
            },
            'pacienteslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            
			'addpacienteswin button[action=salvar]': {
                click: this.update
            },
            'addpacienteswin button[action=resetar]': {
                click: this.reset
            },
            'addpacienteswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
			
			'addpacienteswin form fieldcontainer combobox[name=uf_id]': {
                change: this.loadCidade
            },
            
			'addpacienteswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addpacienteswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
			
            'filterpacienteswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
			
			'filterpacienteswin form fieldcontainer combobox[name=uf_id]': {
                change: this.loadCidade
            },
			
            'filterpacienteswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterpacienteswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterpacienteswin': {
                show: this.filterSetFields
            }
        });
    },
	
	loadCidade: function(combo){
		if(!combo.store.getById(combo.getValue())){
			return true;
		}
		if(this.getForm()){
			var comboCidade = Ext.getCmp('cidade_id_pacientes');
		}
		else{
			var comboCidade = Ext.getCmp('cidade_id_filter_pacientes');
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
		window.open('server/modulos/pacientes/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddPacientesWin');
        if(!win) win = Ext.widget('addpacienteswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Pacientes');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/pacientes/list.php');
	    Ext.getCmp('action_pacientes').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'pacientes', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('paciente')+'?', function(btn){
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
		var win = Ext.getCmp('AddPacientesWin');
        if(!win) win = Ext.widget('addpacienteswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterPacientesWin');
    	if(!win) win = Ext.widget('filterpacienteswin');
    	win.show();
    }

});
