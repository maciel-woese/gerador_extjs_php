<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/perfil/controller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170604068852457e13ba2da2-57373216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22b548c35a65a57eec9afd5624cc5d1629ba3d42' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/perfil/controller.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170604068852457e13ba2da2-57373216',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13c39a30_65857643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13c39a30_65857643')) {function content_52457e13c39a30_65857643($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Perfil', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Util'
    },

	storePai: true,
	tabela: 'Perfil',

	refs: [
        {
        	ref: 'list',
        	selector: 'perfillist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addperfilwin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'perfillist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterperfilwin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterperfilwin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addperfilwin'
        }
    ],
	
    models: [
		'ModelCombo',
		'ModelPerfil'
	],
	stores: [
		'StoreComboPerfil',
		'StorePerfil'		
	],
	
    views: [
        'perfil.List',
        'perfil.Filtro',
        'perfil.Edit'
    ],

    init: function(application) {
    	this.control({
    		'perfillist gridpanel': {
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'perfillist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'perfillist button[action=adicionar]': {
                click: this.add
            },
            'perfillist button[action=editar]': {
                click: this.btedit
            },
            'perfillist button[action=deletar]': {
            	click: this.btdel
            },            
            'perfillist button[action=modulos]': {
                click: this.setModulos
            },            
            'addperfilwin button[action=salvar]': {
                click: this.update
            },
            'addperfilwin button[action=resetar]': {
                click: this.reset
            },
            'addperfilwin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addperfilwin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addperfilwin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterperfilwin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterperfilwin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterperfilwin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterperfilwin': {
                show: this.filterSetFields
            }
        });
    },
    
    setModulos: function(button){
    	var me = this;
    	if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
	    	
	    	me.getDesktopWindow('AddPermissoesWin', 'Permissoes', 'permissoes.Edit', function(){
	    		Ext.getCmp('TreePermissoes').store.proxy.extraParams = {
	    			action: 'PERFIL',
	    			perfil_id: record.get('id')
	    		};
		    	
		    	Ext.getCmp('TreePermissoes').store.load();
	    	});
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
    },
	
    edit: function(grid, record) {
    	var me = this;
    	me.getDesktopWindow('AddPerfilWin', 'Perfil', 'perfil.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Perfil');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('id'), 'server/modulos/perfil/list.php');
	        Ext.getCmp('action_perfil').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'perfil', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('perfil')+'?', function(btn){
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
		me.getDesktopWindow('Perfil', 'Perfil', 'perfil.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = this.getFilterWin();
    	if(!win) var win = Ext.create('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.perfil.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
<?php }} ?>