<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/perfil/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201543468252457e13c711b0-22660148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4223a919217e77d78ee1b33f4bf9d7b42718ccaf' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/perfil/grid.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201543468252457e13c711b0-22660148',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13cbb933_45291582',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13cbb933_45291582')) {function content_52457e13cbb933_45291582($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/


Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.perfil.List', {
    extend: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.WindowBig',
	alias: 'widget.perfillist',
    requires: [
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.StorePerfil'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'perfil',

    id: 'List-Perfil',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Perfil',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridPerfil',
    		        store: 'StorePerfil',
					viewConfig: {
						autoScroll: true,
						loadMask: false
					},
					forceFit: true,
					columns: [
						{
							xtype: 'numbercolumn',
							dataIndex: 'id',
							hidden: true,
							format: '0',
							text: 'Id',
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'perfil',
							text: 'Perfil',
							width: 140
						}
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StorePerfil',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_perfil',
									iconCls: 'bt_add',
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_perfil',
									iconCls: 'bt_edit',
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_perfil',
									iconCls: 'bt_del',
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_modulos_perfil',
									iconCls: 'modulo',
									action: 'modulos',
									text: 'Add/Rem. M&oacute;dulos'
								},
								{
									xtype: 'button',
									id: 'button_filter_perfil',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
								}
							]
						}
					]
    		    }
    		]
    	});

    	me.callParent(arguments);
    }
});


<?php }} ?>