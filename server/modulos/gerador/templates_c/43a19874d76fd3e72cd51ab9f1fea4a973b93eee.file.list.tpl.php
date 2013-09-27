<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:09
         compiled from "class/smarty/templates/desktop/server/mysql/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178616672252457e11c75cc0-10009076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43a19874d76fd3e72cd51ab9f1fea4a973b93eee' => 
    array (
      0 => 'class/smarty/templates/desktop/server/mysql/list.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178616672252457e11c75cc0-10009076',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'TABELA' => 0,
    'datas' => 0,
    'CHAVE' => 0,
    'unique' => 0,
    'param' => 0,
    'comboStore' => 0,
    'field' => 0,
    'campos' => 0,
    'select_from' => 0,
    'filtro' => 0,
    'select_fields' => 0,
    'sort' => 0,
    'order' => 0,
    'start' => 0,
    'limit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e11f097b5_50338027',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e11f097b5_50338027')) {function content_52457e11f097b5_50338027($_smarty_tpl) {?><<?php ?>?php
<?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *<?php echo $_smarty_tpl->tpl_vars['datas']->value;?>
 
				FROM <?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>

				WHERE <?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
<?php if ($_smarty_tpl->tpl_vars['unique']->value==true){?>
		else if( isset($_POST['action']) AND $_POST['action'] == 'VALID_UNIQUE' ){
			
			$pdo = $connection->prepare("
				SELECT COUNT(*) as total 
				FROM <?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
 
				WHERE <?php echo $_smarty_tpl->tpl_vars['param']->value;?>
 = :valor 
			");
			$pdo->bindParam(':valor', $_POST['valor']);
			$pdo->execute();
		
			$total = $pdo->fetch(PDO::FETCH_OBJ)->total;
			
			if($total > 0){
				$success = false;
			} else{ $success = true; }
			
			echo json_encode( array('success'=>$success) );
		}
<?php }?>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comboStore']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>	
<?php if ($_smarty_tpl->tpl_vars['field']->value['combo']==true){?>
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT <?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
 as id, <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
 as descricao 
				FROM <?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>

			");
			$pdo->execute();
			
			$linhas = $pdo->fetchAll(PDO::FETCH_OBJ);
			echo json_encode( array('dados'=>$linhas) );
		}
<?php }?>
<?php } ?>
		else{
			$pag = new Paginar($_POST);
			
			$page 	= $pag->getPage();
			$start	= $pag->getStart();
			$limit	= $pag->getLimit();
			$sort 	= $pag->getSort();
			$order 	= $pag->getOrder();
			
			$result = array();
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['campos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='number'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']);
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='text'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'], 'like');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='combo'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']);
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='date'){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='datetime'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), implode('-', array_reverse(explode('/', $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date'])))." ".$_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time'], 'like');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='date'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), implode('-', array_reverse(explode('/', $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']))), 'like');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='time'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_POST['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'], 'like');
<?php }?>
<?php }?>
<?php } ?>
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
				FROM <?php echo $_smarty_tpl->tpl_vars['select_from']->value;?>
 
				<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
;
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT <?php echo $_smarty_tpl->tpl_vars['select_fields']->value;?>
 
				FROM <?php echo $_smarty_tpl->tpl_vars['select_from']->value;?>
 
				<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
 
				ORDER BY <?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['order']->value;?>
 
				LIMIT <?php echo $_smarty_tpl->tpl_vars['start']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
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