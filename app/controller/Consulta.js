/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Consulta', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Consulta',

	refs: [
        {
        	ref: 'list',
        	selector: 'consultalist'
        },
        {
        	ref: 'form',
        	selector: 'addconsultawin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'consultalist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterconsultawin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterconsultawin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addconsultawin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelConsulta'
	],
	stores: [
		'StoreComboFaltouConsulta',
		'StoreComboMedico',
		'StoreComboPacientes',
		'StoreConsulta'		
	],
	
    views: [
        'consulta.List',
        'consulta.Filtro',
        'consulta.Baixa_Consulta',
        'consulta.Edit'
    ],

    init: function(application) {
    	this.control({
    		'consultalist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
				beforerender: this.removeFilterDay,
                render: this.gridLoad
            },
            'consultalist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'consultalist button[action=adicionar]': {
                click: this.add
            },
            'consultalist button[action=editar]': {
                click: this.btedit
            },
            'consultalist button[action=deletar]': {
                click: this.btdel
            },
			'consultalist button[action=filtrar_apenas_dia]': {
                toggle: this.btFilterDay
            },
			'consultalist button[action=baixa_consulta]': {
                click: this.baixaConsulta
            },
            
            'consultalist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addconsultawin button[action=salvar]': {
                click: this.update
            },
            'addconsultawin button[action=resetar]': {
                click: this.reset
            },
            
			'addbaixaconsultawin form fieldcontainer combobox': {
				render: this.comboLoadBaixa
            },
			'addbaixaconsultawin button[action=salvar]': {
                click: this.update
            },
			
			'addconsultawin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addconsultawin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addconsultawin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterconsultawin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterconsultawin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterconsultawin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterconsultawin': {
                show: this.filterSetFields
            }
        });
    },
	
	comboLoadBaixa: function(comp){
		var me = this;
		if(!comp.loadDisabled){
			if(typeof comp.callback === 'function'){
				comp.callback(); 
			}
			var callback = me.verifyCombo(comp, false, Ext.getCmp('FormConsulta'));
			comp.store.load({
				callback: callback
			});
		}
	},
	
	baixaConsulta: function(button){
		var me = this;
		if (me.getList().selModel.hasSelection()) {
			var record = me.getList().getSelectionModel().getLastSelected();
			var win = Ext.getCmp('AddBaixaConsultaWin');
			if(!win) win = Ext.widget('addbaixaconsultawin');
			win.show();
			
			me.getValuesForm(Ext.getCmp('FormConsulta'), win, record.get('id'), 'server/modulos/consulta/list.php');
			Ext.getCmp('action_consulta').setValue('BAIXA_CONSULTA');
		}
		else{
			info(me.titleErro, me.editErroGrid);
			return true;
		}
	},
	
	removeFilterDay: function(comp){
		var me = this;
		me.getList().store.proxy.extraParams.data_hora = "";
	},
	
	resetFielter: function(button){
		this.getFilterBtn().setText(this.filterText);
    	this.getList().store.proxy.extraParams = {
    		action: 'LIST',
			data_hora: me.getList().store.proxy.extraParams.data_hora
    	};
    	this.getList().store.load();
    	this.getFilterWin().close();
	},
	
	setFielter: function(button){
   		var me = this;
   		var form = me.getFilterForm().getValues();
		form.data_hora = me.getList().store.proxy.extraParams.data_hora;
    	me.getList().store.proxy.extraParams = form;
    	me.getFilterBtn().setText(this.filteredText);
    	me.getList().store.load();
    	me.getFilterWin().close();
	},
	
	btFilterDay: function(button, pressed){
		var me = this;
		if(pressed==true){
			me.getList().store.proxy.extraParams.data_hora = Ext.util.Format.date(new Date(), "Y-m-d");
		}
		else{
			me.getList().store.proxy.extraParams.data_hora = "";
		}
		me.getList().store.load();
	},
	
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/consulta/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddConsultaWin');
        if(!win) win = Ext.widget('addconsultawin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Consulta');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/consulta/list.php');
	    Ext.getCmp('action_consulta').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'consulta', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: a Consulta?', function(btn){
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
		var win = Ext.getCmp('AddConsultaWin');
        if(!win) win = Ext.widget('addconsultawin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		if(Ext.getCmp('AddBaixaConsultaWin')){
			var win = Ext.getCmp('AddBaixaConsultaWin');
		}
		else{
			var win = Ext.getCmp('AddConsultaWin');
		}
		me.saveForm(me.getList(), Ext.getCmp('FormConsulta'), win, button, function(response){
			if(Ext.getCmp('FormConsulta').getValues().action=='INSERIR'){
				Ext.Msg.alert('Senha...', 'A Senha do Paciente &Eacute;: <b>'+response.senha+'</b>');
			}
		}, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterConsultaWin');
    	if(!win) win = Ext.widget('filterconsultawin');
    	win.show();
    }

});
