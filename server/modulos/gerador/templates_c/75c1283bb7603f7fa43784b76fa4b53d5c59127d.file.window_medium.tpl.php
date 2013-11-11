<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:08
         compiled from "class/smarty/templates/desktop/view/window_medium.tpl" */ ?>
<?php /*%%SmartyHeaderCode:209875095852457e10e26e76-63232635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75c1283bb7603f7fa43784b76fa4b53d5c59127d' => 
    array (
      0 => 'class/smarty/templates/desktop/view/window_medium.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209875095852457e10e26e76-63232635',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'TABELA' => 0,
    'title_window' => 0,
    'form' => 0,
    'field_form' => 0,
    'field' => 0,
    'CHAVE' => 0,
    'reset_form' => 0,
    'button_save' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e1160e2e2_73421301',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e1160e2e2_73421301')) {function content_52457e1160e2e2_73421301($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
.Edit', {
    extend: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.view.WindowMedium',
	alias: 'widget.add<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
win',

    id: 'Add<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
Win',
    layout: {
        type: 'fit'
    },
	maximizable: false,
    minimizable: true,
    title: '<?php echo $_smarty_tpl->tpl_vars['title_window']->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',

    initComponent: function() {
        var me = this;


        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'form',
                    id: 'Form<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
',
                    bodyPadding: 10,
                    autoScroll: true,
                    method: 'POST',
                    url : 'server/modulos/<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
/save.php',
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
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
											button_id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
											flex: 1,
											anchor: '100%',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
											allowBlank: true,<?php }?>
											
											fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
		                                    combo_id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
		                                    action: 'reset_combo'
		                                }
		                            ]
		                        }<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['index']==0&&$_smarty_tpl->getVariable('smarty')->value['foreach']['form_field']['total']>1){?>,<?php }?>

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
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									anchor: '100%',<?php if ($_smarty_tpl->tpl_vars['field']->value['inputType']!=''){?>				
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
										if(value!="" && !isEmail(value)){
											return 'E-mail Inválido...';
										}
										else{
											return true;
										}
									},<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
									allowBlank: true,<?php }?>									
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
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
									anchor: '100%',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
									allowBlank: true,<?php }?>
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
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
											button_id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
											flex: 1,
											anchor: '100%',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
											allowBlank: true,<?php }?>
											fieldLabel: '<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
'
										},
		                                {
		                                    xtype: 'buttonadd',
		                                    iconCls: 'bt_cancel',
		                                    hidden: true,
		                                    id: 'button_<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
		                                    combo_id: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
		                                    action: 'reset_combo'
		                                },
		                                {
		                                    xtype: 'buttonadd',
											tabela: '<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value['store']);?>
',
											action: 'add_win'
		                                }
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
_date_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
											name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date',
											margins: '0 5 0 0',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
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
_time_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
											name: '<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time',<?php if ($_smarty_tpl->tpl_vars['field']->value['required']!=true){?>									
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
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
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
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
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
							name: '<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
',
							hidden: true,
							id: '<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							value: 0,
							anchor: '100%'
						},
						{
							xtype: 'hidden',
							name: 'action',
							hidden: true,
							id: 'action_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
							value: 'INSERIR',
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
                            xtype: 'tbseparator'
                        },
                        {
                            xtype: 'button',
                            id: 'button_resetar_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                            iconCls: 'bt_cancel',
                            action: 'resetar',
                            text: '<?php echo $_smarty_tpl->tpl_vars['reset_form']->value;?>
'
                        },
                        {
                            xtype: 'button',
                            id: 'button_salvar_<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
',
                            iconCls: 'bt_save',
                            action: 'salvar',
                            text: '<?php echo $_smarty_tpl->tpl_vars['button_save']->value;?>
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