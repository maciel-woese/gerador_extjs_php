/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_cidades.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.correios_cidadeslist',
    requires: [
    	'ShSolutions.store.StoreCorreios_Cidades'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'correios_cidades',

    id: 'List-Correios_Cidades',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Correios_Cidades',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridCorreios_Cidades',
    		        store: 'StoreCorreios_Cidades',
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
							dataIndex: 'loc_nome_abreviado',
							text: 'Loc Nome Abreviado',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'loc_nome',
							text: 'Loc Nome',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'cep',
							text: 'Cep',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'uf_sigla',
							text: 'Uf Sigla',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'loc_tipo',
							text: 'Loc Tipo',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'ativo',
							text: 'Ativo',					
							width: 140
						},
						{
							xtype: 'numbercolumn',
							dataIndex: 'cadastrado_por',
							format: '0',
							text: 'Cadastrado Por',					
							width: 140
						},
						{
							xtype: 'datecolumn',
							dataIndex: 'data_cadastro',
							format: 'd/m/Y H:i:s',
							renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
							text: 'Data Cadastro',					
							width: 140
						}
                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StoreCorreios_Cidades',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_correios_cidades',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_correios_cidades',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_correios_cidades',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_correios_cidades',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
								}								
							]
						}
					]
    		    }
    		]
    	});

    	me.callParent(arguments);
    }
});


