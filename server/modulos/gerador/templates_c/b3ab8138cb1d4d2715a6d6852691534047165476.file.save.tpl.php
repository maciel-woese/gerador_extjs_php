<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/server/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90104593851d18a17af0c99-11975310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3ab8138cb1d4d2715a6d6852691534047165476' => 
    array (
      0 => 'class/smarty/templates/padrao/server/save.tpl',
      1 => 1353436278,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90104593851d18a17af0c99-11975310',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'TABELA' => 0,
    'permissoes' => 0,
    'variaveis' => 0,
    'field' => 0,
    'CHAVE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a17c0a552_45075092',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17c0a552_45075092')) {function content_51d18a17c0a552_45075092($_smarty_tpl) {?><<?php ?>?php
<?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

if($_POST){
	require('../../autoLoad.php');
	$tabela = '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
';
	try {
		
		if($_POST['action'] == 'EDITAR'){
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>		
			$user->getAcao($tabela, 'editar');
<?php }?>		
			$pdo = $connection->prepare("
					UPDATE <?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
 SET 
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variaveis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['variaveis']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['variaveis']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['variaveis']['index']++;
?>
							<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
 = ?<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['variaveis']['total'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['variaveis']['index']!=$_tmp1-1){?>,<?php }?>
							
<?php } ?> 					WHERE <?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
 = ?
			");
			$params = array(
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variaveis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='date'){?>				implode('-', array_reverse(explode('/', $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']))),
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='datetime'||$_smarty_tpl->tpl_vars['field']->value['tipo']=='timestamp'){?>				implode('-', array_reverse(explode('/', $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date'])))." ".$_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time'],
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']!='date'&&$_smarty_tpl->tpl_vars['field']->value['tipo']!='timestamp'&&$_smarty_tpl->tpl_vars['field']->value['tipo']!='datetime'){?>
				$_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'],
<?php }?>
<?php } ?>
				$_POST['<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>		
			$user->getAcao($tabela, 'adicionar');
<?php }?>		
			$pdo = $connection->prepare("
				INSERT INTO <?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
 
					(
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variaveis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
						<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['total'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']!=$_tmp2-1){?>,<?php }?>
						
<?php } ?>
					) 
				VALUES 
					(
					<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variaveis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo5']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo5']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo5']['index']++;
?>
	?<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo5']['total'];?>
<?php $_tmp3=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo5']['index']!=$_tmp3-1){?>,<?php }?>
<?php } ?>			
					)
			");
			$params = array(
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['variaveis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['field']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['total'] = $_smarty_tpl->tpl_vars['field']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['index']++;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='date'){?>				implode('-', array_reverse(explode('/', $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'])))<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['total'];?>
<?php $_tmp4=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']!=$_tmp4-1){?>,<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='datetime'||$_smarty_tpl->tpl_vars['field']->value['tipo']=='timestamp'){?>				implode('-', array_reverse(explode('/', $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date'])))." ".$_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time']<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['total'];?>
<?php $_tmp5=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']!=$_tmp5-1){?>,<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']!='date'&&$_smarty_tpl->tpl_vars['field']->value['tipo']!='timestamp'&&$_smarty_tpl->tpl_vars['field']->value['tipo']!='datetime'){?>
				$_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['total'];?>
<?php $_tmp6=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']!=$_tmp6-1){?>,<?php }?>
<?php }?>		
<?php } ?>
			);
			$pdo->execute($params);
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}<?php }} ?>