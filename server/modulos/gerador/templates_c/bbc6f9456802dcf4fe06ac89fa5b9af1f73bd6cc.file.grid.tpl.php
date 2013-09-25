<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:55
         compiled from "class/smarty/templates/touch/view/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1670873552523306337a4a40-68535222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbc6f9456802dcf4fe06ac89fa5b9af1f73bd6cc' => 
    array (
      0 => 'class/smarty/templates/touch/view/grid.tpl',
      1 => 1352428932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1670873552523306337a4a40-68535222',
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
    'load_more' => 0,
    'no_records' => 0,
    'button_back' => 0,
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_523306339bc7b8_02302853',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523306339bc7b8_02302853')) {function content_523306339bc7b8_02302853($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
list',

    config: {
        id: 'Grid<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
		fullscreen: true,
		store: 'Store<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']++;
?>
			<?php if ($_smarty_tpl->tpl_vars['field']->value['hidden']!=true){?>'<div class="gridlist"><b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['title']);?>
: </b> <?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
</div>',<?php }?>			
<?php } ?>
			{
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['columns']['index']++;
?><?php if ($_smarty_tpl->tpl_vars['field']->value['hidden']!=true){?><?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'){?>
				
				<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexFunction'];?>
: function(v){
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='H:i:s'){?>
					return v;
<?php }else{ ?>					return Ext.util.Format.date(v, '<?php echo $_smarty_tpl->tpl_vars['field']->value['format'];?>
');					
<?php }?>
				}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['total'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['index']!=$_tmp1-1){?>,<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['field']->value['renderer']!='false'){?>
				
				<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexFunction'];?>
: function(v){
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
				}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['total'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['index']!=$_tmp2-1){?>,<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['field']->value['mask']!=''){?>
				
				<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexFunction'];?>
: function(v){
					return setMask(v, '<?php echo $_smarty_tpl->tpl_vars['field']->value['mask'];?>
');				
				}<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['total'];?>
<?php $_tmp3=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['columns']['index']!=$_tmp3-1){?>,<?php }?><?php }?>
<?php }?>
<?php } ?>

			}
        ),
        plugins: [
	        {
	            xclass: 'Ext.plugin.ListPaging',
				loadMoreText: '<?php echo $_smarty_tpl->tpl_vars['load_more']->value;?>
',
				noMoreRecordsText: '<?php echo $_smarty_tpl->tpl_vars['no_records']->value;?>
',
	            autoPaging: true
	        }
	    ],
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: '<?php echo $_smarty_tpl->tpl_vars['button_back']->value;?>
',
						action: 'back_menu'
                    },
					{
						xtype: 'spacer'
					},
					{
                        xtype: 'button',
                        ui: 'confirm',
						iconMask: true,
						iconCls: 'refresh',
						action: 'refresh'
                    }
				]
            },
			{
				xtype: 'toolbar',
				docked: 'bottom',
				ui: 'light',
				layout: {
					align: 'center',
					pack: 'center',
					type: 'hbox'
				},
				items: [
					{
						xtype: 'button',
						iconCls: 'add',
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
						hidden: true,<?php }?>
						action: 'adicionar',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'editar',
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
						hidden: true,<?php }?>
						iconCls: 'compose',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'deletar',
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
						hidden: true,<?php }?>
						iconCls: 'delete',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'search',
						iconCls: 'search',
						iconMask: true
					}
				]
			}
               
        ]
    }

});

<?php }} ?>