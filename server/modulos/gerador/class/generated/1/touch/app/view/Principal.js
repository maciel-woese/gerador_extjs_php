Ext.define('ShSolutions.view.Principal', {
    extend: 'Ext.dataview.List',
    alias: 'widget.containerprincipal',

    config: {
        id: 'GridPrincipal',
		store: 'StorePrincipal',
        onItemDisclosure: true,
        itemTpl: [
            '<div>{descricao}</div>'
        ],
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Sh Solutions'
            }
        ]
    }

});