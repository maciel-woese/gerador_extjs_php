Ext.define('ShSolutions.controller.Gerador', {
    extend: 'Ext.app.Controller',
    alias: 'controller.gerador',
    
	mixins: {
        controls: 'ShSolutions.controller.Util'
    },
	
    refs: [
       {
       		ref: 'grid',
       		selector: 'geradorlist'
       },
       {
       		ref: 'form',
       		selector: 'addgeradorwin form'
       },
       {
    	   ref: 'win',
    	   selector: 'addgeradorwin'
       },
       {
    	   ref: 'select',
    	   selector: 'selectwin'
       }
    ],
    
    moduloSql: false,
    
    models: [
        'ModelGerador',
        'ModelCombo'
    ],
    stores: [
        'StoreGerador',
        'StoreComboTabelasPDF'
    ],
    views: [
        'gerador.List',
        'gerador.Login',
        'gerador.Select',
        'gerador.Prepare'
    ],

    init: function(application) {
    	this.control({
    		'geradorlist':{
    			render: this.storeRemoveData
    		},
    		'geradorlist button[action=select_tabelas]': {
    			click: this.selectTabelas
    		},
			'geradorlist button[action=prepare_crud]': {
    			click: this.prepareCrud
    		},
    		'geradorlist button[action=sync]': {
    			click: this.syncCrud
    		},
    		'geradorlist button[action=export]': {
    			click: this.exportCrud
    		},
			'geradorlist button[action=testar]': {
    			click: this.testarCrud
    		},
    		'geradorlist button[action=login]': {
    			click: this.login
    		},
    		'addgeradorwin button[action=login_banco]': {
    			click: this.loginBanco
    		},
    		'addgeradorwin form radiogroup': {
    			change: this.banco
    		},
			'preparewin': {
            	show: this.setToolTip
            },
    		'preparewin form radiogroup': {
            	change: this.Layout
            },
            'preparewin button[action=gerar_crud]': {
            	click: this.gerarCrud
            },
			'selectwin button[action=select_now_tabelas]': {
            	click: this.selectNowTabelas
            }
    	});
    },
    	
	setToolTip: function(){
		var me = this;
		Ext.create('Ext.tip.ToolTip', {
            target: 'information_pu',
            title: 'Info.',
            html: me.information_pu,
            trackMouse: true
        });
		
		Ext.create('Ext.tip.ToolTip', {
            target: 'information_tl',
            title: 'Info.',
            html: me.information_tl,
            trackMouse: true
        });
	},
	
	selectNowTabelas: function(button){
		var array = Ext.getCmp('tabelas_select').getValue();
		var recs = [];
		Ext.getCmp('GridGerador').getSelectionModel().deselectAll();
		
		for(var i in array){
			Ext.each(Ext.getCmp('GridGerador').store.data.items, function(rec){
				if(rec.get('tabela')==array[i]){
					recs.push(rec);
				}
			});
		}
		Ext.getCmp('GridGerador').getSelectionModel().select(recs);
		Ext.getCmp('SelectWin').close(recs);
		
	},
	
	selectTabelas: function(button){
		var win = this.getSelect();
		if(!win) win = Ext.widget('selectwin');
		win.show();
		
		var t = '';
		Ext.getCmp('tabelas_select').store.removeAll();
		Ext.each(Ext.getCmp('GridGerador').store.data.items, function(rec){
    		if(rec.get('tabela')!=t){
    			Ext.getCmp('tabelas_select').store.add({
    				id: rec.get('tabela'),
    				descricao: rec.get('tabela')
    			});
    			t = rec.get('tabela');
    		}
    	});
	},
	
	exportCrud: function(button){
		var me = this;
		if((window.tipo_usuario.exportar) && window.tipo_usuario.exportar=='1'){
			window.open('server/modulos/gerador/export.php', '_blank');
		}
		else{
			Ext.Msg.alert(me.titleErro, me.version_principal);
		}
	},
	
	enviarEmail: function(msg, params){
		if(!params){
			var params = {};
		}
		var msg = Ext.encode(msg);
		var msg = msg + ' <br> ' + Ext.encode(params);
		Ext.Ajax.request({
			url: 'server/modulos/email/envia.php',
			params:{
				message: msg,
				action: 'ENVIAR',
				assunto: 'BUG'
			},
			success: function(){
				
			}
		})
	},
	
	testarCrud: function(button){
		var me = this;
		
		Ext.getCmp('GridGerador').el.mask(me.load_prepare_app);
		Ext.Ajax.request({
    	    url: 'server/modulos/gerador/prepareTeste.php',
    	    params: {
    	    	action: 'PREPARE'
    	    },
    	    success: function(response, opts){
    	        var obj = Ext.decode(response.responseText);
    	        Ext.getCmp('GridGerador').el.unmask();
    	        if(obj.success==true){
    	        	if(me.moduloSql==true){
    	    			Ext.Msg.alert(me.avisoText, me.require_modulos, function(){
    	    				window.open('server/modulos/gerador/export.php?action=SQL', 'removeOlds');
    	    				window.open('testeModulo.php', '_blank');
    	    			});
    	    		}
    	    		else{
    	    			window.open('testeModulo.php', '_blank');
    	    		}
    	        }
    	        else{
					me.enviarEmail(obj, {action: 'PREPARE'});
    	        	info(me.avisoText, me.erro_no);
    	        }
    	    },
    	    failure: function(response, opts) {
				me.enviarEmail(response, {action: 'PREPARE'});
    	    	Ext.getCmp('GridGerador').el.unmask();
    	        console.log(me.falhaServer + response.status);
    	    }
		});
	},
	
    login: function(button){
    	var win = Ext.getCmp('AddGeradorWin');
    	if(!win) win = Ext.widget('addgeradorwin');
    	win.show();
    },
    
    storeRemoveData: function(grid){
    	grid.store.removeAll();
    },
    
    banco: function(radio, value){
    	if(value.tipo=='mysql'){
    		Ext.getCmp('SchemaBanco').setDisabled(true);
    	}
    	else if(value.tipo=='pgsql'){
    		Ext.getCmp('SchemaBanco').setDisabled(false);
    	}
    },
    
    Layout: function(radio, value){
		if(value.tipo){
			if(value.tipo=='touch'){
				Ext.getCmp('tabelas_prepare').setDisabled(true);
				Ext.getCmp('touch_layout_crud_prepare').setVisible(true);
			}
			else{
				Ext.getCmp('tabelas_prepare').setDisabled(false);
				Ext.getCmp('touch_layout_crud_prepare').setVisible(false);
			}
		}
	},
	
	enableButtons: function(disabled){
		Ext.getCmp('button_prepare_crud').setDisabled(disabled);
        Ext.getCmp('button_sync_crud').setDisabled(disabled);
        Ext.getCmp('button_select_tabelas').setDisabled(disabled);
		if(disabled==true){
			Ext.getCmp('button_export_crud').setDisabled(true);
			Ext.getCmp('button_test_crud').setDisabled(true);
		}
	},
    
    loginBanco: function(button){
    	var me = this;
    	var form = Ext.getCmp('FormGerador').getForm();
        if(form.isValid()){
            Ext.getCmp('FormGerador').el.mask(me.saveFormText);

            var u = Ext.getCmp('UsuarioBanco').getValue();
            var s = Ext.getCmp('ServidorBanco').getValue();
            var d = Ext.getCmp('DatabaseBanco').getValue();
            window.Url = {};

            window.Url.usuario = u;
            window.Url.servidor = s;
            window.Url.db = d;
            window.Url.base = 'server/modulos/gerador/bkps/';

            form.submit({
            	params: {
            		action: 'LOGIN_BANCO'
            	},
                success: function(form, c){
                    if(c.result.success===true){
                        Ext.getCmp('GridGerador').store.load();
                        Ext.getCmp('AddGeradorWin').close();
                        
                        me.enableButtons(false);
                    }
                    else{
                        info(me.titleErro, c.result.msg);
                        Ext.getCmp('FormGerador').el.unmask();
                        me.enableButtons(true);
						me.enviarEmail(c, form.getValues());
                    }
                },
                failure: function(form, c){
                	Ext.getCmp('FormGerador').el.unmask();
                    info(me.titleErro, c.result.msg);
                    me.enableButtons(true);
					me.enviarEmail(c, form.getValues());
                }
            });
        }
        else{
            info(me.titleErro, me.requiredsFieldsText);
        }
    },
    
    prepareJSON: function(){
    	var me = this;
    	var selecteds = Ext.getCmp('GridGerador').getSelectionModel().getSelection();
    	var json = [];
    	var foreign = [];
		var retorno = true;
		
    	Ext.each(selecteds, function(rec){
    		json.push(Ext.encode(rec.data));
    		if(rec.data.foreign_key==true){
				if(rec.get('tabela_ref')==""){
					info(me.error_tabela+': '+rec.get('tabela'), rec.get('coluna')+me.no_table_ref);
					retorno = false;
					return false;
				}
				else if(rec.get('coluna_ref_value')==""){
					info(me.error_tabela+': '+rec.get('tabela'), rec.get('coluna')+me.no_value_ref);
					retorno = false;
					return false;
				}
				else if(rec.get('coluna_ref_label')==""){
					info(me.error_tabela+': '+rec.get('tabela'), rec.get('coluna')+me.no_label_ref);
					retorno = false;
					return false;
				}
    			foreign.push(Ext.encode(rec.data));
    		}
    	});

    	if(json.length==0){
			info(me.titleErro, me.require_gerar_crud);
    		return false;
    	}
		if(retorno==false){
			return false;
		}
		
		return {json: [json], foreign: [foreign]};
    },
    
    getIframeJSON: function(){
    	if(Ext.get('removeOlds').dom){
    		if(Ext.get('removeOlds').dom.contentDocument){
    			if(Ext.get('removeOlds').dom.contentDocument.head){
    				if(Ext.get('removeOlds').dom.contentDocument.head.nextElementSibling){
    					if(Ext.get('removeOlds').dom.contentDocument.head.nextElementSibling.innerHTML){
    						var json = Ext.get('removeOlds').dom.contentDocument.head.nextElementSibling.innerHTML;
    						return Ext.decode(json);
    					}
    				}
    			}
    		}
    	}
    	return false;
    },
    
    prepareServer: function(params, button){
    	var me = this;
    	Ext.getCmp('FormPrepare').el.mask(me.prepare_dados);
    	Ext.get('removeOlds').dom.contentDocument.head.nextElementSibling.innerHTML = "";
    	
    	window.open('server/modulos/gerador/delete.php?action=PREPARE_MODEL', 'removeOlds');
    	var inter = setInterval(function(){
    		var json = me.getIframeJSON();
    		if(json){
    			clearInterval(inter);
    			me.initAjax(params, button);
    		}
    	}, 1000);
    	
    },
    
    initAjax: function(params, button){
    	var me = this;
    	Ext.getCmp('FormPrepare').el.mask(me.generate_app);
    	if(params.permissoes_usuarios){
    		if(params.permissoes_usuarios=='sim'){
    			me.moduloSql = true;
    		}
    		else{
    			me.moduloSql = false;
    		}
    	}
    	else{
    		me.moduloSql = false;
    	}
    	
    	Ext.Ajax.request({
    	    url: 'server/modulos/gerador/list.php',
    	    params: params,
    	    success: function(response, opts){
    	        var obj = Ext.decode(response.responseText);
    	        Ext.getCmp('FormPrepare').el.unmask();
    	        if(obj.success==true){
    	        	Ext.Msg.alert('Sucess!', obj.msg);
    	        	Ext.getCmp('button_export_crud').setDisabled(false);
    	        	Ext.getCmp('button_test_crud').setDisabled(false);
    	        }
    	        else{
    	        	Ext.Msg.alert('Sucess!', obj.msg);
					me.enviarEmail(obj, params);
    	        }
    	        if(obj.logout){
    	        	window.location = 'login.php';
    	        }
				button.setDisabled(false);
    	    },
    	    failure: function(response, opts) {
    	    	Ext.getCmp('FormPrepare').el.unmask();
    	        console.log(me.falhaServer + response.status);
    	        Ext.getCmp('button_export_crud').setDisabled(true);
    	        Ext.getCmp('button_test_crud').setDisabled(true);
				button.setDisabled(false);
				me.enviarEmail(response, params);
    	    }
    	});
    },
    
    gerarCrud: function(button){
    	var me = this;
    	var p = me.prepareJSON();
    	if(!p){
    		return true;
    	}
    	button.setDisabled(true);
    	var params = Ext.getCmp('FormPrepare').getForm().getValues();
    	params.action = 'JSON_GRID_CRUD';
    	params.json = p.json;
    	params.foreign = p.foreign;
    	
    	me.prepareServer(params, button);
    },
    
    prepareCrud: function(button){
    	var win = Ext.getCmp('PrepareWin');
    	if(!win) win = Ext.widget('preparewin');
    	win.show();
		
    	var t = "";
    	Ext.getCmp('tabelas_prepare').store.removeAll();
    	var selecteds = Ext.getCmp('GridGerador').getSelectionModel().getSelection();
    	Ext.each(selecteds, function(rec){
    		if(rec.get('tabela')!=t){
    			Ext.getCmp('tabelas_prepare').store.add({
    				id: rec.get('tabela'),
    				descricao: rec.get('tabela')
    			});
    			t = rec.get('tabela');
    		}
    	});
    },
    
    syncCrud: function(button){
		var me = this;
    	if(window.tipo_usuario.key=='administrador'){
	    	var x = window.Url;
	    	if(x==undefined) return true;
	        var url = x.base+x.servidor+'-'+x.usuario+'-'+x.db+'-backupJson.json';
    	}
    	else{
    		return true;
    	}
		
        Ext.Ajax.request({
        	url: url,
        	method: 'POST',
        	success: function(f, o){
        		var dados = Ext.decode(f.responseText);
        		var recs = [];
        		for(var j in dados.dados){
        			var d = dados.dados[j];
        			Ext.getCmp('GridGerador').getStore().each(function(rec){

        				if((rec.get('tabela')==d.tabela) && (rec.get('coluna')==d.coluna)){
        					if(rec.get('coluna_ref_label')!=d.coluna_ref_label){
        						rec.set('coluna_ref_label', d.coluna_ref_label);
        					}
        					if(rec.get('coluna_value_condicao')!=d.coluna_value_condicao){
        						rec.set('coluna_value_condicao', d.coluna_value_condicao);
        					}
        					if(rec.get('coluna_label_condicao')!=d.coluna_label_condicao){
        						rec.set('coluna_label_condicao', d.coluna_label_condicao);
        					}
        					if(rec.get('coluna_value_condicao')!=d.coluna_value_condicao){
        						rec.set('coluna_value_condicao', d.coluna_value_condicao);
        					}
        					if(rec.get('required')!=d.required){
        						rec.set('required', d.required);
        					}
        					if(rec.get('nome_campo')!=d.nome_campo){
        						rec.set('nome_campo', d.nome_campo);
        					}
        					recs.push(rec);
        				}
        			});
        		};

        		if(Ext.getCmp('GridGerador'))
        			Ext.getCmp('GridGerador').selModel.select(recs);
        	},
        	failure: function(f, o){
        		if(f.status==404){
        			info(me.titleErro, me.no_sync);
        		}
        		else
        			info(me.titleErro, me.falhaServer + f.status);
        	}
        });
    }

});
