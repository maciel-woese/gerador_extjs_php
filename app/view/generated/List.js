/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.generated.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.generatedlist',
    requires: [
    	'ShSolutions.store.StoreGenerated'
    ],
	
	id: 'GridGenerated',
    store: 'StoreGenerated',
	
	col_projeto: 'Projeto',
	col_data: 'Data',
	col_version: 'Vers&atilde;o',
	col_ip: 'IP',
	col_server: 'Servidor',
	col_layout: {
		title: 'Layout',
		opts: {
			padrao: 'Padr&atilde;o',
			desktop: 'Desktop',
			touch: 'Touch'
		}
	},
	
	button_zip: 'Exportar',
	button_deletar: 'Deletar',
	button_chart: 'Chart',
	
	tpl_generated: 'Cliente: {[values.rows[0].data.usuario]} ({rows.length} App{[values.rows.length > 1 ? "s" : ""]})',
	
    initComponent: function() {
        var me = this;
		
        Ext.applyIf(me, {
			viewConfig: {
				autoScroll: true,
				loadMask: false
			},
			features: [
				Ext.create('Ext.grid.feature.Grouping', {
					groupHeaderTpl: me.tpl_generated,
					hideGroupedHeader: true
				})
			],
			forceFit: true,
			columns: [
				{
					xtype: 'numbercolumn',
					dataIndex: 'id',
					hidden: true,
					format: '0',
					text: 'id',
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'project',
					text: me.col_projeto,
					width: 140
				},
				{
					xtype: 'datecolumn',
					dataIndex: 'data',
					format: 'd/m/Y',
					renderer : Ext.util.Format.dateRenderer('d/m/Y'),
					text: me.col_data,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'versao',
					text: me.col_version,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'ip',
					text: me.col_ip,
					width: 140
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'layout',
					text: me.col_layout.title,
					width: 140,
					renderer: function(v){
						if(v=='padrao'){
							return me.col_layout.opts.padrao;
						}
						else if(v=='desktop'){
							return me.col_layout.opts.desktop;
						}
						else if(v=='touch'){
							return me.col_layout.opts.touch;
						}
						else {
							return v;
						}	
					}
				},
				{
					xtype: 'gridcolumn',
					dataIndex: 'server',
					text: me.col_server,
					width: 140,
					renderer: function(v){
						if(v=='php'){
							return 'PHP';
						}
						else {
							return v;
						}	
					}
				}
			],
			dockedItems: [
				{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					store: 'StoreGenerated',
					dock: 'bottom'
				},
				{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						{
							xtype: 'button',
							id: 'button_export_generated',
							action: 'export',
                            iconCls: 'zip',
                            text: me.button_zip
						},
						{
							xtype: 'button',
							id: 'button_delete_generated',
							action: 'deletar',
                            iconCls: 'bt_del',
                            text: me.button_deletar
						},
						{
							xtype: 'button',
							action: 'chart',
                            iconCls: 'grid',
                            text: me.button_chart
						}
					]
				}
			]
        });

        me.callParent(arguments);
    }

});
