<?php
	class Usuarios
	{
		private $sql;
		
		private $id;
		private $nome;
		private $login;
		private $perfil_id;
		private $administrador;
		
		public function __construct(){
			$this->sql = new Connection();
			if (!session_id()) session_start();
		}
		
		public function getIp(){
			$ip = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown');
			$forward = (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : false);
			
			return (($ip=='unknown' && $forward != 'unknown' ) ? $forward : $ip); 
		}
		
		public function isLogado(){	
			if( isset($_SESSION['SESSION_USUARIO'])){	
				$sessao = unserialize($_SESSION['SESSION_USUARIO']);
				
				if(!empty($sessao)){
					$this->id = $sessao['id'];
					$this->nome = $sessao['nome'];
					$this->login = $sessao['login'];
					$this->perfil_id = $sessao['perfil_id'];
					$this->administrador = $sessao['administrador'];
					return true;
				}
				else
				{
					return false;
				}
			} 
			else{
				return false;
			}
		}
		
		public function setLogar($usuario, $senha){
			try{
				if(empty($usuario) or empty($senha)){
					return json_encode(array(
						'success'	=> false,
						'msg'		=> utf8_encode('{$login_required}')
					));
				}
				else{
					$this->login = $usuario;
					$senha = md5(trim(rtrim($senha)));
					
					$query = $this->sql->prepare("
						SELECT * FROM usuarios
						WHERE login = ? AND senha = ?
					");
					$query->execute(array(
						$usuario,
						$senha
					));

					if($query->rowCount() > 0)
					{
						$result = $query->fetch(PDO::FETCH_OBJ);
						
						if($result->status == '1')
						{
							$sessao = array();
							if($result->administrador=='1'){
								$admin = true;
							}
							else{
								$admin = false;
							}
							
							$sessao['id'] = $result->id;
							$sessao['nome'] = $result->nome;
							$sessao['login'] = $result->login;
							$sessao['perfil_id'] = $result->perfil_id;
							$sessao['administrador'] = $admin;
							
							$this->id = $result->id;
							$this->perfil_id = $result->perfil_id;
							
							$_SESSION['SESSION_USUARIO'] = serialize($sessao);
							if($admin==false){
								$this->getModulos();
							}
							else{
								$this->getModulosAdmin();
							}
							return json_encode(array(
								'success'	=> true,
								'msg'		=>	"Sucess!"
							));
						}
						else
						{
							return json_encode(array(
								'success'	=> false,
								'msg'		=>	utf8_encode('{$user_bloq}')
							));
						}
					}
					else
					{
						return json_encode(array(
							'success'	=> false,
							'msg'		=> utf8_encode('{$user_incorrect}')
						));
					}
				}
			}
			catch(PDOException $e){
				return json_encode(array(
					'success'	=> false,
					'msg'		=> $e->getMessage()
				));
			}
		}
		
		public function setLogout(){
			if($this->isLogado())
			{
				unset($_SESSION['SESSION_USUARIO']);
				unset($_SESSION['MODEL_PERMISSOES']);
				unset($_SESSION['MODEL_TABLES']);
				session_destroy();
			}
		}
		
		public function getAcao($tabela, $action){
			$sessao = unserialize($_SESSION['SESSION_USUARIO']);
			if($sessao['administrador']==true){
				$models = unserialize($_SESSION['MODEL_PERMISSOES']);
				$res = false;
				if(isset($models[$tabela])){
					
					foreach($models[$tabela] as $row){
						if($row['acao']==$action){
							$res = true;
						}
					}
				}
				
				if($res==false){
					die(json_encode(array(
						'success'	=> false,
						'msg'		=> utf8_encode("{$permissoes_insuf}"),
						'dados'		=> array()
					)));
				}
			}	
		}
		
		public function getModulos(){
			try{
				$query = $this->sql->prepare("
					SELECT ma.modulo_id, m.modulo, m.descricao, pp.acao_id, ma.acao, 'S' as acesso
					FROM permissoes_perfil as pp
					INNER JOIN modulos_acoes as ma ON (pp.acao_id=ma.id)
					INNER JOIN modulos as m ON (ma.modulo_id=m.id)
					WHERE pp.perfil_id = ?

					UNION ALL
					
					SELECT mac.modulo_id, mm.modulo, mm.descricao,
					pu.acao_id, mac.acao, pu.acesso
					FROM permissoes_usuario as pu
					INNER JOIN modulos_acoes as mac ON (pu.acao_id=mac.id)
					INNER JOIN modulos as mm ON (mac.modulo_id=mm.id)
					WHERE pu.usuario_id = ?
				");
				
				$query->execute(array(
					$this->perfil_id,
					$this->id
				));
				
				$result = $query->fetchAll(PDO::FETCH_OBJ);
				
				$response = $this->prepareModulos($result);
				$this->models = $response;
				$_SESSION['MODEL_PERMISSOES'] = serialize($response);
				return true;
			}
			catch(PdoException $e){
				$this->models = array();
				$_SESSION['MODEL_PERMISSOES'] = serialize(array());
				die(json_encode(array(
					'success'=> false,
					'msg'=> $e->getMessage()
				)));
				return false;
			}
		}
		
		public function getModulosAdmin(){
			try{
				$query = $this->sql->prepare("
					SELECT m.id as modulo_id, m.modulo, m.descricao,
					ma.id as acao_id, ma.acao, 'S' as acesso
					FROM modulos as m INNER JOIN modulos_acoes as ma
					ON (m.id=ma.modulo_id)
				");
				
				$query->execute();
				
				$result = $query->fetchAll(PDO::FETCH_OBJ);
				
				$response = $this->prepareModulos($result, true);
				$this->models = $response;
				$_SESSION['MODEL_PERMISSOES'] = serialize($response);
				return true;
			}
			catch(PDOException $e){
				$this->models = array();
				$_SESSION['MODEL_PERMISSOES'] = serialize(array());
				die(json_encode(array(
					'success'=> false,
					'msg'=> $e->getMessage()
				)));
				return false;
			}
		}
		
		public function prepareModulos($result, $admin=false){
			$data = array();
			$tables = array();
			foreach($result as $row1){
				$not_add = false;
				if($admin==false){
					foreach($result as $row2){
						if(	($row1->modulo_id==$row2->modulo_id) and
							($row1->acao_id==$row2->acao_id) and 
							($row1->acesso!=$row2->acesso)){
							$not_add = true;
						}
					}
				}
				if($not_add==false){
					if($row1->acesso=='S'){
						$tables[$row1->modulo] = array(
							'descricao'	=> $row1->descricao,
							'modulo'	=> $row1->modulo
						);
						
						$data[$row1->modulo][] = array(
							'descricao'	=> $row1->descricao,
							'modulo'	=> $row1->modulo,
							'acao'		=> $row1->acao,
							'acao_id'	=> $row1->acao_id
						);
					}
				}
			}

			$_SESSION['MODEL_TABLES'] = serialize($tables);
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
		
		public function getMenu(){
			$json = array_values(unserialize($_SESSION['MODEL_TABLES']));
			$data = array();
			foreach($json as $row){
				$data[] = array(
					'descricao'	=> $row['descricao'],
					'iconCls'=> strtolower($row['modulo']),
					'controller'=> $this->setUpper($row['modulo']),
					'className'=> strtolower($row['modulo']).'.List',
					'id'=> 'List-'.$this->setUpper($row['modulo'])
				);
			}
			
			return json_encode(array('success'=> true, 'icon_desktop'=>$data, 'menu_start'=> $data));
		}
	}
?>