/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.correios_enderecos.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.correios_enderecoslist',
    requires: [
    	'ShSolutions.store.StoreCorreios_Enderecos'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'correios_enderecos',

    id: 'List-Correios_Enderecos',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Correios_Enderecos',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridCorreios_Enderecos',
    		        store: 'StoreCorreios_Enderecos',
					viewConfig: {
						autoScroll: true,
						loadMask: false
					},
								
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
							dataIndex: 'uf_sigla',
							text: 'Uf Sigla',					
							width: 140
						},
						{
							xtype: 'numbercolumn',
							dataIndex: 'localidade_id',
							format: '0',
							text: 'Localidade Id',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'nome',
							text: 'Nome',					
							width: 140
						},
						{
							xtype: 'numbercolumn',
							dataIndex: 'bairro_id_inicial',
							format: '0',
							text: 'Bairro Id Inicial',					
							width: 140
						},
						{
							xtype: 'numbercolumn',
							dataIndex: 'bairro_id_final',
							format: '0',
							text: 'Bairro Id Final',					
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
							dataIndex: 'complemento',
							text: 'Complemento',					
							width: 140
						},
						{
							xtype: 'gridcolumn',
							dataIndex: 'tipo',
							text: 'Tipo',					
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
							store: 'StoreCorreios_Enderecos',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_correios_enderecos',
									iconCls: 'bt_add',									
									hidden: true,									
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_correios_enderecos',
									iconCls: 'bt_edit',									
									hidden: true,									
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_correios_enderecos',
									iconCls: 'bt_del',									
									hidden: true,									
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_filter_correios_enderecos',
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


