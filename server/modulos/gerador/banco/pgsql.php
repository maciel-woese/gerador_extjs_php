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
				parent::__construct('pgsql:host='.$this->host.';', $this->user, $this->pass);
				//parent::exec("set search_path to {$_SESSION['SCHEMA_SERVER']}");
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
				return '{"dados": [], "total": 0}';
			}
		}
		
		function setDataBase($database){
			$this->base = $database;
			$_SESSION['DATABASE_SERVER'] = $database;
			try{
				parent::__construct('pgsql:host='.$this->host.';dbname='.$this->base, $this->user, $this->pass);
				parent::exec("set search_path to {$_SESSION['SCHEMA_SERVER']}");
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
					SELECT table_name 
					FROM information_schema.tables 
					WHERE table_schema = '{$_SESSION["SCHEMA_SERVER"]}'  
				");
				
				if($sql->execute()){
					
					while ($row=$sql->fetch(PDO::FETCH_ASSOC)){
						$this->TablesAll['dados'] = $this->getColumns($row['table_name']);
					} 
					
					return $this->TablesAll;
				}
			} 
			catch (PDOException $e){
				die('{"success": false, "msg": "'.$e->getMessage().'"}');
			}
		}
		
		function getCheckInt($string){	
			$data = array();
			$out = explode("[", $string);
			if(count($out)==2){
				$out = explode("]", $out[1]);
				if(count($out)==2){
					$out = explode(",", $out[0]);
					foreach ($out as $rows){
						$data[] = array(
								'id'=> trim($rows),
								'descricao'=> trim($rows)
						);
					}
				}
			}
			
			if(count($data)==0){
				return false;
			}
			else{
				return $data;
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
		
		function getCheckString($string){	
			$data = array();
			preg_match_all("/'(.*?)'/", $string, $out, PREG_PATTERN_ORDER);
			foreach ($out[1] as $rows){
				$data[] = array(
						'id'=> trim($rows),
						'descricao'=> trim($rows)
				);
			}
			
			if(count($data)==0){
				return false;
			}
			else{
				return $data;
			}
		}

		function getColumns($tabela){
			try{
				$sql = $this->prepare("
					SELECT 	table_catalog as db, table_name as tabela,
					column_name as coluna, data_type as tipo
					FROM information_schema.columns WHERE table_name = ?
					ORDER BY ordinal_position
				");
				
				if($sql->execute(array($tabela))){
					
					$ukpk  = $this->getColsUkPk($tabela);
					$fore  = $this->getForeign($tabela);
					$check = $this->getCheck($tabela);
					
					while ($row=$sql->fetch(PDO::FETCH_ASSOC)){
						$foreign_key = false;
						$tabela_ref  = '';
						$coluna_ref  = '';
						$unique_key  = false;
						$enum_key	 = false;
						$primary_key = false;
						
						if($ukpk){
							for($i=0;$i<count($ukpk);$i++){
								if($ukpk[$i]['column_name']==$row['coluna']){
									$unique_key  = $ukpk[$i]['unique_key'];
									$primary_key = $ukpk[$i]['primary_key'];
								}
							}
						}
						
						if($fore){ 
							for($i=0;$i<count($fore);$i++){
								if($fore[$i]['coluna']==$row['coluna']){
									$foreign_key = true;
									$tabela_ref = $fore[$i]['tabela_ref'];
									$coluna_ref = $fore[$i]['coluna_ref'];
								}
							}
						}
						
						$array_string = array(
							'character varying','character','text','char','name'
						);
						$array_int = array(
							'smallint','integer','mediumint',
							'bigint','serial','bigserial'
						);

						$array_date = array('date','time','timestamp');
						$array_float = array('double precision','numeric','real','money');
						$types = strtolower($row['tipo']);
						
						if(in_array($types, $array_string)) $tipo = 'string';
						else if(in_array($types, $array_int)) $tipo = 'int';
						else if(in_array($types, $array_float)) $tipo = 'float';
						else if(in_array($types, $array_date)) $tipo = 'date';
						else $tipo = 'string';
						
						$codicao_label = "";
						$codicao_value = "";
						
						if($check){
							for($i=0;$i<count($check);$i++){
								if($check[$i]['coluna']==$row['coluna']){
									$enum_key = true;
									if($tipo=='int'){
										$data = $this->getCheckInt($check[$i]['check_name']);
										if($data){
											$codicao_label = 'combo';
											$codicao_value = json_encode($data);
										}
									}
									else if($tipo=='string'){
										$data = $this->getCheckString($check[$i]['check_name']);
										if($data){
											$codicao_label = 'combo';
											$codicao_value = json_encode($data);
										}
									}
								}
							}
						}
						
						if($row['tipo']=='USER-DEFINED'){
							$sql2 = $this->prepare("
								SELECT a.atttypid, a.attname, e.enumlabel
									FROM pg_catalog.pg_type t, pg_catalog.pg_attribute a
									INNER JOIN pg_enum as e ON (e.enumtypid=a.atttypid)
								WHERE t.typname = ? and a.attname = ?
									AND a.attrelid = t.typrelid
									AND NOT a.attisdropped 
								ORDER BY a.attnum;
							");
							
							if($sql2->execute(array($tabela, $row['coluna']))){
								$rows=$sql2->fetchAll(PDO::FETCH_ASSOC);
								$data = array();
								foreach ($rows as $r){
									$data[] = array(
											'id'=> $r['enumlabel'],
											'descricao'=> $r['enumlabel']
									);
								}
								$codicao_label = 'combo';
								$codicao_value = json_encode($data);
							}
						}
						
						$this->TbCols[] = array(
							'tabela'=> $row['tabela'],
							'coluna'=> $row['coluna'],
							'nome_campo'=> $this->setUpperTabela($row['coluna'], true),	
							'tipo'=> $tipo,
							'required'=> true,
							'tipo_banco'=> $tipo,
							'tipo_real'=> $row['tipo'],
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
				return false;
			}
			
		}
		
		function getColsUkPk($tabela){
			try{
				$sql = $this->prepare("
					SELECT ic.relname AS index_name,
					bc.relname AS tab_name,
					ta.attname AS column_name,
					i.indisunique AS unique_key,
					i.indisprimary AS primary_key
					FROM
					pg_class bc,
					pg_class ic,
					pg_index i,
					pg_attribute ta,
					pg_attribute ia
					WHERE bc.oid = i.indrelid AND ic.oid = i.indexrelid AND ia.attrelid = i.indexrelid
					AND ta.attrelid = bc.oid AND bc.relname = ?
					AND ta.attrelid = i.indrelid AND ta.attnum = i.indkey[ia.attnum-1]
					ORDER BY index_name, tab_name, column_name;
				");
				
				if($sql->execute(array($tabela))){
					return $sql->fetchAll();
				}
			}
			catch (PDOException $e){
				return array();
			}	
		}
		
		function getForeign($tabela){
			try{
				$sql = $this->prepare("
						SELECT
						n.nspname AS esquema,
						cl.relname AS tabela,
						a.attname AS coluna,
						ct.conname AS chave,
						nf.nspname AS esquema_ref,
						clf.relname AS tabela_ref,
						af.attname AS coluna_ref,
						pg_get_constraintdef(ct.oid) AS criar_sql
				
						FROM pg_catalog.pg_attribute a
				
						JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
						JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)
						JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND ct.confrelid != 0 AND ct.conkey[1] = a.attnum)
						JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r')
						JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)
						JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND af.attnum = ct.confkey[1])
				
						WHERE cl.relname = ?
				");
				
				if($sql->execute(array($tabela))){
					return $sql->fetchAll();
				}
			}
			catch (PDOException $e){
				return array();
			}
		}
		
		function getCheck($tabela){
			try{
				$sql = $this->prepare("
						SELECT
						ct.conname as enum_type,
						ct.consrc as check_name,
						a.attname as coluna
						
						FROM pg_catalog.pg_constraint ct 
						INNER JOIN pg_catalog.pg_attribute a ON (a.attrelid = ct.conrelid)
						INNER JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
						INNER JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)
						WHERE ct.contype = 'c' and ct.conkey[1] = a.attnum and cl.relname = ?
				");
			
				if($sql->execute(array($tabela))){
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
					echo "var json False; -> createCrudSystem() postgre.php";
				}
			}
			
			if($foreign==false){
				$foreign = stripslashes($foreignBK);
				$foreign = json_decode($foreign, true);
				if($foreign==false){
					echo "var json foreign; -> createCrudSystem() postgre.php";
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
						if($enc>0){
							continue;
						}
						else{
							$enc++;
						}
						if($jj['coluna']==$j['coluna']){
							$fields[$j['tabela']][] = array(
								'nome'=> $jj['coluna_ref_label'],
								'dataIndexPDF'=> $jj['coluna'],
								'nome_campo'=> $j['nome_campo'],
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