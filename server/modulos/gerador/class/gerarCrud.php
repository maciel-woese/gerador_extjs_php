<?php
require_once("arquivo.php");
require_once("../../locale/{$_SESSION['language']}.php");
require_once("smarty/libs/Smarty.class.php");
require_once("class/modelos/".$_SESSION['tipo_layout']."/App.php");
require_once("class/modelos/".$_SESSION['tipo_layout']."/Server.php");

class ExtMVC {
	public $server  = null;
	public $app		= null;
	public $arquivo	= null;
	public $dados	= array();

	function __construct($parametros) {
		$this->smarty 	= new Smarty();
		
		$this->smarty->template_dir = "templates/";
		
		$this->dados['fields'] = array();
		$this->dados['variaveis'] = array();
		$this->dados['campos'] = array();
		$this->dados['camposNomeType'] = array();
		$this->dados['form'] = array();
		$this->dados['variaveisClass'] = array();
		$this->dados['foreignClass'] = array();
		
		$this->dados['app'] 		= $parametros['app'];
		$this->dados['autor'] 		= $parametros['autor'];
		$this->dados['versao']   	= $parametros['versao'];
		$this->dados['tipo_banco'] 	= $parametros['tipo_banco'];
		$this->dados['permissoes'] 	= $parametros['permissoes'];
		$this->dados['banco'] 		= $parametros['banco'];
		$this->dados['pdf'] 		= $parametros['pdf'];
		$this->dados['host'] 		= $parametros['host'];
		$this->dados['user'] 		= $parametros['user'];
		$this->dados['senha'] 		= $parametros['senha'];
		$this->dados['titulo'] 		= $parametros['titulo'];
		
		unset($_SESSION['TABLES_INSERTED']);
    }
    
    function resetVars(){
    	$this->dados['fields'] = array();
    	$this->dados['variaveis'] = array();
    	$this->dados['campos'] = array();
    	$this->dados['camposNomeType'] = array();
    	$this->dados['columns'] = array();
    	$this->dados['form'] = array();
    	$this->dados['store'] = array();
    	$this->dados['variaveisClass'] = array();
    	$this->dados['foreignClass'] = array();
    	$this->dados['tabela'] = '';
    	$this->dados['gerarPDF'] = false;
    	$this->dados['Unique'] = false;
    	$this->dados['comboClass'] = false;
    	$this->dados['comboStore'] = false;
    	$this->dados['storeControls'] = array();
    	$this->dados['storeLocal'] = array();
    	$this->dados['data'] = array();
    }

	function init($dados){
		$this->resetVars();
		$arquivo		= new Arquivo();
		
		$this->app 		= new App($this->smarty, $dados['tabela'], $this->dados, $arquivo);
		$this->server 	= new Server($this->smarty, $dados['tabela'], $this->dados, $arquivo);
		
		$this->dados['tabela'] = $dados['tabela'];
		$_SESSION['TABLES_INSERTED'][] = $dados['tabela'];
		$this->dados['AllTables'][] = $dados['tabela'];
		
		if($dados['store']!=false){
			$this->dados['store'] = array(array('type'=>'normal'),array('type'=>'combo'));
			$this->dados['comboStore'] = array($dados['store']);
			$this->dados['comboClass'] = true;
			
			$this->app->gerarCombo($dados['store']);
		}
		
		$x = $this->setFields($dados['fields']);
		
		if(is_array($this->dados['pdf'])){
			foreach($this->dados['pdf'] as $tab){
				if($tab==$this->dados['tabela']){
					$this->dados['gerarPDF'] = true;
				}
			}
		}
		$this->app->init($this->dados);
		$this->server->init($this->dados);
		
		if($x){
			$this->app->gerarApp();
			$this->server->gerarServer();
			return true;
		}
		else{
			die('Erro!');
		}
		return false;
	}

	public function setFields($a){
		
		for($i=0;$i<count($a);$i++){
			
			if($a[$i]['chave']==true){
				$this->dados['chave'] = $a[$i]['nome'];
				
				$this->dados['columns'][] = array(
						'xtype'=> $a[$i]['xtypeGrid'],
						'xtypeWindow'=> '',
						'dataIndexPDF'=> '',
						'dataIndex'=> $a[$i]['nome'],
						'title'=>$a[$i]['nome_campo'],
						'hidden'=> $a[$i]['hidden'],
						'mask'=> $a[$i]['mask'],
						'renderer'=> 'false'
				);
				
				$this->dados['fields'][] = array(
					'nome'=> $a[$i]['nome'], 
					'type'=> $a[$i]['type'], 
					'format'=> "", 
					'xtype'=>'primary'
				);
			}
			else{
				if($a[$i]['unique']==true){
					$this->dados['Unique'] = $a[$i]['unique'];
				}
				if($a[$i]['foreign']==false){
					if($a[$i]['tipo_real']=='datetime' or
					   $a[$i]['tipo_real']=='timestamp' or 
					   $a[$i]['tipo_real']=='date' or 
					   $a[$i]['tipo_real']=='time' 
					){
						$tipo = $a[$i]['tipo_real']; 
					}
					else{
						$tipo = $a[$i]['type'];
					}
					$this->dados['variaveisClass'][] = array(
						'nome'=>$a[$i]['nome'], 
						'tipo'=>$tipo
					);
				}
				else{
					$this->dados['foreignClass'][] = array(
						'tab_ref'=>$a[$i]['tab_ref'],
						'col_ref_v'=>$a[$i]['col_ref_v'],
						'col_ref_l'=>$a[$i]['nome'],
						'required'=> $a[$i]['required'],
						'label'=>$a[$i]['nome_campo'],
						'value'=>$a[$i]['col_v']
					);
				}
				
				$this->dados['variaveis'][] = $a[$i]['nome'];
				
				$format = "";
				$format2 = "";
				$timer = "";
				if($a[$i]['tipo_real']=='datetime' or $a[$i]['tipo_real']=='timestamp'){
					$format = "Y-m-d H:i:s";
					$format2 = "d/m/Y H:i:s";
					$timer = 'datetime';
					$this->dados['fields'][] = array(
						'nome'  => $a[$i]['nome']."_time",
						'type'  => $a[$i]['type'],
						'format'=> "H:i:s",
						'timer' => 'time',
						'nome_real' => $a[$i]['nome'],
						'xtype' => $a[$i]['xtypeWindow']
					);
					
					$this->dados['fields'][] = array(
						'nome'  => $a[$i]['nome']."_date",
						'type'  => $a[$i]['type'],
						'format'=> "Y-m-d",
						'timer' => 'date',
						'nome_real' => $a[$i]['nome'],
						'xtype' => $a[$i]['xtypeWindow']
					);
				}
				else if($a[$i]['tipo_real']=='date'){
					$format = "Y-m-d";
					$format2 = "d/m/Y";
					$timer = 'date';
				}
				else if($a[$i]['tipo_real']=='time'){
					$format = "H:i:s";
					$format2 = "H:i:s";
					$timer = 'time';
				}
				
				$this->dados['fields'][] = array(
					'nome'  => $a[$i]['nome'], 
					'type'  => $a[$i]['type'], 
					'timer' => $timer,
					'format'=> $format, 
					'nome_real' => $a[$i]['nome'],
					'xtype' => $a[$i]['xtypeWindow']
				);
				
				$local = "";
				if(isset($a[$i]['comboLocal'])){
					$local = trim($a[$i]['comboLocal']);
				}
				
				$data = 'false';
				
				if(!empty($local)){
					$data = array();
					$json = json_decode($a[$i]['comboLocal'], true);
					
					if($json==false){
						$json = stripslashes($a[$i]['comboLocal']);
						$json = json_decode($json, true);
						if($json==false){
							die(json_encode(array('success'=>false, 'msg'=> "Erro Interno 222.")));
						}
					}
					
					foreach ($json as $row){
						$row['descricao'] = $row['descricao'];
						$data[] = $row;
					}
					$campo = $this->app->arquivo->setUpperTabela($a[$i]['nome']);
					$sl = $this->app->initStoreComboLocal($campo,  $data, $a[$i]['tabela']);
					$this->app->arquivo->create($sl, 'storecombolocal', $a[$i]['nome']);
					
					$mc = $this->app->initModelCombo(true);
					$this->app->arquivo->create($mc, 'modelcombo', false,'ModelComboLocal');
					
					$tabela = $this->app->arquivo->setUpperTabela($a[$i]['tabela']);
					
					$this->dados['storeLocal'][] = array(
						'store'=> "{$campo}{$tabela}"
					);
				}
				else{
					if($a[$i]['xtypeWindow']=='combo'){
						$tabela = $this->app->arquivo->setUpperTabela($a[$i]['combo']);
						$this->dados['storeLocal'][] = array(
							'store'=> "{$tabela}"
						);
					}
				}

				if($a[$i]['xtypeWindow']!=false){
					if($a[$i]['inputType']=='password'){
					}
					else{
						$this->dados['campos'][] = $a[$i]['nome'];
						$this->dados['camposNomeType'][] = array(
							'nome'	=>$a[$i]['nome'], 
							'format'=>$timer, 
							'tipo'	=>$a[$i]['xtypeWindow'], 
							'tabela'=>$a[$i]['tabela']
						);
					}
				}
				
				$this->dados['columns'][] = array(
					'xtype'=> $a[$i]['xtypeGrid'],
					'xtypeWindow'=>$a[$i]['xtypeWindow'],
					'dataIndex'=> $a[$i]['nome'],
					'format'=> $format2,
					'formatNome'=> $a[$i]['tipo_real'],
					'dataIndexPDF'=> $a[$i]['dataIndexPDF'],
					'title'=>$a[$i]['nome_campo'],
					'hidden'=> $a[$i]['hidden'],
					'mask'=> $a[$i]['mask'],
					'renderer'=> $data
				);
				
				$this->dados['form'][] = array(
					'xtype'=>$a[$i]['xtypeWindow'],
					'nome'=>$a[$i]['nome'],
					'label'=>$a[$i]['nome_campo'],
					'unique'=>$a[$i]['unique'],
					'tipo_real'=>$a[$i]['tipo_real'],
					'inputType'=> isset($a[$i]['inputType']) ? $a[$i]['inputType'] : '',
					'validate'=> isset($a[$i]['validate']) ? $a[$i]['validate'] : '',
					'comboLocal'=> isset($a[$i]['comboLocal']) ? $a[$i]['comboLocal'] : '',
					'mask'=> $a[$i]['mask'],
					'store'=> $a[$i]['combo'],
					'required'=> $a[$i]['required'],
					'tabela'=>$a[$i]['tabela']
				);
			}
		}
		return true;
	}
}

?>
