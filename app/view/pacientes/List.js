/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.pacientes.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.pacienteslist',
    requires: [
    	'ShSolutions.store.StorePacientes'
    ],
	
	id: 'GridPacientes',
    store: 'StorePacientes',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false,
				getRowClass: function(record, rowIndex, rowParams, store){
					if(record.get('status')=='1'){
						return '';
					}
					else if(record.get('status')=='2'){
						return 'amarelo';
					}
				}
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
					xtype: 'datecolumn',
					dataIndex: 'data_cadastro',
					format: 'd/m/Y H:i:s',
					renderer : Ext.util.Format.dateRenderer('d/m/Y H:i:s'),
					text: 'Data Cadastro',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'paciente',
					text: 'Paciente',					
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
					dataIndex: 'tipo_sanguineo',
					text: 'Tipo Sanguineo',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'rg',
					text: 'Rg',					
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
					dataIndex: 'trabalho',
					text: 'Trabalho',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'telefone',
					renderer : Ext.util.Format.maskRenderer('(99) 9999-9999'),
					text: 'Telefone',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'pai',
					text: 'Pai',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'mae',
					text: 'Mae',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'obs',
					text: 'Obs',					
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'status',
					text: 'Status',					
					renderer: function(v){
						switch(v){
							case '1':
							return 'Ativo';
						  	break;
							case '2':
							return 'Desativado';
						  	break;
 					
						}
					},					
					width: 140
				}
                
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StorePacientes',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_pacientes',
							iconCls: 'bt_add',							
							hidden: true,							
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_pacientes',
							iconCls: 'bt_edit',
							hidden: true,							
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_pacientes',
							iconCls: 'bt_del',
							hidden: true,							
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_filter_pacientes',
							iconCls: 'bt_lupa',
							action: 'filtrar',
							text: 'Filtrar'
						},
						{
							xtype: 'button',
							id: 'button_pdf_pacientes',
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
