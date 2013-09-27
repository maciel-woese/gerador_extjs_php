/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Correios_Bairros', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Correios_Bairros',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'correios_bairroslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addcorreios_bairroswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'correios_bairroslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtercorreios_bairroswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtercorreios_bairroswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addcorreios_bairroswin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelCorreios_Bairros'
	],
	stores: [
		'StoreComboCorreios_Bairros',
		'StoreCorreios_Bairros'		
	],
	
    views: [
        'correios_bairros.List',
        'correios_bairros.Filtro',
        'correios_bairros.Edit'
    ],

    init: function(application) {
    	this.control({
    		'correios_bairroslist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'correios_bairroslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'correios_bairroslist button[action=adicionar]': {
                click: this.add
            },
            'correios_bairroslist button[action=editar]': {
                click: this.btedit
            },
            'correios_bairroslist button[action=deletar]': {
                click: this.btdel
            },            'addcorreios_bairroswin button[action=salvar]': {
                click: this.update
            },
            'addcorreios_bairroswin button[action=resetar]': {
                click: this.reset
            },
            'addcorreios_bairroswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addcorreios_bairroswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addcorreios_bairroswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtercorreios_bairroswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtercorreios_bairroswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtercorreios_bairroswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtercorreios_bairroswin': {
                show: this.filterSetFields
            }
        });
    },
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddCorreios_BairrosWin', 'Correios_Bairros', 'correios_bairros.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Correios_Bairros');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('id'), 'server/modulos/correios_bairros/list.php');
	        Ext.getCmp('action_correios_bairros').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'correios_bairros', {
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
        me.getDesktopWindow('Correios_Bairros', 'Correios_Bairros', 'correios_bairros.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.correios_bairros.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
