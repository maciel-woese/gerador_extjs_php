Ext.define('ShSolutions.model.ModelPermissoes', {
    extend: 'Ext.data.Model',
    alias: 'model.permissoes',

    fields: [
        {
            name: 'modulo'
        },
        {
            name: 'leaf',
            type: 'boolean'
        },
        {
            name: 'text'
        },
        {
            name: 'acao'
        },
        {
            name: 'checked',
            type: 'boolean'
        },
        {
            name: 'init_checked',
            type: 'boolean'
        }
    ]
});