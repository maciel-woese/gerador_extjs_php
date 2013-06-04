Ext.define('ShSolutions.model.ModelGerador', {
    extend: 'Ext.data.Model',
    alias: 'model.modelgerador',

    fields: [
        {
            name: 'tabela'
        },
        {
            name: 'coluna'
        },
        {
            name: 'nome_campo'
        },
        {
        	name: 'tipo'
        },
        {
            name: 'tipo_real'
        },
        {
            name: 'tipo_banco'
        },
        {
            name: 'status'
        },
        {
        	name: 'required',
        	type: 'boolean'
        },
        {
            name: 'primary_key',
            type: 'boolean'
        },
        {
            name: 'unique_key',
            type: 'boolean'
        },
        {
            name: 'foreign_key',
            type: 'boolean'
        },
        {
            name: 'tabela_ref'
        },
        {
            name: 'coluna_ref_value'
        },
        {
            name: 'coluna_ref_label'
        },
        {
            name: 'coluna_label_condicao'
        },
        {
            name: 'coluna_value_condicao'
        }
    ]
});