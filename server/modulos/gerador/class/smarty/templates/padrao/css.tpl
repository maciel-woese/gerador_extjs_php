{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}
/*SHORTCUT*/
{foreach from=$tabelas item=field name=form}
	.{$field}-shortcut {
		background-image: url(../images/{$field}48x48.png);
	}
{/foreach}

/*SHORTCUT IE6*/
{foreach from=$tabelas item=field name=form}
	.x-ie6 .{$field}-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/{$field}48x48.png', sizingMethod='scale');
	}	
{/foreach}

/*ICON-GRID*/
{foreach from=$tabelas item=field name=form}
	.{$field} {
		background-image: url( ../images/{$field}.png ) !important;
	}
{/foreach}
