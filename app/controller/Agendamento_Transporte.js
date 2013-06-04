/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Agendamento_Transporte', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Agendamento_Transporte',

	refs: [
        {
        	ref: 'list',
        	selector: 'agendamento_transportelist'
        },
        {
        	ref: 'form',
        	selector: 'addagendamento_transportewin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'agendamento_transportelist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filteragendamento_transportewin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filteragendamento_transportewin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addagendamento_transportewin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelAgendamento_Transporte'
	],
	stores: [
		'StoreComboUsuarios',
		'StoreComboVeiculos',
		'StoreAgendamento_Transporte'		
	],
	
    views: [
        'agendamento_transporte.List',
        'agendamento_transporte.Filtro',
        'agendamento_transporte.Edit'
    ],

    init: function(application) {
    	this.control({
    		'agendamento_transportelist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'agendamento_transportelist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'agendamento_transportelist button[action=adicionar]': {
                click: this.add
            },
            'agendamento_transportelist button[action=editar]': {
                click: this.btedit
            },
            'agendamento_transportelist button[action=deletar]': {
                click: this.btdel
            },
			'agendamento_transportelist button[action=add_pacientes]': {
                click: this.addPacientes
            },
            
            'agendamento_transportelist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addagendamento_transportewin button[action=salvar]': {
                click: this.update
            },
            'addagendamento_transportewin button[action=resetar]': {
                click: this.reset
            },
            'addagendamento_transportewin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addagendamento_transportewin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addagendamento_transportewin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filteragendamento_transportewin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filteragendamento_transportewin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filteragendamento_transportewin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filteragendamento_transportewin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			window.open('server/modulos/agendamento_transporte/pdf.php?id='+record.get('id')
			);
		}
		else{
			info(this.titleErro, this.editPDFText);
			return true;
		}
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddAgendamento_TransporteWin');
        if(!win) win = Ext.widget('addagendamento_transportewin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Agendamento de Transporte');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/agendamento_transporte/list.php');
	    Ext.getCmp('action_agendamento_transporte').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'agendamento_transporte', {
			action: 'DELETAR',
			id: record.get('id')
		}, button, false);

    },

    addPacientes: function(button) {
        var me = this;
		if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			var controllerP = me.application.getController('Pacientes_Transporte');
			var win = Ext.getCmp('Container_Pacientes_Transporte');
			if(!win){
				var win = Ext.widget('containerwin', {
					title: 'Pacientes para Transporte',
					modal: true,
					id: 'Container_Pacientes_Transporte',
					items: [
						{
							xtype: 'pacientes_transportelist',
							loadDisabled: true
						}
					]
				});
			}
			win.show();
			controllerP.getList().store.proxy.extraParams.agendamento_transporte_id = record.get('id');
			controllerP.getList().store.proxy.extraParams.lotacao = record.get('passageiros');
			controllerP.getList().store.load();
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: Agendamento de Transporte?', function(btn){
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
		var win = Ext.getCmp('AddAgendamento_TransporteWin');
        if(!win) win = Ext.widget('addagendamento_transportewin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, function(data){
			if(Ext.getCmp('action_agendamento_transporte').getValue()=='INSERIR'){
				var controllerP = me.application.getController('Pacientes_Transporte');
				var win = Ext.getCmp('Container_Pacientes_Transporte');
				if(!win){
					var win = Ext.widget('containerwin', {
						title: 'Pacientes',
						modal: true,
						id: 'Container_Pacientes_Transporte',
						items: [
							{
								xtype: 'pacientes_transportelist',
								loadDisabled: true
							}
						]
					});
				}
				win.show();
				controllerP.getList().store.proxy.extraParams.agendamento_transporte_id = data.id;
				controllerP.getList().store.proxy.extraParams.lotacao = data.passageiros;
			}
		}, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterAgendamento_TransporteWin');
    	if(!win) win = Ext.widget('filteragendamento_transportewin');
    	win.show();
    }

});
