<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/controller/lista/Util.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2039751736523306341ae633-73407763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0904f7257237d946843a569f7474d33265ac6370' => 
    array (
      0 => 'class/smarty/templates/touch/controller/lista/Util.tpl',
      1 => 1352428674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2039751736523306341ae633-73407763',
  'function' => 
  array (
  ),
  'variables' => 
  array (
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
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_523306342d0394_61291818',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523306342d0394_61291818')) {function content_523306342d0394_61291818($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Util', {
    extend: 'Ext.app.Controller',
    alias: 'controller.util',
	
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
	
	clearInterval: false,
	disabledCombo: 0,
	
	backEdit: false,
	
	loadList: function(button){
		this.getList().getStore().load();
	},
	
	showList: function(button){
		var me = this;
		if(button!=undefined && button.config.action=='back'){
			if(me.backEdit._id){
				Ext.Viewport.animateActiveItem(me.backEdit, {
					type:'slide', direction: 'right'
				});
				me.backEdit = false;
			}
			else{
				Ext.Viewport.animateActiveItem(this.getList(), {
					type:'slide', direction: 'right'
				});
			}
		}
		else{
			Ext.Viewport.animateActiveItem(this.getList(), {
				type:'slide', direction: 'left'
			});
			this.getList().getStore().load();
		}
	},
		
	loadCombo: function(){
		Ext.Object.each(this.getForm().getFields(), function(name, valor){
			if(valor.config.xtype=='selectfield'){
				if(valor.getStore().getCount()==0){
					valor.getStore().load();
				}
			}
		});
	},
	
	loadComboFilter: function(){
		Ext.Object.each(this.getFilter().getFields(), function(name, valor){
			if(valor.config.xtype=='selectfield'){
				if(valor.getStore().getCount()==0){
					valor.getStore().load();
				}
			}
		});
	},
	
	prepareValuesMask: function(data){
		return data;
	},
	
	showEdit: function(button, formBack){
		var me = this;
		if(button.config.action=='editar'){
			if(this.getList().getSelectionCount()>0){
				var record = this.getList().getSelection()[0];
				Ext.Viewport.animateActiveItem(this.getForm(), {
					type:'slide', direction: 'left'
				});
				this.loadCombo();
				record.data.action = 'EDITAR';
				this.getForm().setValues(me.prepareValuesMask(record.data));
			}
			else{
				Ext.Msg.alert(this.titleErro, this.editErroGrid);
			}
		}
		else{
			Ext.Viewport.animateActiveItem(this.getForm(), {
				type:'slide', direction: 'left'
			});
			this.getForm().reset();
			this.loadCombo();
			if(formBack){
				me.backEdit = formBack;
			}
		}
	},
	
	resetFiltro: function(button){
		var me = this;
		me.showList({
			config:{
				action:'back'
			}
		});
		Ext.Object.each(me.getList().getStore().getProxy().config.extraParams, function(key, value) {
			delete(me.getList().getStore().getProxy().config.extraParams[key]);
		});
		me.getList().getStore().getProxy().config.extraParams.action = 'LIST';
		me.getList().getStore().load();
	},
	
	showFiltro: function(button){
		Ext.Viewport.animateActiveItem(this.getFilter(), {
			type:'slide', direction: 'left'
		});
		this.loadComboFilter();
		var p = this.getList().getStore().getProxy().config.extraParams;
        if(p.action=='FILTER'){
			this.getFilter().setValues(p);
        }
        else{
			this.getFilter().reset();
			this.getFilter().setValues({
				action: 'FILTER'
			});
		}
	},
	
	setFiltro: function(button){
		var me = this;
		me.showList({
			config:{
				action:'back'
			}
		});
		
		Ext.Object.each(me.getFilter().getValues(), function(key, value) {
			me.getList().getStore().getProxy().config.extraParams[key] = value;
		});
		me.getList().getStore().load();
	},
	
	mask: function(msg){
    	if(msg){
	    	Ext.Viewport.setMasked({
	    		xtype:'loadmask',
	    		message: msg
	    	});
    	}
    	else{
    		Ext.Viewport.setMasked(false);
    	}
    },
	
	backMenu: function(button){
		Ext.Viewport.animateActiveItem(Ext.getCmp('GridPrincipal'), {
			type:'slide', direction: 'right'
		});
	},
	
	getStoresDependes: function(){
    	var me = this;
		if(Ext.data.StoreManager.lookup('StoreCombo'+me.config.id)){
			Ext.data.StoreManager.lookup('StoreCombo'+me.config.id).load();
		}
    },
	
	save: function(grid, form, callbackSuccess){
		var me = this;
		me.mask(me.saveFormText);
		
		form.submit({
			success: function(f, o){
				me.mask();
				if(o.success==true){
					Ext.Msg.alert(me.avisoText, o.msg);
					
					if(grid){
						grid.getStore().load();
					}
					
					if(typeof callbackSuccess == 'function'){
						callbackSuccess(o);
					}
					if(me.storePai){
						me.getStoresDependes();
					}
					
					me.showList({
						config:{
							action:'back'
						}
					});
				}
			},
			failure: function(f, action){
				me.mask();
				switch (action.failureType) {
					case Ext.form.action.Action.CLIENT_INVALID:
						Ext.Msg.alert(me.titleErro, me.fieldsInvalidText);
						break;
					case Ext.form.action.Action.CONNECT_FAILURE:
						Ext.Msg.alert(me.titleErro, me.connectFalhaText);
						break;
					case Ext.form.action.Action.SERVER_INVALID:
					   Ext.Msg.alert(me.titleErro, action.result.msg);
				}
			}
		});
	},
	
	deleteAjax: function(grid, tabela, params, callbackSuccess){
		var me = this;
		me.mask(me.delGridText);
		Ext.Ajax.request({
			url: 'server/modulos/'+tabela+'/delete.php',
			params: params,
			success: function(o){
				me.mask(false);
				var o = Ext.decode(o.responseText);
				if(o.success==true){
					grid.getStore().load();
					if(typeof callbackSuccess == 'function'){
						callbackSuccess();
					}
					
					if(me.storePai){
						me.getStoresDependes();
					}
				}
				else{
					Ext.Msg.alert(me.avisoText, o.msg);
				}
			},
			failure: function(o){
				me.mask(false);
				Ext.Msg.alert(me.titleErro, me.server_failure + o.status);
			}
		});
	},
	
	enableButton: function(comp){
		var id = comp.config.button_id;
		if(comp.getValue()!=null){
			Ext.getCmp(id).setHidden(false);
			comp.setLabelWidth('41%');
		}
		else{
			comp.setLabelWidth('30%');
			Ext.getCmp(id).setHidden(true);
		}
	},
		
	resetCombo: function(button){
		var id = button.config.combo_id;
		Ext.getCmp(id).reset();
		Ext.getCmp(id).setLabelWidth('36%');
		button.setHidden(true);
	}
	
});<?php }} ?>