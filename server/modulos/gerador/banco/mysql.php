<?php
	
	class banco extends PDO{
		public $host = null;
		public $user = null;
		public $pass = null;
		
		public $TbCols = array();
		public $TablesAll = array();
		public $base = null;
		
		function banco($host, $user, $pass, $database=false){
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			
			if($database!=false){
				$this->setDataBase($database);
				return true;
			}
			
			try{
				parent::__construct('mysql:host='.$this->host.';', $this->user, $this->pass);
				$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch ( PDOException $e ){
				$msg = utf8_encode(NO_CONNECT_SERVER);
				die('{"success": false, "msg": "'.$msg.'"}');
			}
			if($_POST['action']=='LOGIN_SERVER')
				echo '{"success": true}';
		}
		
		function getDataBase(){
			try{
				$sql = $this->prepare("
						SELECT datname as label, datname as value
						FROM pg_database
						WHERE datistemplate IS FALSE
						AND datallowconn IS TRUE
						AND datname!='postgres'
				");
					
				if($sql->execute()){
					$vals = array();
					while ($row=$sql->fetch(PDO::FETCH_ASSOC)){
						$vals[] = array(
							'label'=> $row['label'],
							'value'=> $row['value']
						);
					}
					return json_encode(array('dados'=> $vals));
				}
			}
			catch ( PDOException $e ){
				//echo $e->getMessage();
				return '{"dados": [], "total": 0, msg: "'.$e->getMessage().'"}';
			}
		}
		
		function setDataBase($database){
			$this->base = $database;
			$_SESSION['DATABASE_SERVER'] = $database;
			try{
				parent::__construct('mysql:host='.$this->host.';dbname='.$this->base, $this->user, $this->pass);
				$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch ( PDOException $e ){
				//$e->getMessage());
				$msg = utf8_encode(NO_CONNECT_DB);
				die('{"success": false, "msg": "'.$msg.'"}');
			}

		}
		
		function getJsonDados($array){
			$row = array();
			foreach($array as $key => $value){
				if(is_string($value)){
					$row[$key] = utf8_encode($value);
				}
				else{
					$row[$key] = $value;
				}
				
			}
			
			return json_encode(array('dados'=>$row));
		}
		
		function getTablesColumns(){
			/*Tabelas*/
			try{
				$sql = $this->prepare("
					SHOW TABLES IN {$_SESSION['DATABASE_SERVER']}
				");
				
				if($sql->execute()){
					$query = $sql->fetchAll(PDO::FETCH_ASSOC);
					foreach($query as $row){
						$this->TablesAll['dados'] = $this->getColumns($row['Tables_in_'.$_SESSION['DATABASE_SERVER']]);
					}
					
					return $this->TablesAll;
				}
			} 
			catch (PDOException $e){
				die('{"success": false, "msg": "'.$e->getMessage().'"}');
			}
		}
		
		function getColumns($tabela){
			try{
				$sql = $this->prepare("
					SHOW COLUMNS FROM {$tabela}
				");
				
				if($sql->execute()){
					
					$indexs = $this->getIndexCols($tabela, $this->base);
					
					while ($row=$sql->fetch(PDO::FETCH_ASSOC)){
						$foreign_key = false;
						$tabela_ref = '';
						$coluna_ref = '';
						$unique_key = false;
						$primary_key = false;
						
						if($indexs){
							for($i=0;$i<count($indexs);$i++){
								if($indexs[$i]['coluna']==$row['Field']){
									if($indexs[$i]['tipo']=='PRIMARY KEY'){
										$primary_key = true;
										$unique_key = true;
									}
									else if($indexs[$i]['tipo']=='UNIQUE'){
										$unique_key = true;
									}
									else if($indexs[$i]['tipo']=='FOREIGN KEY'){
										$foreign_key = true;
										$tabela_ref = $indexs[$i]['tabela_ref'];
										$coluna_ref = $indexs[$i]['coluna_ref'];
									}
								}
							}
						}
						$type = explode('(', $row['Type']);
						$type = strtolower($type[0]);
						
						$array_string = array(
							'varchar','char','text',
							'tinytext','tinyblob',
							'blob','set','enum'
						);
						$array_int = array(
							'tinyint','smallint','mediumint',
							'int','integer','bigint'
						);
						$array_date = array('date','datetime','time','timestamp');
						$array_float = array('float','double','decimal');
						
						if(in_array($type, $array_string)) $tipo = 'string';
						else if(in_array($type, $array_int)) $tipo = 'int';
						else if(in_array($type, $array_float)) $tipo = 'float';
						else if(in_array($type, $array_date)) $tipo = 'date';
						else $tipo = 'auto';
						
						$codicao_label = "";
						$codicao_value = "";
						
						$tipo_real = explode('(', $row['Type']);
						
						if($tipo_real[0]=='enum'){
							$tipo_ = $row['Type'];
							preg_match_all("/'(.*?)'/", $tipo_, $out, PREG_PATTERN_ORDER);
							$data = array();
						
							foreach ($out[1] as $rows){
								$data[] = array(
										'id'=> $rows,
										'descricao'=> $rows
								);
							}
							$codicao_label = 'combo';
							$codicao_value = json_encode($data);
						}
						
						$this->TbCols[] = array(
							'tabela'=> $tabela,
							'coluna'=> $row['Field'],
							'nome_campo'=> $this->setUpperTabela($row['Field'], true),	
							'tipo'=> $tipo,
							'required'=> true,
							'tipo_banco'=> $type,
							'tipo_real'=> $row['Type'],
							'primary_key'=> $primary_key,
							'unique_key'=> $unique_key,
							'foreign_key'=> $foreign_key,
							'tabela_ref'=> $tabela_ref,
							'coluna_ref_value'=> $coluna_ref,
							'coluna_ref_label'=> '',
							'coluna_label_condicao'=> $codicao_label,
							'coluna_value_condicao'=> $codicao_value	
						);
						
					}
					return $this->TbCols;
				}
			}
			catch (PDOException $e){
				die('{"success": false, "msg": "'.$e->getMessage().'"}');
			}
			
		}
		
		public function setUpperTabela($tabela, $remove=false){
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
					if($remove==true){
						$tab = implode(' ', $r);
					}
					else{
						$tab = implode('-', $r);
					}
				}
			}
			else{
				$r = array();
				foreach ($tab as $key){
					$r[] = ucfirst($key);
				}
				if($remove==true){
					$tab = implode(' ', $r);
				}
				else{
					$tab = implode('_', $r);
				}
				
			}
				
			return $tab;
		}
		
		function getIndexCols($tabela, $banco){
			try{
				$sql = $this->prepare("
					SELECT 
						t.CONSTRAINT_NAME as nome_indice, 
						t.TABLE_NAME as tabela, 
						t.CONSTRAINT_TYPE as tipo, 
						k.COLUMN_NAME as coluna, 
						k.REFERENCED_TABLE_NAME as tabela_ref, 
						k.REFERENCED_COLUMN_NAME as coluna_ref
					FROM information_schema.table_constraints t
					INNER JOIN information_schema.key_column_usage k 
					ON (t.CONSTRAINT_NAME=k.CONSTRAINT_NAME)
					WHERE 
						t.table_name = '{$tabela}' and 
						t.TABLE_SCHEMA = '{$banco}' and 
						k.CONSTRAINT_SCHEMA = '{$banco}' and 
						k.table_name = '{$tabela}'
				");
				
				if($sql->execute()){
					return $sql->fetchAll();
				}
			}
			catch (PDOException $e){
				return array();
			}	
		}
		
		function getGridDados(){
			$all = $this->getTablesColumns();
			return json_encode($all);
		}
	
		function createCrudSystem($json, $foreign){
			$fields = array();
			$jsonBK = $json;
			$foreignBK = $foreign;
			$json = json_decode($json, true);
			$foreign = json_decode($foreign, true);
			
			if($json==false){
				$json = stripslashes($jsonBK);
				$json = json_decode($json, true);
				if($json==false){
					echo "var json False; -> createCrudSystem() mysql.php";
				}
			}
			
			if($foreign==false){
				$foreign = stripslashes($foreignBK);
				$foreign = json_decode($foreign, true);
				if($foreign==false){
					echo "var json foreign; -> createCrudSystem() mysql.php";
				}
			}
			
			for($i=0; $i<count($json['dados']);$i++){
				
				$j = $json['dados'][$i];
				
				if($j['tipo']=='string') $grid = 'grid';
				else if($j['tipo']=='int') $grid = 'number';
				else if($j['tipo']=='date') $grid = 'date';
				else $grid = 'grid';
					
				if($j['foreign_key']==true) $window = 'combo';
				else if($j['tipo']=='int' and $j['foreign_key']==false) $window = 'number';	
				else if($j['tipo']=='date' and $j['foreign_key']==false) $window = 'date';
				else $window = 'text';
				
				$hidden = $j['primary_key'];	
				if($j['foreign_key']==true){
					$hidden = true;
					$enc = 0;
					for($p=0; $p<count($foreign['dados']);$p++){
						$jj = $foreign['dados'][$p];
						
						if($jj['coluna']==$j['coluna']){
							if($enc>0){
								continue;
							}
							else{
								$enc++;
							}
							$fields[$j['tabela']][] = array(
								'nome'=> $jj['coluna_ref_label'],
								'nome_campo'=> $j['nome_campo'],
								'dataIndexPDF'=> $jj['coluna'],
								'hidden'=> false,
								'chave'=> false,
								'foreign'=> true,
								'unique'=> false,	
								'tipo_real'=> $jj['tipo_real'],
								'required'=> $jj['required'],
								'tab_ref'=> $jj['tabela_ref'],
								'tabela'=> $jj['tabela_ref'],
								'col_ref_v'=> $jj['coluna_ref_value'],
								'col_v'=> $jj['coluna'],
								'type'=> 'string',
								'xtypeGrid'=> 'grid',
								'xtypeWindow'=> false,
								'mask'=> false,
								'combo'=> false
							);
						}
					}
					
					$combo = $j['tabela_ref'];
					
				}
				else $combo = false;
				$mask = '';
				$validate = '';
				$pass = '';
				$comboLocal = '';
				
				if($j['coluna_label_condicao']!=''){
					if($j['coluna_label_condicao']=='mask'){
						$mask = $j['coluna_value_condicao'];
					}
					else if($j['coluna_label_condicao']=='validate'){
						$validate = $j['coluna_value_condicao'];
					}
					else if($j['coluna_label_condicao']=='type'){
						$pass = $j['coluna_value_condicao'];
					}
					else if($j['coluna_label_condicao']=='combo'){
						$comboLocal = $j['coluna_value_condicao'];
					}
					else if($j['coluna_label_condicao']=='radio'){
						$radioLocal = $j['coluna_value_condicao'];
					}
				}
				
				$fields[$j['tabela']][] = array(
					'nome'=> $j['coluna'],
					'dataIndexPDF'=> $j['coluna'],
					'nome_campo'=> $j['nome_campo'],
					'hidden'=> $hidden,
					'foreign'=> false,
					'tipo_real'=> $j['tipo_real'],
					'required'=> $j['required'],
					'unique'=> $j['unique_key'],	
					'tabela'=> $j['tabela'],
					'chave'=> $j['primary_key'],
					'type'=> $j['tipo'],
					'xtypeGrid'=> $grid,
					'xtypeWindow'=> $window,
					'combo'=> $combo,
					
					'comboLocal'=> isset($comboLocal) ? $comboLocal : '',
					'radioLocal'=> isset($radioLocal) ? $radioLocal : '',
					'validate'=> isset($validate) ? $validate : '',
					'inputType'=> isset($pass) ? $pass : '',
					'mask'=> isset($mask) ? $mask : ''
					
				);
			}
			
			return $this->setSmartyPrepare($fields, $foreign);
			
		}

		function setSmartyPrepare($fields, $foreign){
			$allJsonCrud = array();
			foreach ($fields as $key => $value){
				
				$foreng = false;
				$json = array(
					'fields'=> $value,
					'tabela'=> $key,
					'store'=> false	
				);
				if(is_array($foreign)){
					for($i=0; $i<count($foreign['dados']);$i++){
						if($foreign['dados'][$i]['tabela_ref']==$key){
							$foreng = $foreign['dados'][$i];
						}
					}
				}
				
				if($foreng==false){
					$json = array(
						'fields'=> $value,
						'tabela'=> $key,
						'store'=> false	
					);
				}
				else{
					$json = array(
						'fields'=> $value,
						'tabela'=> $key,
						'store'=> array(
							'combo'=>true, 
							'label'=> $foreng['coluna_ref_label'],
							'value'=> $foreng['coluna_ref_value']
						)
					);
				}
				
				$allJsonCrud[] = $json;
			}
			
			return $allJsonCrud;
		}
	
	}
	
?>