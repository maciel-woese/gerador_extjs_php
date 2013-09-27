<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/controller/Util.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172028593252457e135acff4-39134846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '762eccfe54006c365e87f69cf7231ccbe2e52e4e' => 
    array (
      0 => 'class/smarty/templates/desktop/controller/Util.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172028593252457e135acff4-39134846',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'error' => 0,
    'aviso' => 0,
    'aguarde' => 0,
    'delete_aguarde' => 0,
    'select_delete' => 0,
    'select_edit' => 0,
    'store_load_data' => 0,
    'button_filtrar' => 0,
    'ajax_lost' => 0,
    'server_failure' => 0,
    'fields_invalids' => 0,
    'exist_fields_requireds' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e1372dc77_74693854',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e1372dc77_74693854')) {function content_52457e1372dc77_74693854($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Util', {
	mixins: {
        observable: 'Ext.util.Observable'
    },
	
	titleErro: '<?php echo $_smarty_tpl->tpl_vars['error']->value;?>
',
    avisoText: '<?php echo $_smarty_tpl->tpl_vars['aviso']->value;?>
',
    saveFormText: '<?php echo $_smarty_tpl->tpl_vars['aguarde']->value;?>
',
    delGridText: '<?php echo $_smarty_tpl->tpl_vars['delete_aguarde']->value;?>
',
    delErroGrid: '<?php echo $_smarty_tpl->tpl_vars['select_delete']->value;?>
',
    editErroGrid: '<?php echo $_smarty_tpl->tpl_vars['select_edit']->value;?>
',
    loadingGridText: '<?php echo $_smarty_tpl->tpl_vars['store_load_data']->value;?>
',
    filteredText: '<?php echo $_smarty_tpl->tpl_vars['button_filtrar']->value;?>
 <span class="buttonFilter">*</span>',
    filterText: '<?php echo $_smarty_tpl->tpl_vars['button_filtrar']->value;?>
',
    connectFalhaText: '<?php echo $_smarty_tpl->tpl_vars['ajax_lost']->value;?>
',
    server_failure: '<?php echo $_smarty_tpl->tpl_vars['server_failure']->value;?>
',
    fieldsInvalidText: '<?php echo $_smarty_tpl->tpl_vars['fields_invalids']->value;?>
',
    requiredsFieldsText: '<?php echo $_smarty_tpl->tpl_vars['exist_fields_requireds']->value;?>
',
	
	storePai: false,
    started: false,
	
	clearInterval: false,
	disabledCombo: 0,
	
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>	
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
<?php }?>
	
	getDesktopWindow: function(id, Controller, className, callback){
    	var me = this;
		
    	this.application.getController('Desktop').getWindow(id, Controller, className, callback);
    	if(!Ext.getCmp(id)){
    		return true;
    	}
    },
	
	getStoresDependes: function(){
    	var me = this;
		if(me.getStore('StoreCombo'+me.id)){
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
		if(comp.xtype=='combobox'){
			if(me.disabledCombo==0){
				form.el.mask(me.saveFormText);
				setTimeout(function(){
					form.el.mask(me.saveFormText);
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
							
							if(me.storePai){
								me.getStoresDependes();
							}
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
					info(me.titleErro, o.msg);
					grid.store.load();
					if(typeof callbackSuccess == 'function'){
						callbackSuccess();
					}
					
					if(me.storePai){
						me.getStoresDependes();
					}
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

<?php }} ?>