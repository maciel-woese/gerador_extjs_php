<?php
	class App {
		public $smarty  = null;
		public $arquivo = null;
		public $tabela	= null;
		public $dirApp  = 'class/generated/applicationTouchMVC/';
		public $dirTpl  = 'class/smarty/templates/touch/';
		public $dados 	= array();
		public $url 	= 'lista';
		
		public function App($smarty, $tabela, $dados, $arquivo){
			$this->dirApp = "class/generated/{$_SESSION['id_usuario']}/touch/";
			
			if($this->smarty==null){
				$this->smarty 	= $smarty;
			}
			$this->tabela	= $tabela; 
			$this->dados 	= $dados;
			$this->arquivo  = $arquivo;
			$arquivo->init($this->dirApp, $this->tabela);
			
			$_SESSION['caminho_project'] = $this->dirApp;
			
			$this->url = 'lista';
			if((isset($_SESSION['touch_tela'])) and ($_SESSION['touch_tela']=='icone')){
				$this->url = 'icone';
			}
		}
		
		public function init($dados){
			$this->dados = $dados;
		}
		
		public function varBr(){
			$this->smarty->assign('sair', 'Sair');
			$this->smarty->assign('hora', 'Hora');
			$this->smarty->assign('button_back', 'Voltar');
			$this->smarty->assign('load_more', 'Carregar mais...');
			$this->smarty->assign('no_records', 'N&atilde;o &agrave; mais registros');
			
			$this->smarty->assign('locale', 'br');
			$this->smarty->assign('loading_msg_style', 'Carregando Styles e Imagens, Aguarde...');
			$this->smarty->assign('loading_msg_framework', 'Carregando Framework, Aguarde...');
			$this->smarty->assign('loading_msg_tradutor', 'Carregando Tradutor, Aguarde...');
			$this->smarty->assign('loading_msg_plugins', 'Carregando Plugins, Aguarde...');
			$this->smarty->assign('loading_msg_modulos', 'Carregando M&oacute;dulos, Aguarde...');
			
			$this->smarty->assign('title_filter', 'Filtro de');
			$this->smarty->assign('button_reset_filtro', 'Resetar Filtro');
			$this->smarty->assign('button_filtrar', 'Filtrar');
			
			$this->smarty->assign('button_adicionar', 'Adicionar');
			$this->smarty->assign('button_editar', 'Editar');
			$this->smarty->assign('button_deletar', 'Deletar');
			$this->smarty->assign('button_pdf', 'Gerar PDF');
			
			$this->smarty->assign('title_login', 'Login do Sistema');
			$this->smarty->assign('login_login', 'Login');
			$this->smarty->assign('password_login', 'Senha');
			$this->smarty->assign('reset_form', 'Resetar');
			$this->smarty->assign('button_connect', 'Conectar');
			$this->smarty->assign('aguarde', 'Aguarde...');
			$this->smarty->assign('error', 'Erro!');
			
			$this->smarty->assign('title_menu', 'M&oacute;dulos');
			$this->smarty->assign('confirm', 'Confirmar');
			$this->smarty->assign('sair_sistema', 'Deseja Sair do Sistema?');
			$this->smarty->assign('title_window', 'Cadastro de');
			$this->smarty->assign('button_save', 'Salvar');
			$this->smarty->assign('store_load_data', 'Aguarde Carregando Dados...');
	
			$this->smarty->assign('title_window_edit', 'Edi&ccedil;&atilde;o de');
			$this->smarty->assign('delete_msg', 'Deseja deletar');
			$this->smarty->assign('aviso', 'Aviso!');
			$this->smarty->assign('delete_aguarde', 'Deletando, Aguarde...');
			$this->smarty->assign('select_delete', 'Selecione um Registro para Deletar!');
			$this->smarty->assign('select_edit', 'Selecione um Registro para Editar!');
			$this->smarty->assign('ajax_lost', 'Comunica&ccedil;&atilde;o Ajax Perdida');
			$this->smarty->assign('fields_invalids', 'Campos com valores invalidos');
			$this->smarty->assign('exist_fields_requireds', 'Existem campos obrigatorios...');
			$this->smarty->assign('server_failure', 'Falha no Servidor Codigo de erro: ');
			
			$this->smarty->assign('menu_list', 'Listagem de');
			$this->smarty->assign('menu_cad', 'Cadastro de');

			$this->smarty->assign('login_required', 'Login e Senha obrigatórios!');
			$this->smarty->assign('user_bloq', 'Usuário bloqueado!');
			$this->smarty->assign('user_incorrect', 'Usuário e senha incorretos!');
			$this->smarty->assign('permissoes_insuf', 'Permissões Insuficientes!');
			$this->smarty->assign('perfil_menu', 'Perfil');
			$this->smarty->assign('user_menu', 'Usuários');
			
			$this->smarty->assign('REMOVED_SUCCESS', 'Removido com Sucesso');
			$this->smarty->assign('SAVED_SUCCESS', 'Salvo com Sucesso');
			$this->smarty->assign('ERRO_DELETE_DATA', 'Erro ao Deletar Dados');
			$this->smarty->assign('ERROR_SAVE_DATA', 'Erro ao Salvar Dados');
			$this->smarty->assign('ACTION_NOT_FOUND', 'Ação Não Encontrada');
			
			$this->smarty->assign('ENTRADA_ERROR', 'A Entrada');
			$this->smarty->assign('EXISTE_ERROR', 'Já Existe');
			$this->smarty->assign('ERROR_1451', 'Este Registro está relacionado e não pode ser deletado');
		}
		
		public function varEn(){
			$this->smarty->assign('sair', 'Logout');
			$this->smarty->assign('button_back', 'Back');
			$this->smarty->assign('load_more', 'Load More...');
			$this->smarty->assign('no_records', 'No more records');
			$this->smarty->assign('hora', 'Hour');
			
			$this->smarty->assign('view_desktop', 'Show Workfield');
			$this->smarty->assign('title_preferences', 'Preferences');
			$this->smarty->assign('tree_auto_run', 'Autostart');
			$this->smarty->assign('tree_quick_start', 'rapid startup');
			$this->smarty->assign('tree_icon_desktop', 'Icons workspace');
			$this->smarty->assign('tree_start_menu', 'Start Menu');
			
			$this->smarty->assign('locale', 'en');
			$this->smarty->assign('loading_msg_style', 'Loading Styles and Graphics, Wait...');
			$this->smarty->assign('loading_msg_framework', 'Loading Framework, Wait...');
			$this->smarty->assign('loading_msg_tradutor', 'Loading translator, Wait...');
			$this->smarty->assign('loading_msg_plugins', 'Loading Plugins, Wait...');
			$this->smarty->assign('loading_msg_modulos', 'Loading Modules, Wait...');
			
			$this->smarty->assign('title_relatorio', 'Report');
			$this->smarty->assign('title_filter', 'Filter');
			$this->smarty->assign('button_reset_filtro', 'Reset Filter');
			$this->smarty->assign('button_filtrar', 'Filter');
			
			$this->smarty->assign('button_adicionar', 'Add');
			$this->smarty->assign('button_editar', 'Edit');
			$this->smarty->assign('button_deletar', 'Delete');
			$this->smarty->assign('button_pdf', 'Generate PDF');
			
			$this->smarty->assign('title_login', 'System Login');
			$this->smarty->assign('login_login', 'Login');
			$this->smarty->assign('password_login', 'Password');
			$this->smarty->assign('reset_form', 'Reset');
			$this->smarty->assign('button_connect', 'Connect');
			$this->smarty->assign('aguarde', 'Wait...');
			$this->smarty->assign('error', 'Error!');
			
			$this->smarty->assign('title_menu', 'Modules');
			$this->smarty->assign('confirm', 'Confirm');
			$this->smarty->assign('sair_sistema', 'Want Exit System?');
			$this->smarty->assign('title_window', 'Cadastre ');
			$this->smarty->assign('button_save', 'Save');
			$this->smarty->assign('store_load_data', 'Wait Loading Data...');
	
			$this->smarty->assign('title_window_edit', 'Editing');
			$this->smarty->assign('delete_msg', 'want to delete');
			$this->smarty->assign('aviso', 'warning!');
			$this->smarty->assign('delete_aguarde', 'Deleting, Wait...');
			$this->smarty->assign('select_delete', 'Select a registry to Delete!');
			$this->smarty->assign('select_edit', 'Select a registry to Edit!');
			$this->smarty->assign('ajax_lost', 'Lost Communication Ajax');
			$this->smarty->assign('fields_invalids', 'Fields with invalid values');
			$this->smarty->assign('exist_fields_requireds', 'There are required fields...');
			$this->smarty->assign('server_failure', 'Failure Server Error Code: ');
			
			$this->smarty->assign('menu_list', 'Listing');
			$this->smarty->assign('menu_cad', 'Cadastre');

			$this->smarty->assign('login_required', 'Login and Password Required!');
			$this->smarty->assign('user_bloq', 'User locked!');
			$this->smarty->assign('user_incorrect', 'User and password incorrect!');
			$this->smarty->assign('permissoes_insuf', 'Insufficient Permissions!');
			$this->smarty->assign('perfil_menu', 'Profile');
			$this->smarty->assign('user_menu', 'Users');
			
			$this->smarty->assign('REMOVED_SUCCESS', 'Removed Successfully');
			$this->smarty->assign('SAVED_SUCCESS', 'Saved Successfully');
			$this->smarty->assign('ERRO_DELETE_DATA', 'Error Deleting Data');
			$this->smarty->assign('ERROR_SAVE_DATA', 'Error Saving Data');
			$this->smarty->assign('ACTION_NOT_FOUND', 'Action Not Found');
			
			$this->smarty->assign('ENTRADA_ERROR', 'The Entrance');
			$this->smarty->assign('EXISTE_ERROR', 'Exists');
			$this->smarty->assign('ERROR_1451', 'This registration is related and can not be deleted');
		}
		
		public function getLanguage(){
			if($_SESSION['language']=='en'){
				$this->varEn();
			}
			else{
				$this->varBr();
			}
		}
		
		
		public function gerarApp(){
			$this->getLanguage();
			
			$f = $this->initFiltro();
			$s = $this->initStore();
			$w = $this->initWindow();
			$m = $this->initModel();
			$l = $this->initController();
			$g = $this->initGrid();
			
			$this->arquivo->create($s, 'store');
			$this->arquivo->create($w, 'window');
			$this->arquivo->create($m, 'model');
			$this->arquivo->create($l, 'control');
			$this->arquivo->create($g, 'grid');
			$this->arquivo->create($f, 'filtro');
		}
		
		public function gerarCombo($store){
			$sc = $this->initStoreCombo();
			$mc = $this->initModelCombo();
			
			$this->arquivo->create($sc, 'storecombo');
			$this->arquivo->create($mc, 'modelcombo');
		}
		
		/**
		*	@Copilar Template Controller
		*	@return Controller Copilado
		*/
		public function initController(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('modelCombo', $this->dados['comboClass']);
			$this->smarty->assign('stores', $this->dados['storeLocal']);
			$this->smarty->assign('models', count($this->dados['storeLocal']));
			$this->smarty->assign('campos', $this->dados['campos']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('combo',  $this->dados['comboClass']);
			$this->smarty->assign('permissoes',  $this->dados['permissoes']);
			$result = array();
			foreach ($this->dados['columns'] as $row){
				if($row['mask']!=""){
					$result[] = $row; 
				}
			}
			
			$this->smarty->assign('setmask',  $result);
			return $this->smarty->fetch($this->dirTpl . 'controller/controller.tpl');
		}
		
		/**
		*	@Copilar Template Store
		*	@return Store Copilado
		*/
		public function initStore(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);

			return $this->smarty->fetch($this->dirTpl . 'store/store.tpl');
		}
		
		/**
		*	@Copilar Template StoreCombo
		*	@return StoreCombo Copilado
		*/
		public function initStoreCombo(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->tabela);
			$this->smarty->assign('store', $this->dados['store']);
			$this->smarty->assign('app', $this->dados['app']);
			
			return $this->smarty->fetch($this->dirTpl . 'store/storeCombo.tpl');
		}
		
		/**
		*	@Copilar Template StoreComboLocal
		*	@return StoreComboLocal Copilado
		*/
		public function initStoreComboLocal($campo, $data, $tabela){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('campo', $campo);
			$this->smarty->assign('TABELA', $tabela);
			$this->smarty->assign('store', $this->dados['store']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('data', $data);
		
			return $this->smarty->fetch($this->dirTpl . 'store/storeComboLocal.tpl');
		}
		
		/**
		*	@Copilar Template ModelCombo
		*	@return ModelCombo Copilado
		*/
		public function initModelCombo($local=false){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('app', $this->dados['app']);
			if($local==false){
				$this->smarty->assign('type', 'int');
				$this->smarty->assign('name', 'ModelCombo');
			}
			else{
				$this->smarty->assign('type', 'auto');
				$this->smarty->assign('name', 'ModelComboLocal');
			}
			
			return $this->smarty->fetch($this->dirTpl . 'model/modelCombo.tpl');
		}
		
		/**
		*	@Copilar Template Model
		*	@return Model Copilado
		*/
		public function initModel(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('fields', $this->dados['fields']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('form', $this->dados['form']);
			return $this->smarty->fetch($this->dirTpl . 'model/model.tpl');
		}
		
		/**
		*	@Copilar Template Grid
		*	@return Grid Copilado
		*/
		public function initGrid(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('pdf',  $this->dados['gerarPDF']);
			$result = array();
			
			foreach ($this->dados['columns'] as $row){
				$campo = $this->arquivo->setUpperTabela($row["dataIndex"]);
				if($row["renderer"]!='false'){
					$row['dataIndex'] = '{[this.set'.$campo.'(values.'.$row["dataIndex"].')]}';
					$row['dataIndexFunction'] = 'set'.$campo;
				}
				else if($row["xtype"]=='date'){
					$row['dataIndex'] = '{[this.set'.$campo.'(values.'.$row["dataIndex"].')]}';
					$row['dataIndexFunction'] = 'set'.$campo;
				}
				else if($row["mask"]!=''){
					$row['dataIndex'] = '{[this.set'.$campo.'(values.'.$row["dataIndex"].')]}';
					$row['dataIndexFunction'] = 'set'.$campo;
				}
				else{
					$row['dataIndex'] = '{'.$row["dataIndex"].'}';
					$row['dataIndexFunction'] = 'false';
				}
				
				$result[] = $row;
			}
			
			$this->smarty->assign('columns', $result);
			return $this->smarty->fetch($this->dirTpl . 'view/grid.tpl');
		}
		
		/**
		*	@Copilar Template Window
		*	@return Window Copilado
		*/
		public function initWindow(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);
			
			$storTable = false;
			if(count($this->dados['foreignClass'])==0){

			}
			else{
				for($i=0;$i<count($this->dados['foreignClass']);$i++){
					$storTable[] = ucwords($this->dados['foreignClass'][$i]['tab_ref']);
				}
			}
			$this->smarty->assign('storTable',  $storTable);
			$this->smarty->assign('form', $this->dados['form']);
			return $this->smarty->fetch($this->dirTpl . 'view/window.tpl');
		}
		
		/**
		*	@Copilar Template Filtro
		*	@return Filtro Copilado
		*/
		public function initFiltro(){
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('TABELA', $this->dados['tabela']);
			$this->smarty->assign('CHAVE', $this->dados['chave']);
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('form', $this->dados['form']);
			return $this->smarty->fetch($this->dirTpl . 'view/filtro.tpl');
			
		}
		
		/**
		*	@Copilar Template Arquivos de Controles
		*	@return Arquivos de Controles Copilado
		*/
		public function createControllerPrincipal(){
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('item_tpl', "
					'<div class=\"ux-desktop-shortcut\" id=\"'+id+'\" modulo=\"{modulo}\" action=\"{action}\">',
					'<div class=\"ux-desktop-shortcut-icon {modulo}\" modulo=\"{modulo}\" action=\"{action}\">',
					'</div>',
					'<span class=\"ux-desktop-shortcut-text\" modulo=\"{modulo}\" action=\"{action}\">{descricao}</span>',
				'</div>'
			");
			
			$l = $this->smarty->fetch($this->dirTpl."controller/{$this->url}/controllerPrincipal.tpl");
			$file = $this->dirApp."app/controller/Principal.js";
			$arq = fopen($file,"w");
			fwrite($arq, $l);
			fclose($arq);
			
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('store_init', $this->url);
			
			$this->smarty->assign('descricao', "{descricao}");
			$l = $this->smarty->fetch($this->dirTpl."view/{$this->url}/Principal.tpl");
			$file = $this->dirApp."app/view/Principal.js";
			$arq = fopen($file,"w");
			fwrite($arq, $l);
			fclose($arq);
			
			if($this->url=='lista'){
				$this->smarty->assign('app', $this->dados['app']);
				$l = $this->smarty->fetch($this->dirTpl.'store/StorePrincipal.tpl');
				$file = $this->dirApp."app/store/StorePrincipal.js";
				$arq = fopen($file,"w");
				fwrite($arq, $l);
				fclose($arq);

				$this->smarty->assign('app', $this->dados['app']);
				$l = $this->smarty->fetch($this->dirTpl.'model/ModelPrincipal.tpl');
				$file = $this->dirApp."app/model/ModelPrincipal.js";
				$arq = fopen($file,"w");
				fwrite($arq, $l);
				fclose($arq);
			}

			$this->smarty->assign('app', $this->dados['app']);
			$l = $this->smarty->fetch($this->dirTpl."controller/{$this->url}/Util.tpl");
			$file = $this->dirApp."app/controller/Util.js";
			$arq = fopen($file,"w");
			fwrite($arq, $l);
			fclose($arq);

			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('tipo_banco', $this->dados['tipo_banco']);
			$this->smarty->assign('banco', $this->dados['banco']);
			$this->smarty->assign('host', $this->dados['host']);
			$this->smarty->assign('user', $this->dados['user']);
			$this->smarty->assign('senha', $this->dados['senha']);
			
			$l = $this->smarty->fetch($this->dirTpl.'server/Connection.class.tpl');
			$file = $this->dirApp."server/lib/Connection.class.php";
			$arq = fopen($file,"w");
			fwrite($arq, $l);
			fclose($arq);
		}
		
		/**
		*	@Copilar Template App
		*	@return App Copilado
		*/
		public function createAplication(){
			$dir = $this->dirApp;
			
			$this->arquivo->create($this->initIndex(), 'index');
			$this->createControllerPrincipal();
			$this->createMenu();
			$this->createCss();
			$this->createAutoLoad();
			$this->createFuncoes();
			
			$this->smarty->assign('autor', $this->dados['autor']);
			$this->smarty->assign('permissoes', $this->dados['permissoes']);
			
			$filesController = $this->arquivo->filesDir($dir.'app/controller/', false, 'Util');
			
			$principal = false;
			$perfil = false;
			$permissoes = false;
			$usuarios = false;
			foreach($filesController as $control){
				if($control=='Principal'){
					$principal = true;
				}
				else if($control=='Perfil'){
					$perfil = true;
				}
				else if($control=='Permissoes'){
					$permissoes = true;
				}
				else if($control=='Usuarios'){
					$usuarios = true;
				}
			}
			
			if($principal==false){
				$filesController[] = 'Principal';
			}
			if($this->dados['permissoes']=='sim'){
				if($perfil==false){
					$filesController[] = 'Perfil';
				}
				if($permissoes==false){
					$filesController[] = 'Permissoes';
				}
				if($usuarios==false){
					$filesController[] = 'Usuarios';
				}
			}
			
			$this->smarty->assign('controller', $filesController);
			$l = $this->smarty->fetch($this->dirTpl.'view/app.tpl');
			
			$file = $this->dirApp."app.js";

			$arq = fopen($file,"w");
			fwrite($arq, $l);
			fclose($arq);
			
			if($this->dados['permissoes']=='sim'){
				$this->createUsuarios();
				$this->createSql();
				$this->createLogin();
				
				$this->createAllModulos();
				
				$modulo 	= $this->initModelCombo(true);
				$this->arquivo->create($modulo, 'modelcombo', false, 'ModelComboLocal');
				$modulo2 	= $this->initModelCombo();
				$this->arquivo->create($modulo2, 'modelcombo', false, 'ModelCombo');
			}
			return true;
		}
		
		public function createAllModulos(){
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('filtro', '{$filtro}');
			$this->smarty->assign('like', 'like');
			$this->createModuloPerfil();
			$this->createModuloUsuarios();
			$this->createModuloPermissoes();
		}
		
		public function createModuloPerfil(){
			$select = '
				SELECT perfil.* 
				FROM perfil 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit}
			';
			
			$this->arquivo->tabela = 'perfil';
			
			$this->smarty->assign('select', $select);
			if($_SESSION['language']=='br'){
				$this->smarty->assign('item_tpl', "
					'<div class=\"gridlist\"><b>Perfil: </b> {perfil}</div>'
				");
			}
			else{
				$this->smarty->assign('item_tpl', "
					'<div class=\"gridlist\"><b>Profile: </b> {perfil}</div>'
				");
			}
			
			$controller = $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/controller.tpl");
			$edit		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/edit.tpl");
			$grid		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/grid.tpl");
			$filter		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/filter.tpl");
			$model		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/model.tpl");
			$store		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/store.tpl");
			$storecombo	= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/storecombo.tpl");
			
			$list		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/list.tpl");
			$delete		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/delete.tpl");
			$save		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/perfil/save.tpl");
			
			$this->arquivo->create($store, 'store');
			$this->arquivo->create($edit, 'window');
			$this->arquivo->create($model, 'model');
			$this->arquivo->create($controller, 'control');
			$this->arquivo->create($grid, 'grid');
			$this->arquivo->create($filter, 'filtro');
			$this->arquivo->create($storecombo, 'storecombo');
			
			$this->arquivo->create($list, 'list');
			$this->arquivo->create($delete, 'delete');
			$this->arquivo->create($save, 'save');
		}
		
		public function createModuloUsuarios(){
			$select = '
				SELECT usuarios.*, perfil.perfil 
				FROM usuarios INNER JOIN perfil ON
					(usuarios.perfil_id=perfil.id) 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit}
			';
			
			$this->arquivo->tabela = 'usuarios';
			
			$this->smarty->assign('select', $select);
			
			if($_SESSION['language']=='br'){
				$this->smarty->assign('item_tpl', "
					'<div class=\"gridlist\"><b>Nome: </b> {nome}</div>',			
					'<div class=\"gridlist\"><b>Perfil: </b> {perfil}</div>',			
					'<div class=\"gridlist\"><b>Email: </b> {email}</div>',			
					'<div class=\"gridlist\"><b>Login: </b> {login}</div>',			
					'<div class=\"gridlist\"><b>Senha: </b> {senha}</div>',			
					'<div class=\"gridlist\"><b>Administrador: </b> {[this.setAdministrador(values.administrador)]}</div>',			
					'<div class=\"gridlist\"><b>Status: </b> {[this.setStatus(values.status)]}</div>',
				");
			}
			else{
				$this->smarty->assign('item_tpl', "
					'<div class=\"gridlist\"><b>Name: </b> {nome}</div>',			
					'<div class=\"gridlist\"><b>Profile: </b> {perfil}</div>',			
					'<div class=\"gridlist\"><b>Email: </b> {email}</div>',			
					'<div class=\"gridlist\"><b>Login: </b> {login}</div>',			
					'<div class=\"gridlist\"><b>Password: </b> {senha}</div>',			
					'<div class=\"gridlist\"><b>Administrator: </b> {[this.setAdministrador(values.administrador)]}</div>',			
					'<div class=\"gridlist\"><b>Status: </b> {[this.setStatus(values.status)]}</div>',
				");
			}
			
			$controller = $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/controller.tpl");
			$edit		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/edit.tpl");
			$grid		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/grid.tpl");
			$filter		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/filter.tpl");
			$model		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/model.tpl");
			$store		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/store.tpl");
			
			$storecombA	= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/storecomboAdm.tpl");
			$storecombS	= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/storecomboSta.tpl");
			
			$list		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/list.tpl");
			$delete		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/delete.tpl");
			$save		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/usuarios/save.tpl");
			
			$this->arquivo->create($store, 'store');
			$this->arquivo->create($edit, 'window');
			$this->arquivo->create($model, 'model');
			$this->arquivo->create($controller, 'control');
			$this->arquivo->create($grid, 'grid');
			$this->arquivo->create($filter, 'filtro');
			
			$this->arquivo->create($storecombA, 'storecombolocal', 'administrador');
			$this->arquivo->create($storecombS, 'storecombolocal', 'status');
			
			$this->arquivo->create($list, 'list');
			$this->arquivo->create($delete, 'delete');
			$this->arquivo->create($save, 'save');
		}
		
		public function createModuloPermissoes(){
			$select = '
				SELECT usuarios.*, perfil.perfil 
				FROM usuarios INNER JOIN perfil ON
					(usuarios.perfil_id=perfil.id) 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit}
			';
			
			$this->arquivo->tabela = 'permissoes';
			
			$this->smarty->assign('select', $select);
			
			
			if($_SESSION['language']=='br'){
				$this->smarty->assign('item_tpl', "
					'<div class=\"gridlist\"><b>Tipo: </b> {text}</div>'
				");
			}
			else{
				$this->smarty->assign('item_tpl', "
					'<div class=\"gridlist\"><b>Type: </b> {text}</div>'
				");
			}
			
			$controller = $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/controller.tpl");
			$edit		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/edit.tpl");
			$model		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/model.tpl");
			$store		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/store.tpl");
			
			$list		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/list.tpl");
			$save		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/save.tpl");
			$class		= $this->smarty->fetch($this->dirTpl . "permissoes_{$_SESSION['language']}/permissoes/class.tpl");
			
			$this->arquivo->create($store, 'store');
			$this->arquivo->create($edit, 'window');
			$this->arquivo->create($model, 'model');
			$this->arquivo->create($controller, 'control');
			
			$this->arquivo->create($list, 'list');
			$this->arquivo->create($class, 'class');
			$this->arquivo->create($save, 'save');
			
			$modulo 	= $this->initModelCombo(true);
			$this->arquivo->create($modulo, 'modelcombo', false, 'ModelComboLocal');
			$modulo2 	= $this->initModelCombo();
			$this->arquivo->create($modulo2, 'modelcombo', false, 'ModelCombo');
		}
		
		public function createLogin(){
			$user = $this->smarty->fetch($this->dirTpl . "view/Login.tpl");
			$file = $this->dirApp."app/view/Login.js";
		
			$arq = fopen($file,"w");
			fwrite($arq, $user);
			fclose($arq);
				
			$user = $this->smarty->fetch($this->dirTpl . "server/Login.tpl");
			$file = $this->dirApp."server/modulos/login.php";
		
			$arq = fopen($file,"w");
			fwrite($arq, $user);
			fclose($arq);
		}
		
		public function createSql(){
			$this->smarty->assign('permissoes', $this->dados['permissoes']);
			$user = $this->smarty->fetch($this->dirTpl . "server/{$this->dados['tipo_banco']}/sql.tpl");
			$file = $this->dirApp."sqlUsuarios.sql";
		
			$arq = fopen($file,"w");
			fwrite($arq, $user);
			fclose($arq);
		}
		
		public function createUsuarios(){
			$this->smarty->assign('permissoes', $this->dados['permissoes']);
			$user = $this->smarty->fetch($this->dirTpl . "server/Usuarios.class.tpl");
			$file = $this->dirApp."server/lib/Usuarios.class.php";
		
			$arq = fopen($file,"w");
			fwrite($arq, $user);
			fclose($arq);
		}
		
		public function createAutoLoad(){
			$user = $this->smarty->fetch($this->dirTpl . 'server/autoLoad.tpl');
			$file = $this->dirApp."server/autoLoad.php";
		
			$arq = fopen($file,"w");
			fwrite($arq, $user);
			fclose($arq);
		}
		
		public function createFuncoes(){
			$user = $this->smarty->fetch($this->dirTpl . 'server/funcoes.tpl');
			$file = $this->dirApp."server/lib/funcoes.php";
		
			$arq = fopen($file,"w");
			fwrite($arq, $user);
			fclose($arq);
		}
		
		public function initIndex(){
			$this->smarty->assign('app', $this->dados['app']);
			$this->smarty->assign('versao', $this->dados['versao']);
			$this->smarty->assign('data', date('Ymd'));
			$this->smarty->assign('titulo', $this->dados['titulo']);
			
			return $this->smarty->fetch($this->dirTpl . 'index.tpl');
		}
		
		public function createMenu(){
			$this->smarty->assign('menu', $_SESSION['TABLES_INSERTED']);
			
			if($this->dados['permissoes']=='sim'){
				$menu = $this->smarty->fetch($this->dirTpl . "server/menu_usuario.tpl");
			}
			else{
				$menu = $this->smarty->fetch($this->dirTpl . "server/menu.tpl");
			}
			$file = $this->dirApp."server/modulos/menu.php";
			
			$arq = fopen($file,"w");
			fwrite($arq, $menu);
			fclose($arq);
		}
		
		public function createCss(){
			if($this->url=='icone'){
				$this->smarty->assign('tabelas', $this->dados['AllTables']);
			}	
			else{
				$this->smarty->assign('tabelas', array());
			}
			
			$css = $this->smarty->fetch($this->dirTpl . 'css.tpl');
			$file = $this->dirApp."resources/css/style.css";

			$arq = fopen($file,"w");
			fwrite($arq, $css);
			fclose($arq);
		}
	}

?>