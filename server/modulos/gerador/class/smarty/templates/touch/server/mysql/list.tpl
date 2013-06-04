<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

if($_POST){
	try {
		require('../../autoLoad.php');
		$buscar = new Buscar();
		$tabela = '{$TABELA}';
		
		if( isset($_POST['action']) AND $_POST['action'] == 'GET_VALUES' ){
		
			$pdo = $connection->prepare("
				SELECT *{$datas} 
				FROM {$TABELA}
				WHERE {$CHAVE}=:id
			");
			
			$pdo->bindParam(':id', $_POST['id']);
			$pdo->execute();
		
			$linhas = $pdo->fetch(PDO::FETCH_OBJ);
			echo json_encode( array('success'=>true, 'dados'=>$linhas) );
		}
{if $unique == true}
		else if( isset($_POST['action']) AND $_POST['action'] == 'VALID_UNIQUE' ){
			
			$pdo = $connection->prepare("
				SELECT COUNT(*) as total 
				FROM {$TABELA} 
				WHERE {$param} = :valor 
			");
			$pdo->bindParam(':valor', $_POST['valor']);
			$pdo->execute();
		
			$total = $pdo->fetch(PDO::FETCH_OBJ)->total;
			
			if($total > 0){
				$success = false;
			} else{ $success = true; }
			
			echo json_encode( array('success'=>$success) );
		}
{/if}
{foreach from=$comboStore item=field name=foo3}	
{if $field.combo == true}
		else if(isset($_POST['action']) AND $_POST['action'] == 'LIST_COMBO'){
			
			$pdo = $connection->prepare("
				SELECT {$field.value} as id, {$field.label} as descricao 
				FROM {$TABELA}
			");
			$pdo->execute();
			
			$linhas = $pdo->fetchAll(PDO::FETCH_OBJ);
			echo json_encode( array('dados'=>$linhas) );
		}
{/if}
{/foreach}
		else{
			$pag = new Paginar($_POST);
			
			$page 	= $pag->getPage();
			$start	= $pag->getStart();
			$limit	= $pag->getLimit();
			$sort 	= $pag->getSort();
			$order 	= $pag->getOrder();
			
			$result = array();
			
			if(isset($_POST['action']) AND $_POST['action'] == 'FILTER'){
{foreach from=$campos item=field name=foo3}
{if $field.tipo=='number'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_POST['{$field.nome}']);
{/if}
{if $field.tipo=='text'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_POST['{$field.nome}'], 'like');
{/if}
{if $field.tipo=='combo'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_POST['{$field.nome}']);
{/if}
{if $field.tipo=='date'}
{if $field.format=='datetime'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), implode('-', array_reverse(explode('/', $_POST['{$field.nome}_date'])))." ".$_POST['{$field.nome}_time'], 'like');
{/if}
{if $field.format=='date'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), implode('-', array_reverse(explode('/', $_POST['{$field.nome}']))), 'like');
{/if}
{if $field.format=='time'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_POST['{$field.nome}'], 'like');
{/if}
{/if}
{/foreach}
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
				FROM {$select_from} 
				{$filtro};
			");
			$pdo->execute( $buscar->getArrayExecute() );
			
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			$countRow = $query->total;
			
			$pdo = $connection->prepare("
				SELECT {$select_fields} 
				FROM {$select_from} 
				{$filtro} 
				ORDER BY {$sort} {$order} 
				LIMIT {$start}, {$limit};
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
?>