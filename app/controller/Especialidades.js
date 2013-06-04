/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Especialidades', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Especialidades',

	refs: [
        {
        	ref: 'list',
        	selector: 'especialidadeslist'
        },
        {
        	ref: 'form',
        	selector: 'addespecialidadeswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'especialidadeslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterespecialidadeswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterespecialidadeswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addespecialidadeswin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelEspecialidades'
	],
	stores: [
		'StoreComboEspecialidades',
		'StoreEspecialidades'		
	],
	
    views: [
        'especialidades.List',
        'especialidades.Filtro',
        'especialidades.Edit'
    ],

    init: function(application) {
    	this.control({
    		'especialidadeslist': {
                itemdblclick: this.edit,                
				afterrender: this.getPermissoes,				
                render: this.gridLoad
            },
            'especialidadeslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'especialidadeslist button[action=adicionar]': {
                click: this.add
            },
            'especialidadeslist button[action=editar]': {
                click: this.btedit
            },
            'especialidadeslist button[action=deletar]': {
                click: this.btdel
            },
            
            'especialidadeslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'addespecialidadeswin button[action=salvar]': {
                click: this.update
            },
            'addespecialidadeswin button[action=resetar]': {
                click: this.reset
            },
            'addespecialidadeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addespecialidadeswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addespecialidadeswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterespecialidadeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterespecialidadeswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterespecialidadeswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterespecialidadeswin': {
                show: this.filterSetFields
            }
        });
    },
   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/especialidades/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		var win = Ext.getCmp('AddEspecialidadesWin');
        if(!win) win = Ext.widget('addespecialidadeswin');
        win.show();
        win.setTitle('Edi&ccedil;&atilde;o de Especialidades');
		
    	me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/especialidades/list.php');
	    Ext.getCmp('action_especialidades').setValue('EDITAR');
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'especialidades', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('especialidade')+'?', function(btn){
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
		var win = Ext.getCmp('AddEspecialidadesWin');
        if(!win) win = Ext.widget('addespecialidadeswin');
        win.show();
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterEspecialidadesWin');
    	if(!win) win = Ext.widget('filterespecialidadeswin');
    	win.show();
    }

});
