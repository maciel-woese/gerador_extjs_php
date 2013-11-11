/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.clientes.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.clienteslist',
    requires: [
    	'ShSolutions.store.StoreClientes'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'clientes',

    id: 'List-Clientes',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Clientes',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridClientes',
    		        store: 'StoreClientes',
					viewConfig: {
						autoScroll: true,
						loadMask: false
					},
								
					columns: [
						{
							xtype: 'numbercolumn',
							dataIndex: 'cod_cliente',
							hidden: true,
							format: '0',
							text: 'Cod Cliente',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'tipo_cliente',
							text: 'Tipo Cliente',							
							renderer: function(v){
								switch(v){
									case 'F':
									return 'Fisica';
									break;
									case 'J':
									return 'Juridica';
									break;
 					
								}
							},					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'nome_completo',
							text: 'Nome Completo',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'razao_social',
							text: 'Razão Social',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'nome_fantasia',
							text: 'Nome Fantasia',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'pessoa_contato',
							text: 'Pessoa Contato',					
							width: 140
						},
						{
							xtype: 'datecolumn',
							dataIndex: 'data_nascimento',
							format: 'd/m/Y',
							renderer : Ext.util.Format.dateRenderer('d/m/Y'),
							text: 'Data Nascimento',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'sexo',
							text: 'Sexo',							
							renderer: function(v){
								switch(v){
									case 'M':
									return 'Masculino';
									break;
									case 'F':
									return 'Feminino';
									break;
 					
								}
							},					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'cpf',
							renderer : Ext.util.Format.maskRenderer('999.999.999-99'),
							text: 'Cpf',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'cnpj',
							renderer : Ext.util.Format.maskRenderer('99.999.999/9999-99'),
							text: 'Cnpj',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'ie',
							text: 'Ie',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'im',
							text: 'Im',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'identidade',
							text: 'Identidade',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'profissao',
							text: 'Profissão',					
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
							dataIndex: 'cadastrado_por',
							text: 'Cadastrado Por',					
							width: 140
						},
						{
							xtype: 'datecolumn',
							dataIndex: 'data_alteracao',
							format: 'd/m/Y H:i:s',
							renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
							text: 'Data Alteração',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'situacao_cadastral',
							text: 'Situação Cadastral',					
							width: 140
						}
                
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StoreClientes',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_clientes',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_clientes',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_clientes',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_clientes',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filtrar'
								},
								{
									xtype: 'button',
									id: 'button_pdf_clientes',
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


