/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/


Ext.define('{$app|capitalize}.view.perfil.List', {
    extend: '{$app|capitalize}.view.WindowBig',
	alias: 'widget.perfillist',
    requires: [
    	'{$app|capitalize}.store.StorePerfil'
    ],
	
    maximizable: true,
    minimizable: true,
    iconCls: 'perfil',

    id: 'List-Perfil',
    layout: {
        type: 'fit'
    },
    height: 350,
    title: 'Listing Profile',

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
							text: 'Profile',
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
									hidden: true,
									action: 'adicionar',
									text: 'Add'
								},
								{
									xtype: 'button',
									id: 'button_edit_perfil',
									iconCls: 'bt_edit',
									hidden: true,
									action: 'editar',
									text: 'Edit'
								},
								{
									xtype: 'button',
									id: 'button_del_perfil',
									iconCls: 'bt_del',
									hidden: true,
									action: 'deletar',
									text: 'Delete'
								},
								{
									xtype: 'button',
									id: 'button_modulos_perfil',
									iconCls: 'modulo',
									hidden: true,
									action: 'modulos',
									text: 'Add/Rem. Modules'
								},
								{
									xtype: 'button',
									id: 'button_filter_perfil',
									iconCls: 'bt_lupa',
									action: 'filtrar',
									text: 'Filter'
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


