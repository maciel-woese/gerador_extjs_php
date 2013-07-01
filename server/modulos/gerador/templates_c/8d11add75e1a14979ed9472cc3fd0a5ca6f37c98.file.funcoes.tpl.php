<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/server/funcoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37425371751d18a180f2d26-98366557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d11add75e1a14979ed9472cc3fd0a5ca6f37c98' => 
    array (
      0 => 'class/smarty/templates/padrao/server/funcoes.tpl',
      1 => 1353512568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37425371751d18a180f2d26-98366557',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'REMOVED_SUCCESS' => 0,
    'SAVED_SUCCESS' => 0,
    'ERRO_DELETE_DATA' => 0,
    'ERROR_SAVE_DATA' => 0,
    'ACTION_NOT_FOUND' => 0,
    'ERROR_1451' => 0,
    'ENTRADA_ERROR' => 0,
    'EXISTE_ERROR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a18118921_09672272',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a18118921_09672272')) {function content_51d18a18118921_09672272($_smarty_tpl) {?><<?php ?>?php 

define('REMOVED_SUCCESS', '<?php echo $_smarty_tpl->tpl_vars['REMOVED_SUCCESS']->value;?>
');
define('SAVED_SUCCESS', '<?php echo $_smarty_tpl->tpl_vars['SAVED_SUCCESS']->value;?>
');
define('ERRO_DELETE_DATA', '<?php echo $_smarty_tpl->tpl_vars['ERRO_DELETE_DATA']->value;?>
');
define('ERROR_SAVE_DATA', '<?php echo $_smarty_tpl->tpl_vars['ERROR_SAVE_DATA']->value;?>
');
define('ACTION_NOT_FOUND', '<?php echo $_smarty_tpl->tpl_vars['ACTION_NOT_FOUND']->value;?>
');

function formatObservacao($observacao, $usuario){
	if( !empty($observacao) ){
		$autenticacao = date("d/m/Y H:i:s").' - '.$usuario->getNome();
		$observacao = $observacao."\n".$autenticacao."\n\n";
	} else{
		$observacao = null;
	}
	return $observacao;
}

function formatData($data){
	return implode('-', array_reverse(explode('/',$data)));
}

function mascara($mascara, $string){
	$string = str_replace(" ","",$string);
	for($i=0;$i<strlen($string);$i++){
		$mascara[strpos($mascara,"#")] = $string[$i];
	}
	return $mascara;
}


function getMsgError($error){
	if($error[1]==1451){
		return utf8_encode("<?php echo $_smarty_tpl->tpl_vars['ERROR_1451']->value;?>
");
	}
	else if($error[1]==1062){
		preg_match("/'(.*)' for key/", $msg, $matches);
		$entry = $matches[1];
		return utf8_encode("<?php echo $_smarty_tpl->tpl_vars['ENTRADA_ERROR']->value;?>
 '$entry' <?php echo $_smarty_tpl->tpl_vars['EXISTE_ERROR']->value;?>
!");
	}
	else{
		return ERRO_DELETE_DATA;
	}
}

?<?php ?>><?php }} ?>