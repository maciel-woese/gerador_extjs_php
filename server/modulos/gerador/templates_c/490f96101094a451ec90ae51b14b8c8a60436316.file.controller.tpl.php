<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/usuarios/controller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149009969452457e13df55c4-07258694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '490f96101094a451ec90ae51b14b8c8a60436316' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/usuarios/controller.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149009969452457e13df55c4-07258694',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13e88278_57710247',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13e88278_57710247')) {function content_52457e13e88278_57710247($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Usuarios', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Util'
    },

	tabela: 'Usuarios',

	refs: [
        {
        	ref: 'list',
        	selector: 'usuarioslist gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'addusuarioswin form'
        },
        {
        	ref: 'filterBtn',
        	selector: 'usuarioslist button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filterusuarioswin'
        },
        {
        	ref: 'filterForm',
        	selector: 'filterusuarioswin form'
        },
        {
        	ref: 'addWin',
        	selector: 'addusuarioswin'
        }
    ],
	
    models: [
		'ModelComboLocal',
		'ModelUsuarios'
	],
	stores: [
		'StoreComboPerfil',
		'StoreComboAdministradorUsuarios',
		'StoreComboStatusUsuarios',
		'StoreUsuarios'		
	],
	
    views: [
        'usuarios.List',
        'usuarios.Filtro',
        'usuarios.Edit'
    ],

    init: function(application) {
    	this.control({
    		'usuarioslist gridpanel': {
				afterrender: this.getPermissoes,
                render: this.gridLoad
            },
            'usuarioslist button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            'usuarioslist button[action=adicionar]': {
                click: this.add
            },
            'usuarioslist button[action=editar]': {
                click: this.btedit
            },
            'usuarioslist button[action=deletar]': {
                click: this.btdel
            },            
            'usuarioslist button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
            'usuarioslist button[action=modulos]': {
                click: this.setModulos
            },
            'addusuarioswin button[action=salvar]': {
                click: this.update
            },
            'addusuarioswin button[action=resetar]': {
                click: this.reset
            },
            'addusuarioswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'addusuarioswin form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'addusuarioswin form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filterusuarioswin form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filterusuarioswin button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filterusuarioswin button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filterusuarioswin': {
                show: this.filterSetFields
            }
        });
    },
   
    setModulos: function(button){
    	var me = this;
    	if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			
	    	if(record.get('administrador')==true){
	    		info('Aviso!', 'Adiministradores tem permiss&otilde;es totais!');
	    		return true;
	    	}
	    	
	    	me.getDesktopWindow('AddPermissoesWin', 'Permissoes', 'permissoes.Edit', function(){
	    		Ext.getCmp('TreePermissoes').store.proxy.extraParams = {
	    			action: 'USUARIO',
		    		usuario_id: record.get('id'),
	    			perfil_id: record.get('perfil_id')
	    		};
		    	
		    	Ext.getCmp('TreePermissoes').store.load();
	    	});
	    	
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
    	
    },
    
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/usuarios/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('AddUsuariosWin', 'Usuarios', 'usuarios.Edit', function(){
    		me.getAddWin().setTitle('Edi&ccedil;&atilde;o de Usu&aacute;rios');
	        me.getValuesForm(me.getForm(), win, record.get('id'), 'server/modulos/usuarios/list.php');
	    	Ext.getCmp('action_usuarios').setValue('EDITAR');
		    Ext.getCmp('senha_usuarios').setDisabled(true);
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, 'usuarios', {
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

			Ext.Msg.confirm('Confirmar', 'Deseja deletar: '+record.get('nome')+'?', function(btn){
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
		me.getDesktopWindow('AddUsuariosWin', 'Usuarios', 'usuarios.Edit', function(){

    	});
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
    	var win = Ext.getCmp('FilterUsuariosWin');
    	if(!win) win = Ext.widget('filterusuarioswin');
    	win.show();
    }

});
<?php }} ?>