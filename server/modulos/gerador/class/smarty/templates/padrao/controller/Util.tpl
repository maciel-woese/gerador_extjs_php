Ext.define('{$app|capitalize}.controller.Util', {
	mixins: {
        observable: 'Ext.util.Observable'
    },
	
    titleErro: '{$error}',
    avisoText: '{$aviso}',
    saveFormText: '{$aguarde}',
    delGridText: '{$delete_aguarde}',
    delErroGrid: '{$select_delete}',
    editErroGrid: '{$select_edit}',
    loadingGridText: '{$store_load_data}',
    filteredText: '{$button_filtrar} <span class="buttonFilter">*</span>',
    filterText: '{$button_filtrar}',
    connectFalhaText: '{$ajax_lost}',
    server_failure: '{$server_failure}',
    fieldsInvalidText: '{$fields_invalids}',
    requiredsFieldsText: '{$exist_fields_requireds}',
	
	clearInterval: false,
	storePai: false,
	disabledCombo: 0,
	
{if $permissoes == 'sim'}  	
	getPermissoes: function(){
		var me = this;
		var data = this.application.dados[this.tabela.toLowerCase()];
		var items = me.getList().down('toolbar').items.items;

		Ext.each(items, function(p){
			Ext.each(data, function(j){
				if(p.action && p.action==j.acao){
					p.setVisible(true);
				}
			});
		});
	},
{/if}
  	
	getStoresDependes: function(){
    	var me = this;
		if(me.storePai==true){
			me.getStore('StoreCombo'+me.id).load();
		}
    },
	
	verifyCombo: function(comp, callbackParse){
		var me = this;
		var callback = Ext.emptyFn;
		if(me.getForm()){
			var form = me.getForm(); 
		}
		else if(me.getFilterForm()){
			var form = me.getFilterForm(); 
		}
		if(comp.xtype=='combobox' && !comp.loadDisabled){
			if(me.disabledCombo==false){
				setTimeout(function(){
					if(comp.store.getCount()==0){
						form.el.mask(me.saveFormText);
					}
				},10);
				me.disabledCombo = 0;
			}
			if(comp.store.getCount()==0){
				me.disabledCombo++;
			}
			callback = function(){
				me.disabledCombo--;
				if(me.disabledCombo==0){
					if(form){
						form.el.unmask();
						setTimeout(function(){
							if(form){
								form.el.unmask();
							}
						}, 300);

						if(typeof callbackParse == 'function'){
							callbackParse();
						}
						me.disabledCombo = 0;
					}
				}
			}
		}

		return callback;
	},
	
	processInterval: function(callback, combobox){
		if(combobox){
			this.clearInterval = setInterval(function(){
				if(typeof callback === 'function'){
					callback();
				}
			},1000);
		}
		else{
			callback();
		}
	},
	
	saveForm: function(grid, form, win, button, callbackSuccess, callbackFailure){
		var me = this;
		
		if(form.getForm().isValid()){
			form.el.mask(me.saveFormText);
			button.setDisabled(true);
			form.getForm().submit({
				success: function(f, o){
					button.setDisabled(false);
					form.el.unmask();
					if(o.result){
						if(o.result.success==true){
							info(me.avisoText, o.result.msg);
							
							if(grid){
								grid.store.load();
							}
							
							if(typeof callbackSuccess == 'function'){
								callbackSuccess(o.result);
							}
							
							win.close();
							me.getStoresDependes();
						}
					}
				},
				failure: function(f, action){
					form.el.unmask();
					switch (action.failureType) {
						case Ext.form.action.Action.CLIENT_INVALID:
							info(me.titleErro, me.fieldsInvalidText);
							break;
						case Ext.form.action.Action.CONNECT_FAILURE:
							info(me.titleErro, me.connectFalhaText);
							break;
						case Ext.form.action.Action.SERVER_INVALID:
						   info(me.titleErro, action.result.msg);
				    }
					button.setDisabled(false);
				    if(typeof callbackFailure == 'function'){
						callbackFailure();
					}
				}
			});
		}
		else{
			info(me.titleErro, me.requiredsFieldsText);
		}
	},
	
	deleteAjax: function(grid, tabela, params, button, callbackSuccess){
		var me = this;
		button.setDisabled(true);
		grid.getEl().mask(me.delGridText);
		Ext.Ajax.request({
			url: 'server/modulos/'+tabela+'/delete.php',
			params: params,
			success: function(o){
				var o = Ext.decode(o.responseText);
				button.setDisabled(false);
				if(o.success===true){
					info(me.avisoText, o.msg);
					grid.store.load();
					if(typeof callbackSuccess == 'function'){
						callbackSuccess();
					}
					me.getStoresDependes();
				}
				else{
					info(me.titleErro, o.msg);
					grid.getEl().unmask();
				}
			},
			failure: function(o){
				button.setDisabled(false);
				info(me.titleErro, me.server_failure + o.status);
				grid.getEl().unmask();
			}
		});
	},
	
    getValuesForm: function(form, win, id, url, callback, combobox){
    	var me = this;
		form.el.mask(me.saveFormText);

    	Ext.Ajax.request({
    		url: url,
    		params: {
    			id: id,
    			action: 'GET_VALUES'
    		},
    		success: function(o){
    			var dados = Ext.decode(o.responseText, true);
                if(dados==null){
                	info(me.titleErro, response.responseText);
                }
                else if(dados.success==true){
                	
					me.processInterval(function(){
						if(me.disabledCombo==0){
							form.getForm().setValues(dados.dados);
							form.el.unmask();
							if(typeof callback == 'function'){
								callback();
							}
							clearInterval(me.clearInterval);
							return true;
						}
					}, combobox);
					
				}
    			else{
    				info(me.avisoText, dados.msg);

    				if(dados.logout){
    					window.location = 'login.php';
    				}
    			}
    			if(form){
    				form.el.unmask();
    			}
    		},
    		failure: function(o){
    			var dados = Ext.decode(o.responseText, true);
                if(dados==null){
                	info(me.titleErro, response.responseText);
                }
                else if(dados.logout){
    				window.location = 'login.php';
    			}

    			form.el.unmask();
    		}
    	});

    },
	
	gridLoad: function(comp){
		if(!comp.loadDisabled){
			setTimeout(function(){
				comp.store.load();
			},100);
		}
	},
	
	comboLoad: function(comp){
		var me = this;
		if(!comp.loadDisabled){
			if(typeof comp.callback === 'function'){
				comp.callback(); 
			}
			
			if(comp.store.getCount()==0){
				//comp.store.load();
				var callback = me.verifyCombo(comp);
				comp.store.load({
					callback: callback
				});
			}
		}
	},
	
	reset: function(button){
    	Ext.each(this.getForm().getForm().getFields().items, function(field){
    		if(field.isVisible()==true){
    			field.reset();
    		}
    	});
    },
	
	resetFielter: function(button){
		this.getFilterBtn().setText(this.filterText);
    	this.getList().store.proxy.extraParams = {
    		action: 'LIST'
    	};
    	this.getList().store.load();
    	this.getFilterWin().close();
	},
	
	filterSetFields: function(){
    	var p = this.getList().store.proxy.extraParams;
        if(p.action=='FILTER'){
			this.getFilterForm().getForm().setValues(p);
        }
    },
	
	setFielter: function(button){
   		var me = this;
   		var form = me.getFilterForm().getValues();
		Ext.each(me.getFilterForm().getForm().getFields().items, function(field){
    		if(field.xtype=='combobox'){
    			form[field.name+'_nome'] = field.getRawValue();
    		}
    	});
    	me.getList().store.proxy.extraParams = form;
    	me.getFilterBtn().setText(this.filteredText);
    	me.getList().store.load();
    	me.getFilterWin().close();
	},
	
	enableButton: function(comp){
		var id = comp.button_id;
		if(comp.getValue()!=null){
			Ext.getCmp(id).setVisible(true);
		}
		else{
			Ext.getCmp(id).setVisible(false);
		}
	},
	
	getAddWindow: function(button){
		this.application.getController(button.tabela).add(button);
	},
	
	resetCombo: function(button){
		var id = button.combo_id;
		Ext.getCmp(id).reset();
		button.setVisible(false);
	},
	
   	constructor: function (config) {
        this.mixins.observable.constructor.call(this, config);
    }

});

