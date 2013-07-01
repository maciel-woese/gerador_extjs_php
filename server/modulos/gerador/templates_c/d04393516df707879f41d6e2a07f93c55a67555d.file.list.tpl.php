<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/usuarios/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155799322051d18a1846fcf7-37849931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd04393516df707879f41d6e2a07f93c55a67555d' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/usuarios/list.tpl',
      1 => 1351273435,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155799322051d18a1846fcf7-37849931',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'like' => 0,
    'filtro' => 0,
    'select' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1848e406_78375364',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1848e406_78375364')) {function content_51d18a1848e406_78375364($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'usuarios';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM usuarios
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else{
			$pag = new Paginar($_POST);
			
			$page 	= $pag->getPage();
			$start	= $pag->getStart();
			$limit	= $pag->getLimit();
			$sort 	= $pag->getSort();
			$order 	= $pag->getOrder();
			
			$result = array();
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
				$buscar->setBusca(array('nome', 'usuarios.nome'), $_POST['nome'], '<?php echo $_smarty_tpl->tpl_vars['like']->value;?>
');
				$buscar->setBusca(array('perfil_id', 'usuarios.perfil_id'), $_POST['perfil_id']);
				$buscar->setBusca(array('email', 'usuarios.email'), $_POST['email'], '<?php echo $_smarty_tpl->tpl_vars['like']->value;?>
');
				$buscar->setBusca(array('login', 'usuarios.login'), $_POST['login'], '<?php echo $_smarty_tpl->tpl_vars['like']->value;?>
');
				$buscar->setBusca(array('administrador', 'usuarios.administrador'), $_POST['administrador'], '<?php echo $_smarty_tpl->tpl_vars['like']->value;?>
');
				$buscar->setBusca(array('status', 'usuarios.status'), $_POST['status'], '<?php echo $_smarty_tpl->tpl_vars['like']->value;?>
');
			}
			
			if (isset($_POST['sort']))
			{
				$sortJson = json_decode( $_POST['sort'] );
				$sort = trim(rtrim(addslashes($sortJson[0]->property )));
				$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
			}
			
			$filtro = $buscar->getSql();
			
			$pdo = $connection->prepare("
				SELECT count(*) as total 
				FROM usuarios INNER JOIN perfil ON
					(usuarios.perfil_id=perfil.id) 
				<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
;
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				<?php echo $_smarty_tpl->tpl_vars['select']->value;?>
;
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetchAll(PDO::FETCH_OBJ);
			
			$result["total"] = $countRow;
			$result["dados"] = $query;
			
			echo json_encode($result);
		}
	} 
	catch (PDOException $e) {
		echo json_encode(array('dados'=>array(),'total'=>0, 'erro'=>$e->getMessage()));
	}	
}
?<?php ?>><?php }} ?>