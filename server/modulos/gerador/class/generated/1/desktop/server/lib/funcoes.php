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
	$data = explode('/',$data);
	return "{$data[2]}-{$data[1]}-{$data[0]}";
}

function mascara($mascara, $string){
	$string = str_replace(" ","",$string);
	for($i=0;$i<strlen($string);$i++){
		$mascara[strpos($mascara,"#")] = $string[$i];
	}
	return $mascara;
}

?>