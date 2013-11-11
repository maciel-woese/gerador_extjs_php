/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes_endereco.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.clientes_enderecolist',
    requires: [
    	'ShSolutions.store.StoreClientes_Endereco'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'clientes_endereco',

    id: 'List-Clientes_Endereco',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Clientes_Endereco',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridClientes_Endereco',
    		        store: 'StoreClientes_Endereco',
					viewConfig: {
						autoScroll: true,
						loadMask: false
					},
								
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
							dataIndex: 'descricao',
							text: 'Estado',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'estado',
							hidden: true,
							text: 'Estado',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'loc_nome',
							text: 'Cidade',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'cidade',
							hidden: true,
							text: 'Cidade',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'bairro_nome',
							text: 'Bairro',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'bairro',
							hidden: true,
							text: 'Bairro',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'logradouro',
							text: 'Logradouro',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'num_end',
							text: 'Num End',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'complemento',
							text: 'Complemento',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'cep',
							renderer : Ext.util.Format.maskRenderer('99.999-999'),
							text: 'Cep',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'cx_postal',
							text: 'Cx Postal',					
							width: 140
						}
                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StoreClientes_Endereco',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_clientes_endereco',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_clientes_endereco',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_clientes_endereco',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_clientes_endereco',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
								},
								{
									xtype: 'button',
									id: 'button_pdf_clientes_endereco',
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


