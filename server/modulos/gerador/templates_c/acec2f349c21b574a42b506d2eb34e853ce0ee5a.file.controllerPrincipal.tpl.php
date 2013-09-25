<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/controller/lista/controllerPrincipal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1141332475523306340b0af8-28470202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'acec2f349c21b574a42b506d2eb34e853ce0ee5a' => 
    array (
      0 => 'class/smarty/templates/touch/controller/lista/controllerPrincipal.tpl',
      1 => 1350925080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1141332475523306340b0af8-28470202',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52330634121100_40021100',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52330634121100_40021100')) {function content_52330634121100_40021100($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Principal', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controllerprincipal',

    config: {
		
		refs: {
			list: {
				selector: 'containerprincipal',
				xtype: 'containerprincipal',
				autoCreate: true
			}
		},
		
        models: [
            'ModelPrincipal'
        ],
        stores: [
            'StorePrincipal'
        ],
        views: [
            'Principal'
        ],
		
		control: {
        	'containerprincipal' : {
        		itemtap: 'setPanelView'
			}
        }
    },
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>	
    
    getPermissoes: function(list, tabela){
    	var me = this;
		var data = <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.app.dados[tabela];
    	var items = list.down('toolbar[docked=bottom]').items.items;
    	Ext.each(items, function(p){
			Ext.each(data, function(j){
				if(p.config.action && p.config.action==j.acao){
					p.setHidden(false);
				}
			});
		});
    },
    
<?php }?>	
	setPanelView: function(comp, index, target, record){
		if(record.get('action')=='list'){
			var controller = <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.app.getController(record.get('modulo'));
			controller.showList();
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>				
			this.getPermissoes(controller.getList(), controller.tabela.toLowerCase());
<?php }?>			
		}
		else if(record.get('action')=='logout'){
			window.location = "logout.php";
		}
	}
});<?php }} ?>