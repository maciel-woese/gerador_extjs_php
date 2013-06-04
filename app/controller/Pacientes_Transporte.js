/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Pacientes_Transporte', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Pacientes_Transporte',

	refs: [
        {
        	ref: 'list',
        	selector: 'pacientes_transportelist'
        },
        {
        	ref: 'form',
        	selector: 'addpacientes_transportewin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'pacientes_transportelist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterpacientes_transportewin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterpacientes_transportewin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addpacientes_transportewin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelPacientes_Transporte'
	],
	stores: [
		'StoreComboPacientes',
		'StorePacientes_Transporte'		
	],
	
    views: [
        'pacientes_transporte.List',
        'pacientes_transporte.Filtro',
        'pacientes_transporte.Edit'
    ],

    init: function(application) {
    	this.control({
    		'pacientes_transportelist': {
                itemdblclick: this.edit,                
                render: this.gridLoad
            },
            'pacientes_transportelist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'pacientes_transportelist button[action=adicionar]': {
                click: this.add
            },
            'pacientes_transportelist button[action=editar]': {
                click: this.btedit
            },
            'pacientes_transportelist button[action=deletar]': {
                click: this.btdel
            },
            
            'pacientes_transportelist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
			'addpacientes_transportewin': {
                show: this.getAgendamento_TransId
            },
            'addpacientes_transportewin button[action=salvar]': {
                click: this.update
            },
            'addpacientes_transportewin button[action=resetar]': {
                click: this.reset
            },
            'addpacientes_transportewin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addpacientes_transportewin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addpacientes_transportewin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterpacientes_transportewin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterpacientes_transportewin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterpacientes_transportewin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterpacientes_transportewin': {
                show: this.filterSetFields
            }
        });
    },
   
	getAgendamento_TransId: function(){
		var id = this.getList().store.proxy.extraParams.agendamento_transporte_id;
		Ext.getCmp('agendamento_transporte_id_pacientes_transporte').setValue(id);
	},
	
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/pacientes_transporte/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddPacientes_TransporteWin');
        if(!win) win = Ext.widget('addpacientes_transportewin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Pacientes de Transporte');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/pacientes_transporte/list.php');
	    Ext.getCmp('action_pacientes_transporte').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'pacientes_transporte', {
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
		var win = Ext.getCmp('AddPacientes_TransporteWin');
        if(!win) win = Ext.widget('addpacientes_transportewin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		var qtd = parseInt(me.getList().store.proxy.extraParams.lotacao);
		var lotacao = 0;
		var no_add = false;
		var dt = me.getForm().getValues();
		
		me.getList().store.each(function(rec){
			if(dt.action=='EDITAR'){
				if(parseInt(dt.paciente_id)!=parseInt(rec.get('paciente_id'))){
					lotacao = lotacao + rec.get('acompanhado') + 1;
				}
			}
			else{
				if(parseInt(dt.paciente_id)==parseInt(rec.get('paciente_id'))){
					info('Erro!', 'Paciente J&aacute; Cadastrado!');
					no_add = true;
				}
				lotacao = lotacao + rec.get('acompanhado') + 1;
			}
		});
		
		if(no_add==true){
			return true;
		}
		
		if((qtd<=lotacao)){
			info('Erro!', 'O veiculo já está lotado!');
			return true;
		}
		
		lotacao = lotacao + 1;
		if((qtd<lotacao)){
			info('Erro!', 'O veiculo já está lotado!!');
			return true;
		}
		
		var lotacaob = lotacao + parseInt(dt.acompanhado);
		if((qtd<lotacaob)){
			var resp = parseInt(lotacaob - qtd);
			resp = parseInt(dt.acompanhado) - resp;
			
			info('Erro!', 'N&uacute;mero M&aacute;ximo de Acompanhantes &eacute; '+resp);
			return true;
		}
		
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterPacientes_TransporteWin');
    	if(!win) win = Ext.widget('filterpacientes_transportewin');
    	win.show();
    }

});
