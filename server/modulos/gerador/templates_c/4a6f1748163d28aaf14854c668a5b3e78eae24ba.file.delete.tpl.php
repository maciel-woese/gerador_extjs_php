<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:09
         compiled from "class/smarty/templates/desktop/server/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98289928452457e11f11681-14961391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a6f1748163d28aaf14854c668a5b3e78eae24ba' => 
    array (
      0 => 'class/smarty/templates/desktop/server/delete.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98289928452457e11f11681-14961391',
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
  'unifunc' => 'content_52457e1201aba8_62597490',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e1201aba8_62597490')) {function content_52457e1201aba8_62597490($_smarty_tpl) {?><<?php ?>?php
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