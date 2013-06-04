/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Agendamento_Exame', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Agendamento_Exame',

	refs: [
        {
        	ref: 'list',
        	selector: 'agendamento_examelist'
        },
        {
        	ref: 'form',
        	selector: 'addagendamento_examewin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'agendamento_examelist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filteragendamento_examewin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filteragendamento_examewin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addagendamento_examewin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelAgendamento_Exame'
	],
	stores: [
		'StoreComboUsuarios',
		'StoreComboPacientes',
		'StoreAgendamento_Exame'		
	],
	
    views: [
        'agendamento_exame.List',
        'agendamento_exame.Filtro',
        'agendamento_exame.Edit'
    ],

    init: function(application) {
    	this.control({
    		'agendamento_examelist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'agendamento_examelist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'agendamento_examelist button[action=adicionar]': {
                click: this.add
            },
            'agendamento_examelist button[action=editar]': {
                click: this.btedit
            },
            'agendamento_examelist button[action=deletar]': {
                click: this.btdel
            },
            
            'agendamento_examelist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addagendamento_examewin button[action=salvar]': {
                click: this.update
            },
            'addagendamento_examewin button[action=resetar]': {
                click: this.reset
            },
            'addagendamento_examewin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addagendamento_examewin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addagendamento_examewin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filteragendamento_examewin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filteragendamento_examewin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filteragendamento_examewin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filteragendamento_examewin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/agendamento_exame/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddAgendamento_ExameWin');
        if(!win) win = Ext.widget('addagendamento_examewin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Agendamento de Exame');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/agendamento_exame/list.php');
	    Ext.getCmp('action_agendamento_exame').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'agendamento_exame', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: o Agendamento?', function(btn){
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
		var win = Ext.getCmp('AddAgendamento_ExameWin');
        if(!win) win = Ext.widget('addagendamento_examewin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterAgendamento_ExameWin');
    	if(!win) win = Ext.widget('filteragendamento_examewin');
    	win.show();
    }

});
