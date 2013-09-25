<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:55
         compiled from "class/smarty/templates/touch/controller/controller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113638676052330633541882-24297304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e8cc4e81ec931e97ec3323d34d2f0e7bfd0cde3' => 
    array (
      0 => 'class/smarty/templates/touch/controller/controller.tpl',
      1 => 1352428359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113638676052330633541882-24297304',
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
    'confirm' => 0,
    'delete_msg' => 0,
    'CHAVE' => 0,
    'setmask' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5233063379c8b4_43829363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5233063379c8b4_43829363')) {function content_5233063379c8b4_43829363($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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
    alias: 'controller.controller<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
	
	mixins: {
		controls: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Util'
    },
    
<?php if ($_smarty_tpl->tpl_vars['modelCombo']->value==true){?>
	storePai: true,
<?php }?>
	tabela: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
	
    config: {
		id: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
		
		refs: {
			filter: {
				selector: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
filter',
				xtype: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
filter',
				autoCreate: true
			},
			form: {
				selector: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
form',
				xtype: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
form',
				autoCreate: true
			},
			list: {
				selector: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list',
				xtype: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list',
				autoCreate: true
			}
		},
		
		models: [
<?php if ($_smarty_tpl->tpl_vars['models']->value>0){?>
			'ModelComboLocal',
<?php }else{ ?><?php }?><?php if ($_smarty_tpl->tpl_vars['modelCombo']->value==true){?>
			'ModelCombo',
<?php }else{ ?><?php }?>			'Model<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
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
<?php }else{ ?><?php }?>			'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
'		
		],
        
        views: [
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Edit',
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Filtro',
            '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.List'
        ],
		
		control: {
        	'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
form toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
form toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
form container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
filter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
filter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
filter toolbar button[action=back]' : {
        		tap: 'showList'
			}
        }
    },
    
    getWin: function(button){
    	<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.app.getController(button.config.modulo).showEdit(button, this.getForm());
    },
	
	deletar: function(button){
		var me = this;
		if(me.getList().getSelectionCount()>0){
			var record = me.getList().getSelection()[0];
			Ext.Msg.confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['delete_msg']->value;?>
: '+record.get('<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
')+'?', function(btn){
				if(btn=='yes'){
					me.deleteAjax(me.getList(), '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
', {
						action: 'DELETE',
						id: record.get('<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
')
					}, false);
				}
			});
		}
		else{
			Ext.Msg.alert(this.titleErro, this.delErroGrid);
		}
	},
<?php if (count($_smarty_tpl->tpl_vars['setmask']->value)>0){?>	
	prepareValuesMask: function(data){
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['setmask']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>		
		data.<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
 = setMask(data.<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
, '<?php echo $_smarty_tpl->tpl_vars['field']->value['mask'];?>
');<?php } ?>
				
		return data;
	},
<?php }?>	
	atualizar: function(button){
		var usr = Ext.create('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.Model<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
', this.getForm().getValues()),
		errs = usr.validate(),
		msg = '';
		if (!errs.isValid()){
			errs.each(function (err) {
				msg += err.getMessage() + '<br/>';
			});
			Ext.Msg.alert(this.titleErro, msg);
		} 
		else {
			this.save(this.getList(), this.getForm(), false);
		}
		usr.destroy();
	}
	
});<?php }} ?>