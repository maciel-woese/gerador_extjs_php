/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.cidades.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.cidadeslist',
    requires: [
    	'ShSolutions.store.StoreCidades'
    ],
	
	id: 'GridCidades',
    store: 'StoreCidades',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false
			},
			forceFit: true,			
			columns: [
				{
					xtype: 'numbercolumn',
					dataIndex: 'id',
					hidden: true,
					format: '0',
					text: 'Id',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'descricao',
					text: 'Estado',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'estado_id',
					hidden: true,
					format: '0',
					text: 'Estado',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'cidade',
					text: 'Cidade',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreCidades',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_cidades',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_cidades',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_cidades',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_cidades',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						}					
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
