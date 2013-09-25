<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:54
         compiled from "class/smarty/templates/touch/view/filtro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7264235352330632749f00-43899404%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd37ae01955747605166a5e09aa4921be2047088' => 
    array (
      0 => 'class/smarty/templates/touch/view/filtro.tpl',
      1 => 1352429832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7264235352330632749f00-43899404',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'TABELA' => 0,
    'button_back' => 0,
    'reset_form' => 0,
    'button_filtrar' => 0,
    'form' => 0,
    'field' => 0,
    'hora' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52330632cc6221_51326084',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52330632cc6221_51326084')) {function content_52330632cc6221_51326084($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>
Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Filtro', {
    extend: 'Ext.form.Panel',
    alias: 'widget.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
filter',

    config: {
        fullscreen: true,
        scrollable: true,
        id: 'Form<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
Filter',
        url: 'server/modulos/<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
/list.php',
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
						action: 'back'
                    }
                ]
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                items: [
                    {
                        xtype: 'spacer'
                    },
					{
                        xtype: 'button',
                        ui: 'decline',
						action: 'reset',
                        text: '<?php echo $_smarty_tpl->tpl_vars['reset_form']->value;?>
'
                    },
                    {
                        xtype: 'button',
                        ui: 'confirm',
						action: 'filter',
                        text: '<?php echo $_smarty_tpl->tpl_vars['button_filtrar']->value;?>
'
                    }
                ]
            },
            {
                xtype: 'fieldset',
                items: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['comboLocal']!=''){?>
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
								name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
								loadDisabled: true,
								id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
								button_id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
								store: 'StoreCombo<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['nome']);?>
<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
								flex: 1,
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
								required: true,<?php }?>
								label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
'
							},
							{
								xtype: 'button',
								iconCls: 'delete',
								hidden: true,
								iconMask: true,
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
<?php }?>	
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='text'&&$_smarty_tpl->tpl_vars['field']->value['mask']==''&&$_smarty_tpl->tpl_vars['field']->value['inputType']==''&&$_smarty_tpl->tpl_vars['field']->value['comboLocal']==''){?>
					{
                        xtype: 'textfield',
						id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                        label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
',
						name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'
                    },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='number'&&$_smarty_tpl->tpl_vars['field']->value['mask']==''&&$_smarty_tpl->tpl_vars['field']->value['inputType']==''&&$_smarty_tpl->tpl_vars['field']->value['comboLocal']==''){?>
					{
                        xtype: 'numberfield',
						id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                        label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
',
						name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'
                    },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']!=''&&$_smarty_tpl->tpl_vars['field']->value['comboLocal']==''&&$_smarty_tpl->tpl_vars['field']->value['inputType']==''){?>
					{
                        xtype: 'maskfield',
						id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
						tipo: '<?php echo $_smarty_tpl->tpl_vars['field']->value['mask'];?>
',
                        label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
',
						name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'
                    },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['inputType']!=''){?>
					{
                        xtype: 'passwordfield',
                        label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
',
						id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
						name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'
                    },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='combo'){?>
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'selectfield',
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
								label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
'
							},
							{
								xtype: 'button',
								iconCls: 'compose',
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
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'&&$_smarty_tpl->tpl_vars['field']->value['tipo_real']=='date'){?>
					{
                        xtype: 'datepickerfield',
						id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
						name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
						required: true,<?php }?>
						label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
'
                    },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'&&$_smarty_tpl->tpl_vars['field']->value['tipo_real']=='time'){?>
					{
                        xtype: 'maskfield',
						tipo: 'hora',
						id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
						name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
						required: true,<?php }?>
						label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
'
                    },
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'&&$_smarty_tpl->tpl_vars['field']->value['tipo_real']=='timestamp'){?>
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'datepickerfield',
                                margin: '0 10 0 0',
                                label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
',
								name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date',
								id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
								required: true,<?php }?>
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: '<?php echo $_smarty_tpl->tpl_vars['hora']->value;?>
',
                                style: 'border-bottom: 1px solid #DDD;',
								name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time',
								id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
								required: true,<?php }?>
								flex: 1
							}
						]
					},
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'&&$_smarty_tpl->tpl_vars['field']->value['tipo_real']=='datetime'){?>
					{
						xtype: 'container',
						layout: {
							align: 'stretch',
							type: 'hbox'
						},
						items: [
							{
								xtype: 'datepickerfield',
                                margin: '0 10 0 0',
                                label: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['label']);?>
',
								name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date',
								id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
								required: true,<?php }?>
								flex: 1
							},
							{
								xtype: 'maskfield',
								tipo: 'hora',
								label: 'Hora',
                                style: 'border-bottom: 1px solid #DDD;',
								name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time',
								id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>
								required: true,<?php }?>
								flex: 1
							}
						]
					},
<?php }?>
<?php } ?>
					{
						xtype: 'hiddenfield',
						name: 'action',
						hidden: true,
						id: 'action_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
						required: false,
						value: 'FILTER'
					}
                ]
            }
        ]
    }

});


<?php }} ?>