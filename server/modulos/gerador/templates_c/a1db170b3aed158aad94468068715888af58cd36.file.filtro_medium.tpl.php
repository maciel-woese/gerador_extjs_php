<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:08
         compiled from "class/smarty/templates/desktop/view/filtro_medium.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8965683152457e106e4e89-07049775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1db170b3aed158aad94468068715888af58cd36' => 
    array (
      0 => 'class/smarty/templates/desktop/view/filtro_medium.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8965683152457e106e4e89-07049775',
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
    'field_form' => 0,
    'field' => 0,
    'button_reset_filtro' => 0,
    'button_filtrar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e10d3bc36_88266558',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e10d3bc36_88266558')) {function content_52457e10d3bc36_88266558($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Filtro', {
    extend: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.WindowMedium',
    alias: 'widget.filter<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win',

    id: 'Filter<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
Win',
    layout: {
        type: 'fit'
    },
    modal: true,
    minimizable: false,
	
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
<?php  $_smarty_tpl->tpl_vars['field_form'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field_form']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['form']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field_form']->key => $_smarty_tpl->tpl_vars['field_form']->value){
$_smarty_tpl->tpl_vars['field_form']->_loop = true;
?>
						{
							xtype: 'fieldcontainer',
							autoHeight: true,
<?php if (count($_smarty_tpl->tpl_vars['field_form']->value)==1){?>
							anchor: '50%',
							margins: '0 5 0 0',
<?php }?>
							layout: {
								align: 'stretch',
								type: 'hbox'
							},
							items: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field_form']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form_field']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form_field']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['form_field']['index']++;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['comboLocal']!=''){?>
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
								    
								    margin: '0 5 0 0',<?php }else{ ?>
								    <?php }?>
								    
								    flex: 1,
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
											loadDisabled: true,
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
		                        }<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0){?>,<?php }?>
								
<?php }else{ ?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='text'){?>
								{
									xtype: 'textfield',
									name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
									
								    margin: '0 5 0 0',<?php }else{ ?>
								    <?php }?>
								    
								    flex: 1,
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
<?php if ($_smarty_tpl->tpl_vars['field']->value['unique']==true){?>
									enableKeyEvents: true,
									listeners: {
										blur: function(obj, event){
											var v = obj.getValue();
											Ext.Ajax.request({
												url: 'server/modulos/<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
/list.php',
												method: 'POST',
												params:{
													action: 'VALID_UNIQUE',
													param: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
													valor: this.getValue()
												},
												success: function(s, o){
													var dados = Ext.decode(s.responseText);
													if(dados.success==false){
														Ext.getCmp('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
').markInvalid('Usuário Ja Existe...');
													}
												}
											});
										}
									},<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['validate']=='email'){?>
		
									validator: function(value){
										if(!isEmail(value)){
											return 'E-mail Inválido...';
										}
										else{
											return true;
										}
									},<?php }?>																											
									allowBlank: false,
									anchor: '100%',
									fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
								}<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>
								
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['xtype']=='number'){?>
								{
									xtype: 'numberfield',
									name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
								    
								    margin: '0 5 0 0',<?php }else{ ?>
								    <?php }?>
								    
								    flex: 1,
									id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									anchor: '100%',
									fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
								}<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>
								
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['xtype']=='combo'){?>
								{
		                            xtype: 'fieldcontainer',
		                            autoHeight: true,<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
								    
								    margin: '0 5 0 0',<?php }else{ ?>
								    <?php }?>
								    
								    flex: 1,
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
		                                },
		                            ]
		                        }<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>
		                        
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo_real']=='datetime'||$_smarty_tpl->tpl_vars['field']->value['tipo_real']=='timestamp'){?>
								{
									xtype: 'fieldcontainer',
									anchor: '100%',
									layout: {
										align: 'stretch',
										type: 'hbox'
									},<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
									
									margin: '0 5 0 0',<?php }else{ ?>
									<?php }?>
									
									flex: 1,
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
								}<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>
								
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['tipo_real']=='date'){?>
								{
									xtype: 'datefield',
									format: 'd/m/Y',<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
									
									margin: '0 5 0 0',<?php }else{ ?>
									<?php }?>
									
									flex: 1,<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
									allowBlank: true,<?php }?>								
									name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
									id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									anchor: '100%',
									fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
								}<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>
								
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['tipo_real']=='time'){?>
								{
									xtype: 'textfield',
									mask: '99:99:99',
									returnWithMask: true,
									plugins: 'textmask',<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>
									
									margin: '0 5 0 0',<?php }else{ ?>
									<?php }?>
									
									flex: 1,<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
									allowBlank: true,<?php }?>								
									name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
',
									id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_filter_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									anchor: '100%',
									fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
								}<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>
								
<?php }?><?php }?><?php }?>
<?php } ?>

							]
						},
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