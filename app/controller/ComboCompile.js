
Ext.define('ShSolutions.controller.ComboCompile', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllercombo',

    models: [
        'ModelComboDB'
    ],
    stores: [
        'StoreCombo'
    ],
    views: [
        'AddComboWin'
    ],
	
	error: 'Erro!',
	field_blank: 'Existem Campos Em Branco...',
	select_regDel: 'Selecione um Registro para Deletar!',
	select_regEdit: 'Selecione um Registro para Editar!',
	
    init: function(application) {
        this.control({
            'addcombowin form button[action=add_grid]': {
                click: this.addGrid
            },
            'addcombowin form grid button[action=del_grid]': {
                click: this.delGrid
            },
            'addcombowin form grid button[action=edit_grid]': {
                click: this.editGrid
            },
            'addcombowin button[action=save_grid]': {
                click: this.saveGrid
            }
        });
    },

    addGrid: function() {
		var me = this;
        var v = Ext.getCmp('FormComboId').getValue();
        var l = Ext.getCmp('FormComboDescricao').getValue();
        if(v==='' || l===''){
            info(me.error, me.field_blank);
            return false;
        }
        else{
        	if(Ext.getCmp('action_grid_combo').getValue()=='EDIT'){
        		var record = Ext.getCmp("GridCombo").getSelectionModel().getLastSelected();
        		record.set('value', v);
        		record.set('label', l);
        	}
        	else{
        		var params = {
	                label: l,
	                value: v
	            };
	
	            var g = Ext.getCmp('GridCombo');
	            g.store.add(params);
        	}
        	
        	Ext.getCmp('FormComboId').reset();
            Ext.getCmp('action_grid_combo').reset();
            Ext.getCmp('FormComboDescricao').reset();
        }
    },

    delGrid: function() {
		var me = this;
        if (Ext.getCmp("GridCombo").selModel.hasSelection()) {
            var record = Ext.getCmp("GridCombo").getSelectionModel().getLastSelected();
            Ext.getCmp("GridCombo").store.remove(record);
        }
        else{
            info(me.error, me.select_regDel);
            return false;
        }
    },
    
    editGrid: function() {
		var me = this;
        if (Ext.getCmp("GridCombo").selModel.hasSelection()) {
            var record = Ext.getCmp("GridCombo").getSelectionModel().getLastSelected();
            Ext.getCmp('action_grid_combo').setValue('EDIT');
            Ext.getCmp('FormComboId').setValue(record.get('value'));
            Ext.getCmp('FormComboDescricao').setValue(record.get('label'));
        }
        else{
            info(me.error, me.select_regEdit);
            return true;
        }
    },

    saveGrid: function() {
    	var i=0;
        var valor = [];
        Ext.getCmp('GridCombo').store.each(function(rec){
            valor.push({
            	id: rec.get('value'),
            	descricao: rec.get('label'),
            });
        });
        var record = Ext.getCmp("GridGerador").store.getAt(Ext.getCmp('ColIndex').getValue());
        record.set('coluna_value_condicao', Ext.encode(valor));
        Ext.getCmp('AddComboWin').close();
    }

});
