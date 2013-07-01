<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/view/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39074623451d18a178a1bd8-14235993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64c20a4180f68eaf3c8c32875f15ab89a1214b1c' => 
    array (
      0 => 'class/smarty/templates/padrao/view/grid.tpl',
      1 => 1352421692,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39074623451d18a178a1bd8-14235993',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
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
  'unifunc' => 'content_51d18a17987ca8_06019939',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17987ca8_06019939')) {function content_51d18a17987ca8_06019939($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list',
    requires: [
    	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.store.Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
'
    ],
	
	id: 'Grid<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
    store: 'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
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
							iconCls: 'bt_edit',
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
							hidden: true,<?php }?>
							
							action: 'editar',
							text: '<?php echo $_smarty_tpl->tpl_vars['button_editar']->value;?>
'
						},
						{
							xtype: 'button',
							id: 'button_del_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							iconCls: 'bt_del',
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
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
						}
<?php }?>
					
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
<?php }} ?>