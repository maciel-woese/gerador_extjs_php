<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/perfil/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159155747152457e13d946a5-71685745%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bd985deae1f6e92bbf8e4518a22e648ba3d4521' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/perfil/list.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159155747152457e13d946a5-71685745',
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
  'unifunc' => 'content_52457e13dc7680_66314595',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13dc7680_66314595')) {function content_52457e13dc7680_66314595($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = 'perfil';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT * 
				FROM perfil
				WHERE id=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
	
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT id as id, perfil as descricao 
				FROM perfil
			");
			$pdo->execute();
			
			$linhas = $pdo->fetchAll(PDO::FETCH_OBJ);
			echo json_encode( array('dados'=>$linhas) );
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
				$buscar->setBusca(array('perfil', 'perfil.perfil'), $_POST['perfil'], '<?php echo $_smarty_tpl->tpl_vars['like']->value;?>
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
				FROM perfil 
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