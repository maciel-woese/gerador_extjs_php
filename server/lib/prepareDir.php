<?php
	class prepareDir {
		public $id_usuario = null;
		public $root  = "class/generated/";
		public $model = "class/modelos_sistema/";
		
		function __construct($params){
			$this->id_usuario = $params['id_usuario'];
		}
		
		function verify($dir){
			if(file_exists($dir)){
				return true;
			}
			else{
				return false;
			}
		}
		
		function verifyClear(){
			if(isset($_SESSION['CLEAR_LAYOUT'])){
				if(!$this->vazio($this->root.$this->id_usuario."/{$_SESSION['CLEAR_LAYOUT']}/app/controller/")){
					@$this->remove($this->root.$this->id_usuario."/{$_SESSION['CLEAR_LAYOUT']}/", true);
					$this->copyModel($this->model."/{$_SESSION['CLEAR_LAYOUT']}/", $this->root.$this->id_usuario."/{$_SESSION['CLEAR_LAYOUT']}/");
				}
				unset($_SESSION['CLEAR_LAYOUT']);
			}
			else{
				if(!$this->vazio($this->root.$this->id_usuario.'/padrao/app/controller/')){
					@$this->remove($this->root.$this->id_usuario.'/padrao/', true);
					$this->copyModel($this->model.'/padrao/', $this->root.$this->id_usuario.'/padrao/');
				}
				if(!$this->vazio($this->root.$this->id_usuario.'/desktop/app/controller/')){
					@$this->remove($this->root.$this->id_usuario.'/desktop/', true);
					$this->copyModel($this->model.'/desktop/', $this->root.$this->id_usuario.'/desktop/');
				}
				if(!$this->vazio($this->root.$this->id_usuario.'/touch/app/controller/')){
					@$this->remove($this->root.$this->id_usuario.'/touch/', true);
					$this->copyModel($this->model.'/touch/', $this->root.$this->id_usuario.'/touch/');
				}
			}
		}
		
		function copyModel($source, $dest){
			if (is_file($source)) {
				return copy($source, $dest);
			}
			
			if (!is_dir($dest)) {
				mkdir($dest);
			}
			
			$dir = dir($source);
			while (false !== $entry = $dir->read()) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}
			
				if ($dest !== "$source/$entry") {
					$this->copyModel("$source/$entry", "$dest/$entry");
				}
			}
			
			$dir->close();
			return true;
		}
		
		function remove($dir, $root=false, $files=array()){
			$dir_content = scandir($dir);
			if($dir_content !== FALSE){
				foreach ($dir_content as $entry){
					if(!in_array($entry, array('.','..'))){
						$file = $entry;
						$entry = $dir . '/' . $entry;
						if(!is_dir($entry)){
							if(!in_array($file, $files)){
								unlink($entry);
							}
						}
						else{
							$this->remove($entry);
						}
					}
				}
			}
			if($root==false){
				@rmdir($dir);
			}
		
		}
		
		function importModels($remove=false){
			@$this->remove($this->root.$this->id_usuario, true);
			$this->copyModel($this->model, $this->root.$this->id_usuario);
		}
		
		function vazio($dir){
			if(file_exists($dir)){
				$scan = scandir($dir);
				if(count($scan) > 2) {
					return false;
				}
				return true;
			}
			else{
				
			}
		}
		
		function prepare(){
			@$this->remove('templates_c', true);
			
			if(!$this->verify($this->root.$this->id_usuario)){
				if(!mkdir($this->root.$this->id_usuario)){
					return false;
				}
			}
			
			if($this->vazio($this->root.$this->id_usuario)){
				$this->importModels(true);
			}
			else{
				$this->verifyClear();
			}
			
		}
		
		function clearModels(){
			$this->importModels(true);
		}
		
	}

?>