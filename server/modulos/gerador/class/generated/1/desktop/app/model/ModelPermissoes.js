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
            name: 'acao_id',
            type: 'int'
        },
        {
            name: 'acao'
        },
        {
        	name: 'is_perfil',
        	type: 'boolean'
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