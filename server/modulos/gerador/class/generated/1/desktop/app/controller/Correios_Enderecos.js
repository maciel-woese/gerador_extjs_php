/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.controller.Correios_Enderecos', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },

	tabela: 'Correios_Enderecos',
	
	refs: [
        {
        	ref: 'list',
        	selector: 'correios_enderecoslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addcorreios_enderecoswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'correios_enderecoslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filtercorreios_enderecoswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filtercorreios_enderecoswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addcorreios_enderecoswin'
        }
    ],
	
    models: [
		'ModelCorreios_Enderecos'
	],
	stores: [
		'StoreCorreios_Enderecos'		
	],
	
    views: [
        'correios_enderecos.List',
        'correios_enderecos.Filtro',
        'correios_enderecos.Edit'
    ],

    init: function(application) {
    	this.control({
    		'correios_enderecoslist gridpanel': {                 
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'correios_enderecoslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'correios_enderecoslist button[action=adicionar]': {
                click: this.add
            },
            'correios_enderecoslist button[action=editar]': {
                click: this.btedit
            },
            'correios_enderecoslist button[action=deletar]': {
                click: this.btdel
            },            'addcorreios_enderecoswin button[action=salvar]': {
                click: this.update
            },
            'addcorreios_enderecoswin button[action=resetar]': {
                click: this.reset
            },
            'addcorreios_enderecoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addcorreios_enderecoswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addcorreios_enderecoswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filtercorreios_enderecoswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filtercorreios_enderecoswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filtercorreios_enderecoswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filtercorreios_enderecoswin': {
                show: this.filterSetFields
            }
        });
    },
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddCorreios_EnderecosWin', 'Correios_Enderecos', 'correios_enderecos.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Correios_Enderecos');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('id'), 'server/modulos/correios_enderecos/list.php');
	        Ext.getCmp('action_correios_enderecos').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'correios_enderecos', {
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
        me.getDesktopWindow('Correios_Enderecos', 'Correios_Enderecos', 'correios_enderecos.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('ShSolutions.view.correios_enderecos.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
