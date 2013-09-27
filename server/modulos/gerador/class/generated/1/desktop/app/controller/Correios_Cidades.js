/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Correios_Cidades', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Correios_Cidades',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'correios_cidadeslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addcorreios_cidadeswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'correios_cidadeslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtercorreios_cidadeswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtercorreios_cidadeswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addcorreios_cidadeswin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelCorreios_Cidades'
	],
	stores: [
		'StoreComboCorreios_Cidades',
		'StoreCorreios_Cidades'		
	],
	
    views: [
        'correios_cidades.List',
        'correios_cidades.Filtro',
        'correios_cidades.Edit'
    ],

    init: function(application) {
    	this.control({
    		'correios_cidadeslist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'correios_cidadeslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'correios_cidadeslist button[action=adicionar]': {
                click: this.add
            },
            'correios_cidadeslist button[action=editar]': {
                click: this.btedit
            },
            'correios_cidadeslist button[action=deletar]': {
                click: this.btdel
            },            'addcorreios_cidadeswin button[action=salvar]': {
                click: this.update
            },
            'addcorreios_cidadeswin button[action=resetar]': {
                click: this.reset
            },
            'addcorreios_cidadeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addcorreios_cidadeswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addcorreios_cidadeswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtercorreios_cidadeswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtercorreios_cidadeswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtercorreios_cidadeswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtercorreios_cidadeswin': {
                show: this.filterSetFields
            }
        });
    },
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddCorreios_CidadesWin', 'Correios_Cidades', 'correios_cidades.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Correios_Cidades');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('id'), 'server/modulos/correios_cidades/list.php');
	        Ext.getCmp('action_correios_cidades').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'correios_cidades', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('id')+'?', function(btn){
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
        me.getDesktopWindow('Correios_Cidades', 'Correios_Cidades', 'correios_cidades.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.correios_cidades.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
