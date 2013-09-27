/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_contato.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.clientes_contatolist',
    requires: [
    	'ShSolutions.store.StoreClientes_Contato'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'clientes_contato',

    id: 'List-Clientes_Contato',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Clientes_Contato',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridClientes_Contato',
    		        store: 'StoreClientes_Contato',
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
							dataIndex: 'tipo_contato',
							text: 'Tipo Contato',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'descricao',
							text: 'Descrição',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'observacao',
							text: 'Observação',					
							width: 140
						}
                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StoreClientes_Contato',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_clientes_contato',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_clientes_contato',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_clientes_contato',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_clientes_contato',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
								},
								{
									xtype: 'button',
									id: 'button_pdf_clientes_contato',
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


