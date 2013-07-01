<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/server/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142372318551d18a17a84749-47009722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1316aac3439727cd502aec8c5722c338c1816187' => 
    array (
      0 => 'class/smarty/templates/padrao/server/delete.tpl',
      1 => 1353436248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142372318551d18a17a84749-47009722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'TABELA' => 0,
    'permissoes' => 0,
    'CHAVE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a17ae71a4_48947409',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17ae71a4_48947409')) {function content_51d18a17ae71a4_48947409($_smarty_tpl) {?><<?php ?>?php
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
		if($_POST['action'] == 'DELETAR'){
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>		
			$user->getAcao($tabela, 'deletar');
<?php }?>		
			$pdo = $connection->prepare("DELETE FROM <?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
 WHERE <?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
 = ?");
			$pdo->execute(array(
				$_POST['id']
			));
			
			echo json_encode(array('success'=>true, 'msg'=>REMOVED_SUCCESS));
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERRO_DELETE_DATA, 'erro'=>$e->getMessage()));
	}
}<?php }} ?>