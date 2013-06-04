<?php
	if(!isset($_SESSION['id_usuario'])){
		session_start();
	}	
	
	if(isset($_POST['action']) and ($_POST['action']=='LOGIN_USER') and ($_POST['locale']=='en')){
		define('USER_REQUIRED', 'User and Password Required!');
		define('USER_USED', 'User in Use!');
		define('USER_BLOQ', 'Blocked User!');
		define('USER_PASS_INVALID', 'Invalid User ID and Password');
	}
	else{
		define('USER_REQUIRED', 'Usuário e Senha Obrigatórios!');
		define('USER_USED', 'Usuário em Uso!');
		define('USER_BLOQ', 'Usuário Bloqueado!');
		define('USER_PASS_INVALID', 'Usuário e Senha Inválidos');
	}
	
	class Usuarios{
		private $sql;
		
		private $id;
		private $nome;
		private $usuario;
		private $email;
		
		function __construct(){
			$this->sql = new Connection();
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getNome()
		{
			return $this->nome;
		}
		
		public function getEmail()
		{
			return $this->email;
		}
		
		public function getUsuario()
		{
			return $this->usuario;
		}
		
		public function isLogado(){	
			if( isset($_SESSION['id_usuario'])){	
				if(!empty($_SESSION['id_usuario']))
				{
					$this->id = $_SESSION['id_usuario'];
					$this->nome = $_SESSION['nome_usuario'];
					$this->usuario = $_SESSION['usuario_usuario'];
					$this->email = $_SESSION['email_usuario'];
					
					return true;
				}
				else
				{
					return false;
					exit;
				}
			} 
			else{
				return false;
				exit;
			}
		}
		
		public function setLogar($usuario, $senha, $tipo)
		{
			if(empty($usuario) or empty($senha)){
				throw new Exception(USER_REQUIRED);
			}
			else{
				$this->usuario = $usuario;
				$senha = md5(trim(rtrim($senha)));
				
				$sql = "SELECT * FROM usuarios WHERE login=:usuario AND senha=:senha;";
				
				$query = $this->sql->prepare($sql);
				$query->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
				$query->bindParam(':senha', $senha, PDO::PARAM_STR);
				$query->execute();
				
				$tempo = time();
				
				if($query->rowCount() > 0)
				{
					$result = $query->fetch(PDO::FETCH_OBJ);
					
					if($result->status!='1'){
						throw new Exception(USER_BLOQ);
					}
					else if((int) $result->tempo > $tempo){
						throw new Exception(USER_USED);
					}
					else{
						$query = $this->sql->prepare("UPDATE usuarios SET tempo = ? WHERE id = ?");
						$query->execute(array($tempo+20, $result->id));
					}
					
					$_SESSION['id_usuario'] = $result->id;
					$_SESSION['nome_usuario'] = $result->nome;
					$_SESSION['usuario_usuario'] = $result->login;
					$_SESSION['email_usuario'] = $result->email;
					$_SESSION['id_grupo_usuario'] = $result->id_grupo;
					$_SESSION['tipo_usuario'] = $tipo;
					$_SESSION['exportar_user'] = $result->exportar;
					
					if($result->exportar=='1'){
						$_SESSION['exportar_usuario'] = true;
					}
					else{
						$_SESSION['exportar_usuario'] = false;
					}
					
					return true;
				}
				else
				{
					throw new Exception(USER_PASS_INVALID);
				}
			}
		}
		
		public function setTempo($id){
			$sql = "SELECT * FROM usuarios WHERE id = ? AND status = '1' ";
			$query = $this->sql->prepare($sql);
			$query->execute(array($id));
			
			if($query->rowCount() == 0){
				throw new Exception('Usuario Bloqueado!');
			}	
			else{
				$tempo = time() + 20;
				$query = $this->sql->prepare("UPDATE usuarios SET tempo = ? WHERE id = ?");
				$query->execute(array($tempo, $id));
			}
		} 
		
		public function setLogout(){
			if($this->isLogado())
			{
				unset($_SESSION['id_usuario']);
				unset($_SESSION['nome_usuario']);
				unset($_SESSION['usuario_usuario']);
				unset($_SESSION['email_usuario']);
				session_destroy();
			}
		}
	}
?>