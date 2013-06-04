<?php
class Buscar{
	private $sql = array();
	private $arrayExecute = array();
	private $filtro = 'WHERE';

	function __construct($boolean=true){
		if($boolean == false){
			$this->filtro = 'AND';
		}
	}

	function setBusca($campoArray, $valor, $metodo=null){
			
		$paramCampo = $campoArray[0];
		$campoBanco = $campoArray[0];
			
		if(count($campoArray) == 2){
			$campoBanco = $campoArray[1];
		}
			
		if( !empty($valor) ){

			if($metodo == 'like'){
				$this->sql[] = "{$campoBanco} LIKE :{$paramCampo}";
				$this->arrayExecute[':'.$paramCampo] = '%'.$valor.'%';
			}
			else if($metodo == 'date'){
				$this->sql[] = "TO_CHAR({$campoBanco}, 'YYYY-MM-DD')::date = :{$paramCampo}";
				$this->arrayExecute[':'.$paramCampo] = $valor;
			}
			else if($metodo == 'isnull'){
				$this->sql[] = "{$campoBanco} IS NULL :{$paramCampo}";
				$this->arrayExecute[':'.$paramCampo] = $valor;
			}
			else if($metodo == 'diff'){
				$this->sql[] = "{$campoBanco} != :{$paramCampo}";
				$this->arrayExecute[':'.$paramCampo] = $valor;
			}
			else{
				$this->sql[] = "{$campoBanco} = :{$paramCampo}";
				$this->arrayExecute[':'.$paramCampo] = $valor;
			}
		}
	}
	
	function setSql($sql){
		$this->sql[] = $sql;
	}
	function setArrayExecute($paramCampo, $valor){
		$this->arrayExecute[':'.$paramCampo] = $valor;
	}

	function getSql(){
		if(count($this->sql) > 0){
			return $this->filtro.' '.implode($this->sql, ' AND ');
		} else
			return null;
	}

	function getArrayExecute(){
		if(count($this->arrayExecute) > 0){
			return $this->arrayExecute;
		} else
			return null;
	}
}