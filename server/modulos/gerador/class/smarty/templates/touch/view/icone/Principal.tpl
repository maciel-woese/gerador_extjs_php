
Ext.define('{$app|capitalize}.view.Principal', {
    extend: 'Ext.carousel.Carousel',
    alias: 'widget.containerprincipal',

    config: {
        id: 'Principal',
		styleHtmlContent: true,
		styleHtmlCls: 'principal',
		items: [
			{
				xtype : 'toolbar',
				docked: 'top',
				title: '{$titulo|capitalize}'
			}
		]
    }

});