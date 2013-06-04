/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.medico.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.medicolist',
    requires: [
    	'ShSolutions.store.StoreMedico'
    ],
	
	id: 'GridMedico',
    store: 'StoreMedico',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
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
					dataIndex: 'medico',
					text: 'Medico',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'crm',
					text: 'Crm',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'especialidade',
					text: 'Especialidade',					
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'especialidade_id',
					hidden: true,
					format: '0',
					text: 'Especialidade',					
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
					dataIndex: 'uf_id',
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
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'cidade_id',
					hidden: true,
					format: '0',
					text: 'Cidade',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'bairro',
					text: 'Bairro',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'endereco',
					text: 'Endereco',					
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
					dataIndex: 'telefone',
					renderer : Ext.util.Format.maskRenderer('(99) 9999-9999'),
					text: 'Telefone',					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreMedico',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_medico',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_medico',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_medico',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_medico',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_medico',
							iconCls: 'bt_pdf',
							action: 'gerar_pdf',
							text: 'Gerar PDF'
						}
					
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
