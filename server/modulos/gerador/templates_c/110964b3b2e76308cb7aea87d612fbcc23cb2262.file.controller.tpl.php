<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:09
         compiled from "class/smarty/templates/desktop/controller/controller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169512569752457e116bebb8-09486938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '110964b3b2e76308cb7aea87d612fbcc23cb2262' => 
    array (
      0 => 'class/smarty/templates/desktop/controller/controller.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169512569752457e116bebb8-09486938',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
    'modelCombo' => 0,
    'models' => 0,
    'stores' => 0,
    'field' => 0,
    'permissoes' => 0,
    'pdf' => 0,
    'title_window_edit' => 0,
    'CHAVE' => 0,
    'confirm' => 0,
    'delete_msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e119ae543_10495201',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e119ae543_10495201')) {function content_52457e119ae543_10495201($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Util'
    },

<?php if ($_smarty_tpl->tpl_vars['modelCombo']->value==true){?>
	storePai: true,
<?php }?>
	tabela: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
	
	refs: [
        {
        	ref: 'list',
        	selector: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win form'
        },
        {
        	ref: 'filterBtn',
        	selector: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win'
        },
        {
        	ref: 'filterForm',
        	selector: 'filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win form'
        },
        {
        	ref: 'addWin',
        	selector: 'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win'
        }
    ],
	
    models: [
<?php if ($_smarty_tpl->tpl_vars['models']->value>0){?>
		'ModelComboLocal',
<?php }else{ ?><?php }?><?php if ($_smarty_tpl->tpl_vars['modelCombo']->value==true){?>
		'ModelCombo',
<?php }else{ ?><?php }?>		'Model<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
'
	],
	stores: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['stores']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
		'StoreCombo<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['store']);?>
',
<?php } ?>
<?php if ($_smarty_tpl->tpl_vars['modelCombo']->value==true){?>
		'StoreCombo<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
<?php }else{ ?><?php }?>		'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
'		
	],
	
    views: [
        '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.List',
        '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Filtro',
        '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Edit'
    ],

    init: function(application) {
    	this.control({
    		'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list gridpanel': { <?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>                
				afterrender: this.getPermissoes,
<?php }?>
                render: this.gridLoad
            },
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list button[action=adicionar]': {
                click: this.add
            },
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list button[action=editar]': {
                click: this.btedit
            },
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list button[action=deletar]': {
                click: this.btdel
            },<?php if ($_smarty_tpl->tpl_vars['pdf']->value==true){?>            
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
<?php }?>
            'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win button[action=salvar]': {
                click: this.update
            },
            'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win button[action=resetar]': {
                click: this.reset
            },
            'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win': {
                show: this.filterSetFields
            }
        });
    },
<?php if ($_smarty_tpl->tpl_vars['pdf']->value==true){?>   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
<?php }?>
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('Add<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
Win', '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Edit', function(){
    		me.getAddWin().setTitle('<?php echo $_smarty_tpl->tpl_vars['title_window_edit']->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
'), 'server/modulos/<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
/list.php');
	        Ext.getCmp('action_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
', {
			action: 'DELETAR',
			id: record.get('<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
')
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

			Ext.Msg.confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['delete_msg']->value;?>
: '+record.get('<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
')+'?', function(btn){
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
        me.getDesktopWindow('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
<?php }} ?>