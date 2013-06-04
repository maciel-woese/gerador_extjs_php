<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

	require('../../autoLoad.php');
	echo $user->getTree();
	
?>
	