<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/usuarios/store.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85052665852457e140eaae9-37754989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d0abd664d6792c228dad9ffc63b85049454f2a' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/usuarios/store.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85052665852457e140eaae9-37754989',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14130b89_09739514',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14130b89_09739514')) {function content_52457e14130b89_09739514($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StoreUsuarios', {
    extend: 'Ext.data.Store',
    requires: [
        '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelUsuarios'
    ],
	
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'StoreUsuarios',
            model: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelUsuarios',
            remoteSort: true,
            sorters: [
            	{
            		direction: 'ASC',
            		property: 'id'
            	}
            ],
   	        proxy: {
            	type: 'ajax',
				extraParams: {
					action: 'LIST'
				},
		    	actionMethods: {
			        create : 'POST',
			        read   : 'POST',
			        update : 'POST',
			        destroy: 'POST'
			    },	
	            url : 'server/modulos/usuarios/list.php',
	            reader: {
	            	type: 'json',
	                root: 'dados'
	            }
            }
        }, cfg)]);
        
        
        me.on('beforeload', function(){
        	if(Ext.getCmp('GridUsuarios')){
				Ext.getCmp('GridUsuarios').getEl().mask('Aguarde Carregando Dados...');
			}	
  		});
  		
  		me.on('load', function(){
  			if(Ext.getCmp('GridUsuarios')){
				Ext.getCmp('GridUsuarios').getEl().unmask();
			}	
  		});
    }
});
<?php }} ?>