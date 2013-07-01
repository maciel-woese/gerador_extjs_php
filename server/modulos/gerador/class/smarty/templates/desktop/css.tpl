{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}
/*SHORTCUT*/
{foreach from=$tabelas item=field name=form}
	.{$field}-shortcut {
		background-image: url(../images/list48x48.png);
	}
{/foreach}
	.perfil-shortcut {
		background-image: url(../images/list48x48.png);
	}
	.usuarios-shortcut {
		background-image: url(../images/list48x48.png);
	}
	
/*SHORTCUT IE6*/
{foreach from=$tabelas item=field name=form}
	.x-ie6 .{$field}-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/list48x48.png', sizingMethod='scale');
	}	
{/foreach}
	.x-ie6 .perfil-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/list48x48.png', sizingMethod='scale');
	}
	.x-ie6 .usuarios-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/list48x48.png', sizingMethod='scale');
	}
	
/*ICON-GRID*/
{foreach from=$tabelas item=field name=form}
	.{$field} {
		background-image: url( ../images/list16x16.png ) !important;
	}
{/foreach}
	.perfil {
		background-image: url( ../images/list16x16.png ) !important;
	}
	.usuarios {
		background-image: url( ../images/list16x16.png ) !important;
	}
