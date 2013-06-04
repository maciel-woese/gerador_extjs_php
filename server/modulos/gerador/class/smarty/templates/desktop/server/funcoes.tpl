<?php 

define('REMOVED_SUCCESS', '{$REMOVED_SUCCESS}');
define('SAVED_SUCCESS', '{$SAVED_SUCCESS}');
define('ERRO_DELETE_DATA', '{$ERRO_DELETE_DATA}');
define('ERROR_SAVE_DATA', '{$ERROR_SAVE_DATA}');
define('ACTION_NOT_FOUND', '{$ACTION_NOT_FOUND}');

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
		return utf8_encode("{$ERROR_1451}");
	}
	else if($error[1]==1062){
		preg_match("/'(.*)' for key/", $msg, $matches);
		$entry = $matches[1];
		return utf8_encode("{$ENTRADA_ERROR} '$entry' {$EXISTE_ERROR}!");
	}
	else{
		return ERRO_DELETE_DATA;
	}
}

?>