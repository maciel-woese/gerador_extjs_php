Ext.define('ShSolutions.controller.Util', {
	mixins: {
        observable: 'Ext.util.Observable'
    },
	
	chartTitle: 'Numero de Apps Geradas',
	version_principal: 'Adiquira a Vers&atilde;o Principal para Exportar! <br> Entre em Contato: macielcr7@gmail.com',
	
	information_ls: '1 <b>Lista:</b> Lista de M&oacute;dulos em formato de Lista <b>(padr&atilde;o)</b>.<br>'+
					'2 <b>&Iacute;cone:</b> Lista de M&oacute;dulos em formato de &Iacute;cones <b>(Desktop)</b>.',
			
	information_pu: '<b>Sim</b> para Gerar <br> 1 - Autentica&ccedil;&atilde;o de Usu&aacute;rios <br>2 - '+ 
					'Permiss&otilde;es de M&oacute;dulos. <br><br> Ser&aacute; Preciso <b>Inserir Algumas Tabelas na Base</b>,'+
					'<br> Que est&aacute; no arquivo <b>Sql.sql</b> na raiz do Sistema',
					
	load_prepare_app: 'Aguarde.. Preparando App Gerada...',
	require_modulos: '&Eacute; Necess&aacute;rio Adicionar alguns M&oacute;dulos no Banco!',
	error_no: "Erro Inesperado!",
	
	generate_app: 'Gerando App...',
	prepare_dados: "Preparando Dados...",
	error_tabela: 'Erro na tabela',
	no_table_ref: ' est&aacute; faltando a ref. Tabela!',
	no_value_ref: ' est&aacute; faltando a ref. Valor!',
	no_label_ref: ' est&aacute; faltando a ref. Label!',
	require_gerar_crud: '&Eacute; Preciso Selecionar os Registros para gerar Crud!',
	no_sync: 'N&atilde;o Existe o Arquivo de Sicroniza&ccedil;&atilde;o no Servidor!',
	
    titleErro: 'Erro!',
    avisoText: 'Aviso',
    falhaServer: 'Falha no Servidor Codigo de erro: ',
    exportarText: 'Selecione um Registro para Exportar!',
	
    saveFormText: 'Aguarde...',
    delGridText: 'Deletando, Aguarde...',
    delErroGrid: 'Selecione um Registro para Deletar!',
    editErroGrid: 'Selecione um Registro para Editar!',
    loadingGridText: 'Aguarde Carregando Dados...',
    filteredText: 'Filtrar <span class="buttonFilter">*</span>',
    filterText: 'Filtrar',
    connectFalhaText: 'Comunica&ccedil;&atilde;o Ajax Perdida',
    fieldsInvalidText: 'Campos com valores inv&aacute;lidos',
    requiredsFieldsText: 'Existem campos em Branco...',
    
	disabledCombo: 0,
	clearInterval: false,
	
	gridLoad: function(comp){
		if(!comp.loadDisabled){
			setTimeout(function(){
				comp.store.load();
			},10);
		}
	},
	
	comboLoad: function(comp){
		if(!comp.loadDisabled){
			if(comp.store.getCount()==0){
				comp.store.load();
			}
		}
	},
	
	resetCombo: function(button){
		var id = button.combo_id;
		Ext.getCmp(id).reset();
		button.setVisible(false);
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
	
	verifyCombo: function(comp, callbackParse){
		var me = this;
		var callback = Ext.emptyFn;
		if(comp.xtype=='combobox'){
			if(me.disabledCombo==0){
				me.getForm().el.mask('Aguarde...');
				setTimeout(function(){
					me.getForm().el.mask('Aguarde...');
				},10);
			}
			me.disabledCombo++;
			callback = function(){
				me.disabledCombo--;
				if(me.disabledCombo==0){
					if(me.getForm()){
						me.getForm().el.unmask();
						
						if(typeof callbackParse == 'function'){
							callbackParse();
						}
					}
				}
			}
		}
		return callback;
	},
	
	verifyComboCustom: function(form, comp, callbackParse){
		var me = this;
		var callback = Ext.emptyFn;
		if(comp.xtype=='combobox'){
			if(me.disabledCombo==0){
				form.el.mask('Aguarde...');
				setTimeout(function(){
					form.el.mask('Aguarde...');
				},10);
			}
			me.disabledCombo++;
			callback = function(){
				me.disabledCombo--;
				if(me.disabledCombo==0){
					if(form){
						form.el.unmask();
						
						if(typeof callbackParse == 'function'){
							callbackParse();
						}
					}
				}
			}
		}
		return callback;
	},
	
	getValuesForm: function(tabela, record, callback, combobox){
		var me = this;
		window.rec = record;
		me.getForm().el.mask('Aguarde...');
		if(!combobox){
			me.getForm().getForm().setValues(record.data);
			me.getForm().el.unmask();
			if(typeof callback == 'function'){
				callback();
			}
			return true;
		}
		
		me.clearInterval = setInterval(function(){
			if(me.disabledCombo==0){
				me.getForm().getForm().setValues(record.data);
				me.getForm().el.unmask();
				if(typeof callback == 'function'){
					callback();
				}
				clearInterval(me.clearInterval);
				return true;
			}
		},1000);
		
		if(me.disabledCombo==0){
			me.getForm().getForm().setValues(record.data);
			me.getForm().el.unmask();
			if(typeof callback == 'function'){
				callback();
			}
			clearInterval(me.clearInterval);
			return true;
		}
	},
	
	getValuesFormCustom: function(form, record, callback, combobox){
		var me = this;
		form.el.mask('Aguarde...');
		if(!combobox){
			if(record!=false){
				form.getForm().setValues(record.data);
			}
			form.el.unmask();
			if(typeof callback == 'function'){
				callback();
			}
			return true;
		}
		
		me.clearInterval = setInterval(function(){
			if(me.disabledCombo==0){
				if(record!=false){
					form.getForm().setValues(record.data);
				}
				form.el.unmask();
				if(typeof callback == 'function'){
					callback();
				}
				clearInterval(me.clearInterval);
				return true;
			}
			else{
				clearInterval(me.clearInterval);
			}
		},1000);
		
		if(me.disabledCombo==0){
			if(record!=false){
				form.getForm().setValues(record.data);
			}
			form.el.unmask();
			if(typeof callback == 'function'){
				callback();
			}
			clearInterval(me.clearInterval);
			return true;
		}
		else{
			clearInterval(me.clearInterval);
		}
	},
	
	saveForm: function(button, callbackSuccess, callbackFailure){
		var me = this;
		if(me.getForm().getForm().isValid()){
			button.setDisabled(true);
			me.getForm().el.mask('Aguarde...');
			me.getForm().getForm().submit({
				success: function(f, o){
					button.setDisabled(false);
					me.getForm().el.unmask();
					if(o.result){
						if(o.result.success==true){
							info('Aviso!', o.result.msg);
							
							if(typeof me.getList == 'function'){
								if(me.getList() && !me.getList().loadDisabled){
									me.getList().store.load();
								}
							}
							
							if(typeof callbackSuccess == 'function'){
								callbackSuccess(o.result);
							}
							me.getAddWin().close();
							
						}
					}
				},
				failure: function(f, action){
					switch (action.failureType) {
						case Ext.form.action.Action.CLIENT_INVALID:
							info('Falha', 'Campos com valores inv&aacute;lidos');
							break;
						case Ext.form.action.Action.CONNECT_FAILURE:
							info('Falha', 'Comunicação Ajax Perdida');
							break;
						case Ext.form.action.Action.SERVER_INVALID:
						   info('Falha', action.result.msg);
				    }
					me.getForm().el.unmask();
					button.setDisabled(false);
				    if(typeof callbackFailure == 'function'){
						callbackFailure();
					}
				}
			});
		}
		else{
			info('Erro!', 'Existem campos obrigat&oacute;rios...');
		}
	},
	
	saveFormCustom: function(form, grid, win, button, callbackSuccess){
		var me = this;
		if(form.getForm().isValid()){
			button.setDisabled(true);
			form.el.mask('Aguarde...');
			form.getForm().submit({
				success: function(f, o){
					button.setDisabled(false);
					form.el.unmask();
					if(o.result){
						if(o.result.success==true){
							info('Aviso!', o.result.msg);
							if(grid && !grid.loadDisabled){
								grid.store.load();
							}
							win.close();
							
							if(typeof callbackSuccess == 'function'){
								callbackSuccess(o.result);
							}
						}
					}
				},
				failure: function(f, action){
					form.el.unmask();
					switch (action.failureType) {
						case Ext.form.action.Action.CLIENT_INVALID:
							info('Falha', 'Campos com valores inválidos');
							break;
						case Ext.form.action.Action.CONNECT_FAILURE:
							info('Falha', 'Comunicação Ajax Perdida');
							break;
						case Ext.form.action.Action.SERVER_INVALID:
						   info('Falha', action.result.msg);
				    }
					button.setDisabled(false);
				    if(typeof callbackFailure == 'function'){
						callbackFailure();
					}
				}
			});
		}
		else{
			info('Erro!', 'Existem campos obrigatórios...');
		}
	},
	
	deleteAjax: function(tabela, params, button, callbackSuccess){
		var me = this;
		tabela = tabela.toLowerCase();
		button.setDisabled(true);
		Ext.Ajax.request({
			url: 'server/modulos/'+tabela+'/delete.php',
			params: params,
			success: function(o){
				var o = Ext.decode(o.responseText);
				button.setDisabled(false);
				if(o.success===true){
					info('Aviso', o.msg);
					me.getList().store.load();
					if(typeof callbackSuccess == 'function'){
						callbackSuccess();
					}
				}
				else{
					info('Aviso', o.msg);
				}
			},
			failure: function(o){
				button.setDisabled(false);
				info('Erro!', 'Falha no Servidor Codigo de erro: ' + o.status);
				console.info(o);
			}
		});
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
    	me.getList().store.proxy.extraParams = form;
    	me.getFilterBtn().setText(this.filteredText);
    	me.getList().store.load();
    	me.getFilterWin().close();
	},
	
   	constructor: function (config) {
        this.mixins.observable.constructor.call(this, config);
    }

});

