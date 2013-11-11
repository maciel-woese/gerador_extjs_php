/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/


Ext.define('ShSolutions.view.perfil.List', {
    extend: 'ShSolutions.view.WindowBig',
	alias: 'widget.perfillist',
    requires: [
    	'ShSolutions.store.StorePerfil'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'perfil',

    id: 'List-Perfil',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listagem de Perfil',

    initComponent: function() {
    	var me = this;
    	Ext.applyIf(me, {
    		items: [
    		    {
    		    	xtype: 'gridpanel',
    		    	id: 'GridPerfil',
    		        store: 'StorePerfil',
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
							dataIndex: 'perfil',
							text: 'Perfil',
							width: 140
						}
					],
    	            dockedItems: [
						{
							xtype: 'pagingtoolbar',
							displayInfo: true,
							store: 'StorePerfil',
							dock: 'bottom'
						},
						{
							xtype: 'toolbar',
							dock: 'top',
							items: [
								{
									xtype: 'button',
									id: 'button_add_perfil',
									iconCls: 'bt_add',
									action: 'adicionar',
									text: 'Adicionar'
								},
								{
									xtype: 'button',
									id: 'button_edit_perfil',
									iconCls: 'bt_edit',
									action: 'editar',
									text: 'Editar'
								},
								{
									xtype: 'button',
									id: 'button_del_perfil',
									iconCls: 'bt_del',
									action: 'deletar',
									text: 'Deletar'
								},
								{
									xtype: 'button',
									id: 'button_modulos_perfil',
									iconCls: 'modulo',
									action: 'modulos',
									text: 'Add/Rem. M&oacute;dulos'
								},
								{
									xtype: 'button',
									id: 'button_filter_perfil',
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


