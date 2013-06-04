/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Medico', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Medico',

	refs: [
        {
        	ref: 'list',
        	selector: 'medicolist'
        },
        {
        	ref: 'form',
        	selector: 'addmedicowin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'medicolist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtermedicowin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtermedicowin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addmedicowin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelCombo',
		'ModelMedico'
	],
	stores: [
		'StoreComboEspecialidades',
		'StoreComboEstados',
		'StoreComboCidades',
		'StoreComboMedico',
		'StoreMedico'		
	],
	
    views: [
        'medico.List',
        'medico.Filtro',
        'medico.Edit'
    ],

    init: function(application) {
    	this.control({
    		'medicolist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'medicolist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'medicolist button[action=adicionar]': {
                click: this.add
            },
            'medicolist button[action=editar]': {
                click: this.btedit
            },
            'medicolist button[action=deletar]': {
                click: this.btdel
            },
            
            'medicolist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
			
            'addmedicowin button[action=salvar]': {
                click: this.update
            },
            'addmedicowin button[action=resetar]': {
                click: this.reset
            },
            'addmedicowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addmedicowin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addmedicowin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
			'addmedicowin form fieldcontainer combobox[name=uf_id]': {
                change: this.loadCidade
            },
			
			'filtermedicowin form fieldcontainer combobox[name=uf_id]': {
                change: this.loadCidade
            },
            'filtermedicowin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtermedicowin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtermedicowin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtermedicowin': {
                show: this.filterSetFields
            }
        });
    },
   
	loadCidade: function(combo){
		if(!combo.store.getById(combo.getValue())){
			return true;
		}
		
		if(this.getForm()){
			var comboCidade = Ext.getCmp('cidade_id_medico');
		}
		else{
			var comboCidade = Ext.getCmp('cidade_id_filter_medico');
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
		window.open('server/modulos/medico/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddMedicoWin');
        if(!win) win = Ext.widget('addmedicowin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Medico');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/medico/list.php');
	    Ext.getCmp('action_medico').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'medico', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('medico')+'?', function(btn){
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
		var win = Ext.getCmp('AddMedicoWin');
        if(!win) win = Ext.widget('addmedicowin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterMedicoWin');
    	if(!win) win = Ext.widget('filtermedicowin');
    	win.show();
    }

});
