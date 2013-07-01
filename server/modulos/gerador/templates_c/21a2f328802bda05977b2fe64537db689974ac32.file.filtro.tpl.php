<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/view/filtro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4985261951d18a173c4600-90518528%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21a2f328802bda05977b2fe64537db689974ac32' => 
    array (
      0 => 'class/smarty/templates/padrao/view/filtro.tpl',
      1 => 1372684627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4985261951d18a173c4600-90518528',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
    'title_filter' => 0,
    'form' => 0,
    'field' => 0,
    'button_reset_filtro' => 0,
    'button_filtrar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1754fe08_94861728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1754fe08_94861728')) {function content_51d18a1754fe08_94861728($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Filtro', {
    extend: 'Ext.window.Window',
    alias: 'widget.filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win',

    id: 'Filter<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
Win',
    layout: {
        type: 'fit'
    },
    
    title: '<?php echo $_smarty_tpl->tpl_vars['title_filter']->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
        	items: [
                {
                    xtype: 'form',
                    id: 'FormFilter<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
                    bodyPadding: 10,
                    autoScroll: true,
                    items: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['comboLocal']!=''){?>
						{
                            xtype: 'fieldcontainer',
                            autoHeight: true,
                            layout: {
                                align: 'stretch',
                                type: 'hbox'
                            },
                            items: [
                                {
									xtype: 'combobox',
                                    store: 'StoreCombo<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['nome']);?>
<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
                                    name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
									id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									button_id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									flex: 1,
									loadDisabled: true,
									anchor: '100%',
									fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                                    combo_id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                                    action: 'reset_combo'
                                }
                            ]
                        },

<?php }else{ ?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='text'){?>
						{
							xtype: 'textfield',
							name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
							id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',<?php if ($_smarty_tpl->tpl_vars['field']->value['inputType']!=''){?>
				
							inputType: '<?php echo $_smarty_tpl->tpl_vars['field']->value['inputType'];?>
',<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='fone'){?>
							
							mask: '(99) 9999-9999',
							plugins: 'textmask',<?php }elseif($_smarty_tpl->tpl_vars['field']->value['mask']=='cep'){?>
							
							mask: '99.999-999',
							plugins: 'textmask',<?php }elseif($_smarty_tpl->tpl_vars['field']->value['mask']=='cnpj'){?>
							
							mask: '99.999.999/9999-99',
							plugins: 'textmask',<?php }elseif($_smarty_tpl->tpl_vars['field']->value['mask']=='cpf'){?>
							
							mask: '999.999.999.99',
							plugins: 'textmask',<?php }elseif($_smarty_tpl->tpl_vars['field']->value['mask']=='money'){?>
							
							mask: '#9.999.990,00',
							plugins: 'textmask',
							money: true,<?php }?>
							
							anchor: '100%',
							fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
						},
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['xtype']=='number'){?>
						{
							xtype: 'numberfield',
							allowDecimals: false,
							name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
							id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							anchor: '100%',
							fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
						},
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['xtype']=='combo'){?>
						{
                            xtype: 'fieldcontainer',
                            autoHeight: true,
                            layout: {
                                align: 'stretch',
                                type: 'hbox'
                            },
                            items: [
                                {
									xtype: 'combobox',
                                    store: 'StoreCombo<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['store']);?>
',
                                    name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
									id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									button_id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									flex: 1,
									anchor: '100%',
									fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
								},
                                {
                                    xtype: 'buttonadd',
                                    iconCls: 'bt_cancel',
                                    hidden: true,
                                    id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                                    combo_id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                                    action: 'reset_combo'
                                }
                            ]
                        },
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo_real']=='datetime'||$_smarty_tpl->tpl_vars['field']->value['tipo_real']=='timestamp'){?>
						{
		                    xtype: 'fieldcontainer',
		                    anchor: '100%',
		                    layout: {
		                        align: 'stretch',
		                        type: 'hbox'
		                    },
		                    labelAlign: 'top',
    						labelStyle: 'font-weight: bold;font-size: 11px;',			    
		                    fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
',
		                    items: [
		                        {
		                            xtype: 'datefield',
		                            format: 'd/m/Y',
									flex: 1,
		                            id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
		                            name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date',
		                            margins: '0 5 0 0',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
									allowBlank: true,<?php }?>
		                            hideLabel: true
		                        },
		                        {
		                            xtype: 'textfield',
		                            mask: '99:99:99',
									plugins: 'textmask',
									returnWithMask: true,
									flex: 1,
		                            id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
		                            name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
									allowBlank: true,<?php }?>
		                            hideLabel: true
		                        }
		                    ]
		                },
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['tipo_real']=='date'){?>
		                {
							xtype: 'datefield',
							format: 'd/m/Y',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
							allowBlank: true,<?php }?>								
							name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
							id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							anchor: '100%',
							fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
						},
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['tipo_real']=='time'){?>
						{
							xtype: 'textfield',
                            mask: '99:99:99',
							returnWithMask: true,
							plugins: 'textmask',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
							allowBlank: true,<?php }?>								
							name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
							id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							anchor: '100%',
							fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
						},
<?php }?><?php }?><?php }?>
<?php } ?>
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							allowBlank: false,
							value: 'FILTER',
							anchor: '100%'
						}
                    ]
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    items: [
                        {
                            xtype: 'tbfill'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_cancel',
                            action: 'resetar_filtro',
                            text: '<?php echo $_smarty_tpl->tpl_vars['button_reset_filtro']->value;?>
'
                        },
                        {
                            xtype: 'button',
                            iconCls: 'bt_lupa',
                            action: 'filtrar_busca',
                            text: '<?php echo $_smarty_tpl->tpl_vars['button_filtrar']->value;?>
'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});
<?php }} ?>