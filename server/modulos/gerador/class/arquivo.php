<?php

	class Arquivo{
		public $dirApp = null;
		public $tabela = null;
		public $menu   = array();
		
		public function Arquivo(){
			
		}
		
		public function init($dirApp, $tabela){
			$this->dirApp = $dirApp;
			$this->tabela = $tabela;
			$menu = array();
		}
		
		public function exports(){
			
		}
		
		public function create($temp, $type, $campo=false, $modelCombo="ModelCombo"){
			$dir = $this->dirApp;
			$tabela = $this->setUpperTabela($this->tabela);
			if($campo!=false) $campo = $this->setUpperTabela($campo);

			if(!file_exists($dir.'app/view')){
				mkdir($dir.'app/view');
				@chmod($dir.'app/view', 0777);
			}
			if(!file_exists($dir.'app/controller')){
				mkdir($dir.'app/controller');
				@chmod($dir.'app/controller', 0777);
			}
			if(!file_exists($dir.'app/model')){
				mkdir($dir.'app/model');
				@chmod($dir.'app/model', 0777);
			}
			if(!file_exists($dir.'app/store')){
				mkdir($dir.'app/store');
				@chmod($dir.'app/store', 0777);
			}
			if(!file_exists($dir.'server/modulos')){
				mkdir($dir.'server/modulos');
				@chmod($dir.'server/modulos', 0777);
			}
			if(!file_exists($dir.'server/lib')){
				mkdir($dir.'server/lib');
				@chmod($dir.'server/lib', 0777);
			}

			if($type=='window'){
				if(!file_exists($dir.'app/view/'.$this->tabela)){
					mkdir($dir.'app/view/'.$this->tabela);
					@chmod($dir.'app/view/'.$this->tabela, 0777);
				}
				$file = $dir."app/view/".$this->tabela."/Edit.js";
			}
			else if($type=='filtro'){
				if(!file_exists($dir.'app/view/'.$this->tabela)){
					mkdir($dir.'app/view/'.$this->tabela);
					@chmod($dir.'app/view/'.$this->tabela, 0777);
				}
				$file = $dir."app/view/".$this->tabela."/Filtro.js";
			}
			else if($type=='grid'){
				if(!file_exists($dir.'app/view/'.$this->tabela)){
					mkdir($dir.'app/view/'.$this->tabela);
					@chmod($dir.'app/view/'.$this->tabela, 0777);
				}
				$file = $dir."app/view/".$this->tabela."/List.js";
			}
			else if($type=='list'){
				if(!file_exists($dir.'server/modulos/'.$this->tabela)){
					mkdir($dir.'server/modulos/'.$this->tabela);
					@chmod($dir.'server/modulos/'.$this->tabela, 0777);
				}
				$file = $dir."server/modulos/".$this->tabela."/list.php";
			}
			else if($type=='save'){
				if(!file_exists($dir.'server/modulos/'.$this->tabela)){
					mkdir($dir.'server/modulos/'.$this->tabela);
					@chmod($dir.'server/modulos/'.$this->tabela, 0777);
				}
				$file = $dir."server/modulos/".$this->tabela."/save.php";
			}
			else if($type=='delete'){
				if(!file_exists($dir.'server/modulos/'.$this->tabela)){
					mkdir($dir.'server/modulos/'.$this->tabela);
					@chmod($dir.'server/modulos/'.$this->tabela, 0777);
				}
				$file = $dir."server/modulos/".$this->tabela."/delete.php";
			}
			else if($type=='pdf'){
				if(!file_exists($dir.'server/modulos/'.$this->tabela)){
					mkdir($dir.'server/modulos/'.$this->tabela);
					@chmod($dir.'server/modulos/'.$this->tabela, 0777);
				}
				$file = $dir."server/modulos/".$this->tabela."/pdf.php";
			}
			else if($type=='model') $file = $dir."app/model/Model".$tabela.".js";
			else if($type=='class') $file = $dir."server/lib/".$tabela.".class.php";
			else if($type=='control') $file = $dir."app/controller/".$tabela.".js";
			else if($type=='store') $file = $dir."app/store/Store".$tabela.".js";
			else if($type=='storecombo') $file = $dir."app/store/StoreCombo".$tabela.".js";
			else if($type=='storecombolocal') $file = $dir."app/store/StoreCombo{$campo}".$tabela.".js";
			else if($type=='modelcombo') $file = $dir."app/model/{$modelCombo}.js";
			else if($type=='index') $file = $dir."index.php";
			
			$arq = fopen($file,"w");
			fwrite($arq, $temp);
			fclose($arq);
			
			if(in_array($type, array('model', 'control', 'store', 'storecombo', 'storecombolocal'))){
				$f = explode('_', $file);
				if(count($f)>1){
					$r = array();
					foreach($f as $c=> $k){
						if($c==0){
							$r[] = $k;
						}
						else{
							$r[] = strtolower($k);
						}
					}
					$f = implode('_', $r);
					rename($f, $file);
				}
			}
			
		}
		
		public function setUpperTabela($tabela){
			$tab = explode('_', $tabela);
			if(count($tab)==1){
				$tab = explode('-', $tabela);
				if(count($tab)==1){
					$tab = ucfirst($tabela);
				}
				else{
					$r = array();
					foreach ($tab as $key){
						$r[] = ucfirst($key);
					}
					$tab = implode('-', $r);
				}
			}
			else{
				$r = array();
				foreach ($tab as $key){
					$r[] = ucfirst($key);
				}
				$tab = implode('_', $r);
			}
			
			return $tab;
		}
		
		public function filesDir($dir, $type=true, $notFile=false){
			$dh = opendir($dir);
			$files = array();
			while (($file = readdir($dh)) !== false){
				if ($file == '.'  ||  $file == '..'){
					continue;
				}
				if (!is_dir($file)){
					if($type==false){
						$file = explode('.', $file);
						$file = $file[0];
					}
					if($notFile==$file){

					}
					else{
						$files[] = $file;
					}
				}
			}

			closedir($dh);
			return $files;
		}
	
	}

?>