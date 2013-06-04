<?php
	class Permissoes{
		private $sql;
		private $perfil_id = 0;
		private $usuario_id = 0;
		private $models;
		
		public function __construct(){
			$this->sql = new Connection();
			if (!session_id()) session_start();
		}

		public function getModulos(){
			try{
				if($this->usuario_id>0){
					$query = $this->sql->prepare("
					SELECT ma.modulo_id, m.modulo, m.descricao, pp.acao_id, ma.acao, ma.acao_desc, 'S' as acesso, pp.perfil_id
					FROM permissoes_perfil as pp
					INNER JOIN modulos_acoes as ma ON (pp.acao_id=ma.id)
					INNER JOIN modulos as m ON (ma.modulo_id=m.id)
					WHERE pp.perfil_id = ?
					
					UNION ALL
			
					SELECT mac.modulo_id, mm.modulo, mm.descricao,
					pu.acao_id, mac.acao, mac.acao_desc, pu.acesso, 0 as perfil_id
					FROM permissoes_usuario as pu
					INNER JOIN modulos_acoes as mac ON (pu.acao_id=mac.id)
					INNER JOIN modulos as mm ON (mac.modulo_id=mm.id)
					WHERE pu.usuario_id = ?
				");
					
					$query->execute(array(
							$this->perfil_id,
							$this->usuario_id
					));
				}
				else{
					$query = $this->sql->prepare("
						SELECT ma.modulo_id, m.modulo, m.descricao, pp.acao_id, ma.acao, 'S' as acesso, ma.acao_desc
						FROM permissoes_perfil as pp
						INNER JOIN modulos_acoes as ma ON (pp.acao_id=ma.id)
						INNER JOIN modulos as m ON (ma.modulo_id=m.id)
						WHERE pp.perfil_id = ?
					");
					
					$query->execute(array(
						$this->perfil_id
					));
				}
				$result = $query->fetchAll(PDO::FETCH_OBJ);
				
				$response = $this->prepareModulos($result);
				$this->models = $response;
				return true;
			}
			catch(PdoException $e){
				$this->models = array();
				return false;
			}
		}

		public function prepareModulos($result){
			$data = array();
			foreach($result as $row1){
				if($row1->acesso=='S'){
					$data[$row1->modulo][] = array(
						'descricao'	=> $row1->acao_desc,
						'modulo'	=> $row1->modulo,
						'acesso'	=> $row1->acesso,
						'perfil_id'	=> $row1->perfil_id,
						'acao'		=> $row1->acao,
						'acao_id'	=> $row1->acao_id
					);
				}
			}
			return $data;
		}
		
		public function setUpper($tabela){
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
		
		public function getAllModels(){
			try{
				$query = $this->sql->prepare("
					SELECT ma.modulo_id, m.modulo, m.descricao, ma.id as acao_id, ma.acao, ma.acao_desc
					FROM modulos_acoes as ma
					INNER JOIN modulos as m ON (ma.modulo_id=m.id)
				");
			
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_OBJ);
				return $this->prepareModulosTree($result);			
			}
			catch(PdoException $e){
				return false;
			}
		}
		
		public function prepareModulosTree($result){
			$data = array();
			$tables = array();
			foreach($result as $row1){
				$data[$row1->modulo][] = array(
					'text'			=> $row1->acao_desc,
					'modulo'		=> $row1->modulo,
					'leaf'			=> false,
					'acao'			=> $row1->acao,
					'acao_id'		=> $row1->acao_id,
					'checked'		=> false,
					'init_checked'	=> false
				);
			}
			return $data;
		}

		public function getTreeUsuario($perfil_id, $usuario_id){
			$this->perfil_id = $perfil_id;
			$this->usuario_id = $usuario_id;
			
			$this->getModulos();
			
			$permissoes = $this->models;
			$result = array();
			$data = array();
			$tabela = "";
			$total = 0;
			$modulos = $this->getAllModels();
			
			foreach($modulos as $key => $row){
				$tabela = $key;
				if(isset($permissoes[$key])){
					foreach($row as $r1){
						$check = false;
						$rr = array();
						
						foreach($permissoes[$key] as $r2){
							if(($r2['acao']==$r1['acao']) and ($r2['modulo']==$r1['modulo'])){
								$check = true;
								$rr = $r2;
							}
						}
						
						if(isset($rr['acesso']) and $rr['acesso']=='S' and $rr['perfil_id']=='0') $cor = 'color: green';
						else if(isset($rr['acesso']) and $rr['acesso']=='N' and $rr['perfil_id']=='1') $cor = 'color: red';
						else $cor = '';
						$nome = $r1['text'];
						$r1['text'] = "<span style='$cor'>$nome</span>"; 
						
						if($check==true){
							$r1['checked'] = true;
							$r1['init_checked'] = true;
							$r1['leaf'] = true;
							$data[] = $r1;
						}
						else{
							$r1['leaf'] = true;
							$data[] = $r1;
						}
					}
				}
				else{
					foreach($row as $r1){
						$r1['leaf'] = true;
						$data[] = $r1;
					}
				}
				
			}		

			return json_encode(array('dados'=>$data));
		}
		
		public function getTreePerfil($perfil_id){
			$this->perfil_id = $perfil_id;
			$this->usuario_id = 0;
			$this->getModulos();
				
			$permissoes = $this->models;
			$result = array();
			$data = array();
			$tabela = "";
			$total = 0;
			$modulos = $this->getAllModels();
				
			foreach($modulos as $key => $row){
				//$data = array();
				$tabela = $key;
				if(isset($permissoes[$key])){
					foreach($row as $r1){
						$check = false;
						foreach($permissoes[$key] as $r2){
							if(($r2['acao']==$r1['acao']) and ($r2['modulo']==$r1['modulo'])){
								$check = true;
							}
						}
						if($check==true){
							$r1['checked'] = true;
							$r1['init_checked'] = true;
							$r1['leaf'] = true;
							$data[] = $r1;
						}
						else{
							$r1['leaf'] = true;
							$data[] = $r1;
						}
					}
				}
				else{
					foreach($row as $r1){
						$r1['leaf'] = true;
						$data[] = $r1;
					}
				}
			}
			return json_encode(array('dados'=>$data));
		}
		
		public function setModulosPerfil($json, $perfil_id){
			try{
				$this->sql->beginTransaction();
				$query = $this->sql->prepare("
					DELETE FROM permissoes_perfil WHERE perfil_id = ? 
				");
					
				$query->execute(array(
					$perfil_id
				));
				
				foreach ($json['dados'] as $row){
					$query = $this->sql->prepare("
						INSERT INTO permissoes_perfil (perfil_id, acao_id)
						VALUES (?, ?)
					");
							
					$query->execute(array(
						$perfil_id,
						$row['acao_id']
					));
				}
				
				$this->sql->commit();
				return json_encode(array('success'=> true, 'msg'=> "Salvo com Sucesso!"));
			}
			catch(PdoException $e){
				$this->sql->rollBack();
				return json_encode(array('success'=> false, 'msg'=> $e->getMessage()));
			}
		}
		
		public function setModulosUsuario($json, $usuario_id){
			try{
				$this->sql->beginTransaction();
				
				foreach ($json['dados'] as $row){
					if(($row['action']==2) or ($row['action']==4)){
						$query = $this->sql->prepare("
							DELETE FROM permissoes_usuario WHERE usuario_id = ?
						");
						
						$query->execute(array(
							$usuario_id
						));
					}
					else if($row['action']==1){
						$query = $this->sql->prepare("
							INSERT INTO permissoes_usuario (usuario_id, acao_id, acesso)
							VALUES (?, ?, 'S')
						");
						
						$query->execute(array(
								$usuario_id,
								$row['acao_id']
						));
					}
					else if($row['action']==2){
						$query = $this->sql->prepare("
							INSERT INTO permissoes_usuario (usuario_id, acao_id, acesso)
							VALUES (?, ?, 'N')
						");
						
						$query->execute(array(
								$usuario_id,
								$row['acao_id']
						));
					}
				}
				
				$this->sql->commit();
				return json_encode(array('success'=> true, 'msg'=> "Salvo com Sucesso!"));
			}
			catch(PdoException $e){
				$this->sql->rollBack();
				return json_encode(array('success'=> false, 'msg'=> $e->getMessage()));
			}
		}
	}
?>