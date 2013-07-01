<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/controller/controllerPrincipal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205619185551d18a17ed0e43-43273000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bf8b17e1a1f2a6270298ee4d0217f60ed791c1c' => 
    array (
      0 => 'class/smarty/templates/padrao/controller/controllerPrincipal.tpl',
      1 => 1348756004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205619185551d18a17ed0e43-43273000',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a17f1f298_62926795',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17f1f298_62926795')) {function content_51d18a17f1f298_62926795($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.controller.Principal', {
    extend: 'Ext.app.Controller',

	views: [
        'Principal'
    ],
    
    models: [
    	'ModelMenu'
    ],
    
    stores: [
    	'TreeStoreMenu'
    ],
    
    init: function(application) {
        var me = this;
		this.control({
            'containerprincipal panel treepanel': {
                itemclick: this.addTabPanel
            }
		});
    },
	
	addTabPanel: function(view, model){
		if(model.data.leaf!=true){
			return true;
		}
		if(model.raw.tab!==""){
			var ID = model.raw.idtemp.toUpperCase();
			var TITLE = model.raw.text;
			var TABLE = model.raw.tab.toLowerCase();
			var tipo = model.raw.tipo;
			var str = model.raw.tab;
			
			if(tipo=='cad'){
				this.application.getController(str).add(view);
				return true;
			}
			
			var novaAba = Ext.getCmp('PanelCentral').items.findBy(function( aba ){ return aba.id === ID; });
			
			if(!novaAba){
				novaAba = Ext.getCmp('PanelCentral').add({
					  title	: TITLE,
					  closable: true,
					  layout: {
						type: 'fit'
					  },
					  id: ID,
					  items: {
						  xtype: TABLE+'list',
						  border: false
					  }
				});
			}
			
			Ext.getCmp('PanelCentral').setActiveTab(ID);
		}
	}
});

<?php }} ?>