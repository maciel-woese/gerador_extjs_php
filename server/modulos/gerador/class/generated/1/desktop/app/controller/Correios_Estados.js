/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Correios_Estados', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	storePai: true,
	tabela: 'Correios_Estados',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'correios_estadoslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addcorreios_estadoswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'correios_estadoslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtercorreios_estadoswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtercorreios_estadoswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addcorreios_estadoswin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelCorreios_Estados'
	],
	stores: [
		'StoreComboCorreios_Estados',
		'StoreCorreios_Estados'		
	],
	
    views: [
        'correios_estados.List',
        'correios_estados.Filtro',
        'correios_estados.Edit'
    ],

    init: function(application) {
    	this.control({
    		'correios_estadoslist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'correios_estadoslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'correios_estadoslist button[action=adicionar]': {
                click: this.add
            },
            'correios_estadoslist button[action=editar]': {
                click: this.btedit
            },
            'correios_estadoslist button[action=deletar]': {
                click: this.btdel
            },            'addcorreios_estadoswin button[action=salvar]': {
                click: this.update
            },
            'addcorreios_estadoswin button[action=resetar]': {
                click: this.reset
            },
            'addcorreios_estadoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addcorreios_estadoswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addcorreios_estadoswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtercorreios_estadoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtercorreios_estadoswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtercorreios_estadoswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtercorreios_estadoswin': {
                show: this.filterSetFields
            }
        });
    },
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddCorreios_EstadosWin', 'Correios_Estados', 'correios_estados.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Correios_Estados');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('id'), 'server/modulos/correios_estados/list.php');
	        Ext.getCmp('action_correios_estados').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'correios_estados', {
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
        me.getDesktopWindow('Correios_Estados', 'Correios_Estados', 'correios_estados.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.correios_estados.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
