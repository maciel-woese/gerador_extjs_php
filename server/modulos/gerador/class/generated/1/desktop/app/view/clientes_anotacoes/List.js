/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_anotacoes.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.clientes_anotacoeslist',
    requires: [
    	'ShSolutions.store.StoreClientes_Anotacoes'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'clientes_anotacoes',

    id: 'List-Clientes_Anotacoes',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Clientes_Anotacoes',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridClientes_Anotacoes',
    		        store: 'StoreClientes_Anotacoes',
					viewConfig: {
						autoScroll: true,
						loadMask: false
					},
					forceFit: true,			
					columns: [
						{
							xtype: 'numbercolumn',
							dataIndex: 'controle',
							hidden: true,
							format: '0',
							text: 'Controle',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'nome_completo',
							text: 'Cliente',					
							width: 140
						},
						{
							xtype: 'numbercolumn',
							dataIndex: 'cod_cliente',
							hidden: true,
							format: '0',
							text: 'Cliente',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'anotacao',
							text: 'Anotação',					
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
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'ativo',
							text: 'Ativo',					
							width: 140
						}
                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StoreClientes_Anotacoes',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_clientes_anotacoes',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_clientes_anotacoes',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_clientes_anotacoes',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_clientes_anotacoes',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
								},
								{
									xtype: 'button',
									id: 'button_pdf_clientes_anotacoes',
									iconCls: 'bt_pdf',
									action: 'gerar_pdf',
									text: 'Gerar PDF'
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


