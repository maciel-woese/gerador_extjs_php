
Ext.define('{$app|capitalize}.view.Principal', {
    extend: 'Ext.dataview.List',
    alias: 'widget.containerprincipal',

    config: {
        id: 'GridPrincipal',
		store: 'StorePrincipal',
        onItemDisclosure: true,
        itemTpl: [
            '<div>{$descricao}</div>'
        ],
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: '{$titulo|capitalize}'
            }
        ]
    }

});