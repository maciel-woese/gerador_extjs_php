<?php 
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

define('REMOVED_SUCCESS', 'Removido com Sucesso');
define('SAVED_SUCCESS', 'Salvo com Sucesso');
define('ERRO_DELETE_DATA', 'Erro ao Deletar Dados');
define('ERROR_SAVE_DATA', 'Erro ao Salvar Dados');
define('ACTION_NOT_FOUND', 'Ação Não Encontrada');

?>