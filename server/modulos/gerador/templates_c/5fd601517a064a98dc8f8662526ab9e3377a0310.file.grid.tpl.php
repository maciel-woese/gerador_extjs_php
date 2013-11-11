<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:09
         compiled from "class/smarty/templates/desktop/view/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204602587152457e119b7d13-65442218%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fd601517a064a98dc8f8662526ab9e3377a0310' => 
    array (
      0 => 'class/smarty/templates/desktop/view/grid.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204602587152457e119b7d13-65442218',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
    'menu_list' => 0,
    'columns' => 0,
    'field' => 0,
    'f' => 0,
    'permissoes' => 0,
    'button_adicionar' => 0,
    'button_editar' => 0,
    'button_deletar' => 0,
    'button_filtrar' => 0,
    'pdf' => 0,
    'button_pdf' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e11c66c10_46356560',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e11c66c10_46356560')) {function content_52457e11c66c10_46356560($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.List', {
    extend: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.WindowBig',
	alias: 'widget.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list',
    requires: [
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',

    id: 'List-<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: '<?php echo $_smarty_tpl->tpl_vars['menu_list']->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'Grid<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
    		        store: 'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
					viewConfig: {
						autoScroll: true,
						loadMask: false
					},
					<?php ob_start();?><?php echo count($_smarty_tpl->tpl_vars['columns']->value);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1<10){?>forceFit: true,<?php }?>
			
					columns: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']++;
?>
						{
							xtype: '<?php echo $_smarty_tpl->tpl_vars['field']->value['xtype'];?>
column',
							dataIndex: '<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'){?>
							format: '<?php echo $_smarty_tpl->tpl_vars['field']->value['format'];?>
',
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['hidden']==true){?>
							hidden: true,
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'){?>
							renderer : Ext.util.Format.dateRenderer('<?php echo $_smarty_tpl->tpl_vars['field']->value['format'];?>
'),
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='number'){?>
							format: '0',
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cpf'){?>
							renderer : Ext.util.Format.maskRenderer('999.999.999-99'),
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cep'){?>
							renderer : Ext.util.Format.maskRenderer('99.999-999'),
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='fone'){?>
							renderer : Ext.util.Format.maskRenderer('(99) 9999-9999'),
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cnpj'){?>
							renderer : Ext.util.Format.maskRenderer('99.999.999/9999-99'),
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='money'){?>
							renderer: Ext.util.Format.maskRenderer('R$ #9.999.990,00', true),
<?php }?>
							text: '<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
',<?php if ($_smarty_tpl->tpl_vars['field']->value['renderer']!='false'){?>
							
							renderer: function(v){
								switch(v){
<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value['renderer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
									case '<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
':
									return '<?php echo $_smarty_tpl->tpl_vars['f']->value['descricao'];?>
';
									break;
<?php } ?> 					
								}
							},<?php }?>					
							width: 140
						}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['total'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['index']!=$_tmp2-1){?>,<?php }?>

<?php } ?>                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									iconCls: 'bt_add',<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
									
									hidden: true,<?php }?>
									
									action: 'adicionar',
									text: '<?php echo $_smarty_tpl->tpl_vars['button_adicionar']->value;?>
'
								},
								{
									xtype: 'button',
									id: 'button_edit_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									iconCls: 'bt_edit',<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
									
									hidden: true,<?php }?>									
									action: 'editar',
									text: '<?php echo $_smarty_tpl->tpl_vars['button_editar']->value;?>
'
								},
								{
									xtype: 'button',
									id: 'button_del_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									iconCls: 'bt_del',<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
									
									hidden: true,<?php }?>									
									action: 'deletar',
									text: '<?php echo $_smarty_tpl->tpl_vars['button_deletar']->value;?>
'
								},
								{
									xtype: 'button',
									id: 'button_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: '<?php echo $_smarty_tpl->tpl_vars['button_filtrar']->value;?>
'
								}<?php if ($_smarty_tpl->tpl_vars['pdf']->value==true){?>,
								{
									xtype: 'button',
									id: 'button_pdf_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									iconCls: 'bt_pdf',
									action: 'gerar_pdf',
									text: '<?php echo $_smarty_tpl->tpl_vars['button_pdf']->value;?>
'
								}<?php }?>
								
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