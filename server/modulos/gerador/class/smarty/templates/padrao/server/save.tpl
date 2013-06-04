<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

if($_POST){
	require('../../autoLoad.php');
	$tabela = '{$TABELA}';
	try {
		
		if($_POST['action'] == 'EDITAR'){
{if $permissoes == 'sim'}		
			$user->getAcao($tabela, 'editar');
{/if}		
			$pdo = $connection->prepare("
					UPDATE {$TABELA} SET 
{foreach from=$variaveis item=field name=variaveis}
							{$field.nome} = ?{if $smarty.foreach.variaveis.index!={$smarty.foreach.variaveis.total}-1},{/if}
							
{/foreach} 					WHERE {$CHAVE} = ?
			");
			$params = array(
{foreach from=$variaveis item=field name=foo3}
{if $field.tipo =='date'}				implode('-', array_reverse(explode('/', $_POST['{$field.nome}']))),
{/if}
{if $field.tipo =='datetime' or $field.tipo =='timestamp'}				implode('-', array_reverse(explode('/', $_POST['{$field.nome}_date'])))." ".$_POST['{$field.nome}_time'],
{/if}
{if $field.tipo !='date' and $field.tipo !='timestamp' and $field.tipo !='datetime'}
				$_POST['{$field.nome}'],
{/if}
{/foreach}
				$_POST['{$CHAVE}']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
{if $permissoes == 'sim'}		
			$user->getAcao($tabela, 'adicionar');
{/if}		
			$pdo = $connection->prepare("
				INSERT INTO {$TABELA} 
					(
{foreach from=$variaveis item=field name=foo}
						{$field.nome}{if $smarty.foreach.foo.index!={$smarty.foreach.foo.total}-1},{/if}
						
{/foreach}
					) 
				VALUES 
					(
					{foreach from=$variaveis item=field name=foo5}
	?{if $smarty.foreach.foo5.index!={$smarty.foreach.foo5.total}-1},{/if}
{/foreach}			
					)
			");
			$params = array(
{foreach from=$variaveis item=field name=foo2}
{if $field.tipo =='date'}				implode('-', array_reverse(explode('/', $_POST['{$field.nome}']))){if $smarty.foreach.foo2.index!={$smarty.foreach.foo2.total}-1},{/if}
{/if}
{if $field.tipo =='datetime' or $field.tipo =='timestamp'}				implode('-', array_reverse(explode('/', $_POST['{$field.nome}_date'])))." ".$_POST['{$field.nome}_time']{if $smarty.foreach.foo2.index!={$smarty.foreach.foo2.total}-1},{/if}
{/if}
{if $field.tipo !='date' and $field.tipo !='timestamp' and $field.tipo !='datetime'}
				$_POST['{$field.nome}']{if $smarty.foreach.foo2.index!={$smarty.foreach.foo2.total}-1},{/if}
{/if}		
{/foreach}
			);
			$pdo->execute($params);
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}