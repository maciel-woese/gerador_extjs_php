<?php
	class Server {
		public $smarty  = null;
		public $arquivo = null;
		public $tabela	= null;
		public $dirApp  = 'class/generated/applicationTouchMVC/';
		public $dirTpl  = 'class/smarty/templates/touch/';
		public $dados 	= array();
		
		public function Server($smarty, $tabela, $dados, $arquivo){
			$this->dirApp = "class/generated/{$_SESSION['id_usuario']}/touch/";
			
			if($this->smarty==null){
				$this->smarty 	= $smarty;
			}
			$this->tabela	= $tabela;
			$this->dados 	= $dados;
			$this->arquivo  = $arquivo;
		}
		
		public function init($dados){
			$this->dados = $dados;
		}
		
		public function gerarServer(){
			$phpL = $this->initList();
			$phpD = $this->initDelete();
			$phpS = $this->initSave();
			
			$this->arquivo->create($phpL, 'list');
			$this->arquivo->create($phpD, 'delete');
			$this->arquivo->create($phpS, 'save');
			
			if($this->dados['gerarPDF']==true){
				$phpPDF = $this->initPDF();
				$this->arquivo->create($phpPDF, 'pdf');
			}
		}
		
		/**
		*	@Copilar Template List
		*	@return List Copilado
		*/
		public function initList(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);
			$this->smarty->assign('schema', $_SESSION['SCHEMA_SERVER']);
			$this->smarty->assign('campos', $this->dados['camposNomeType']);
			$this->smarty->assign('comboStore', $this->dados['comboStore']);
			$this->smarty->assign('unique', $this->dados['Unique']);
			$this->smarty->assign('param', '{$_POST[\'param\']}');
			
			$this->smarty->assign('filtro', '{$filtro}');
			$this->smarty->assign('order', '{$order}');
			$this->smarty->assign('sort', '{$sort}');
			$this->smarty->assign('limit', '{$limit}');
			$this->smarty->assign('start', '{$start}');
			$this->smarty->assign('app', $this->dados['app']);

			$tables_cols = $this->tabela.'.*';
			$tables_from = $this->tabela;
			$datas = "";
			foreach($this->dados['fields'] as $f){
				if(isset($f['format']) and !empty($f['format'])){
					if($f['nome']==$f['nome_real']){
						continue;
					}
					if($f['timer']=='time'){
						$tables_cols .= ", 
					DATE_FORMAT({$tables_from}.{$f['nome_real']}, '%H:%i:%s') as {$f['nome']}";
					$datas .= ", 
					DATE_FORMAT({$f['nome_real']}, '%H:%i:%s') as {$f['nome']}";
					}
					else if($f['timer']=='date'){
						$tables_cols .= ", 
					DATE_FORMAT({$tables_from}.{$f['nome_real']}, '%Y-%m-%d') as {$f['nome']}";
						$datas .= ", 
					DATE_FORMAT({$f['nome_real']}, '%Y-%m-%d') as {$f['nome']}";
					}
					else if($f['timer']=='datetime'){
						$tables_cols .= ",
					DATE_FORMAT({$f['nome_real']}, '%Y-%m-%d %H:%i:%s') as {$f['nome']}";
						$datas .= ",
					DATE_FORMAT({$f['nome_real']}, '%Y-%m-%d %H:%i:%s') as {$f['nome']}";
					}
				}
			}
			
			if(count($this->dados['foreignClass'])==0){
				
			}
			else{
				for($i=0;$i<count($this->dados['foreignClass']);$i++){
					$f = $this->dados['foreignClass'];
					$tables_cols .= ', '.$f[$i]['tab_ref'].'.'.$f[$i]['col_ref_l'];
					if($f[$i]['required']==true){
						$join = " INNER";
					}
					else{
						$join = " LEFT";
					}
					$tables_from .= $join.' JOIN '.$f[$i]['tab_ref'].' ON
					('.$this->tabela.'.'.$f[$i]['value'].'='.$f[$i]['tab_ref'].'.'.$f[$i]['col_ref_v'].')';

				}
			}
			
			$this->smarty->assign('datas', $datas);
			$this->smarty->assign('select_fields', $tables_cols);
			$this->smarty->assign('select_from', $tables_from);
			$this->smarty->assign('variaveis', $this->dados['variaveisClass']);

			return $this->smarty->fetch($this->dirTpl .'server/'. $this->dados['tipo_banco'].'/list.tpl');
		}
		
		/**
		*	@Copilar Template Save
		*	@return Save Copilado
		*/
		public function initSave(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);

			$this->smarty->assign('variaveis', $this->dados['variaveisClass']);

			return $this->smarty->fetch($this->dirTpl . 'server/save.tpl');
		}
		
		/**
		*	@Copilar Template Delete
		*	@return Delete Copilado
		*/
		public function initDelete(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);

			return $this->smarty->fetch($this->dirTpl . 'server/delete.tpl');
		}
		
		/**
		*	@Copilar Template PDF
		*	@return PDF Copilado
		*/
		public function initPDF(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);
			$this->smarty->assign('columns', $this->dados['columns']);
			$this->smarty->assign('form', $this->dados['form']);
			if($this->dados['tipo_banco']=='mysql'){
				$this->smarty->assign('tipo_like', 'like');
			}
			else{
				$this->smarty->assign('tipo_like', 'ilike');
			}
			
			$i =0;
			foreach($this->dados['columns'] as $row){
				if($row['hidden'] != true){
					$i++;
				}
			}
			
			if($i>=7){
				$this->smarty->assign('orientation', 'L');
				$width = (276 / $i);
				$total = 276;
			}
			else{
				$this->smarty->assign('orientation', 'P');
				$width = (190 / $i);
				$total = 190;
			}
			$this->smarty->assign('total', $total);
			$this->smarty->assign('width', $width);
			
			return $this->smarty->fetch($this->dirTpl . 'server/pdf.tpl');
		}
	
	}
	
?>