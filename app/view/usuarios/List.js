/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.usuarios.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuarioslist',
    requires: [
    	'ShSolutions.store.StoreUsuarios'
    ],
	
	id: 'GridUsuarios',
    store: 'StoreUsuarios',

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
			features: [
                {
                    ftype: 'grouping',
					disabled: responseUsuario.administrador == true ? false : true,
                    enableGroupingMenu: false,
                    groupHeaderTpl: 'Filial: {[values.rows[0].data.filial]}, ({rows.length} Usuario{[values.rows.length > 1 ? "s" : ""]})'
                }
            ],
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
					dataIndex: 'nome',
					text: 'Nome',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'perfil',
					text: 'Perfil',
					width: 140
				},
				{
					xtype: 'numbercolumn',
					dataIndex: 'perfil_id',
					hidden: true,
					format: '0',
					text: 'Perfil',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'email',
					text: 'Email',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'login',
					text: 'Login',
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
					store: 'StoreUsuarios',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_add_usuarios',
							iconCls: 'bt_add',
							hidden: true,
							action: 'adicionar',
							text: 'Adicionar'
						},
						{
							xtype: 'button',
							id: 'button_edit_usuarios',
							iconCls: 'bt_edit',
							hidden: true,
							action: 'editar',
							text: 'Editar'
						},
						{
							xtype: 'button',
							id: 'button_del_usuarios',
							iconCls: 'bt_del',
							hidden: true,
							action: 'deletar',
							text: 'Deletar'
						},
						{
							xtype: 'button',
							id: 'button_modulos_usuarios',
							iconCls: 'modulo',
							hidden: true,
							action: 'modulos',
							text: 'Add/Rem. M&oacute;dulos'
						},
						{
							xtype: 'button',
							id: 'button_filter_usuarios',
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
