/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.verification.List', {
    extend: 'Ext.dataview.List',
    alias: 'widget.verificationlist',

    config: {
        id: 'GridVerification',
		fullscreen: true,
		store: 'StoreVerification',
        onItemDisclosure: true,
        itemTpl:  new Ext.XTemplate(
						
			'<div class="gridlist"><b>User Id: </b> {user_id}</div>',			
			'<div class="gridlist"><b>Data Inicial: </b> {[this.setDate_Start(values.date_start)]}</div>',			
			'<div class="gridlist"><b>Date Final: </b> {[this.setDate_Finish(values.date_finish)]}</div>',			
			{
				
				setDate_Start: function(v){
					return Ext.util.Format.date(v, 'd/m/Y H:i:s');					
				},				
				setDate_Finish: function(v){
					return Ext.util.Format.date(v, 'd/m/Y H:i:s');					
				}
			}
        ),
        plugins: [
	        {
	            xclass: 'Ext.plugin.ListPaging',
				loadMoreText: 'Carregar mais...',
				noMoreRecordsText: 'N&atilde;o &agrave; mais registros',
	            autoPaging: true
	        }
	    ],
        items: [
            {
                xtype: 'toolbar',
                docked: 'top',
                title: 'Verification',
				items: [
                    {
                        xtype: 'button',
                        ui: 'back',
						text: 'Voltar',
						action: 'back_menu'
                    },
					{
						xtype: 'spacer'
					},
					{
                        xtype: 'button',
                        ui: 'confirm',
						iconMask: true,
						iconCls: 'refresh',
						action: 'refresh'
                    }
				]
            },
			{
				xtype: 'toolbar',
				docked: 'bottom',
				ui: 'light',
				layout: {
					align: 'center',
					pack: 'center',
					type: 'hbox'
				},
				items: [
					{
						xtype: 'button',
						iconCls: 'add',
						action: 'adicionar',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'editar',
						iconCls: 'compose',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'deletar',
						iconCls: 'delete',
						iconMask: true
					},
					{
						xtype: 'button',
						action: 'search',
						iconCls: 'search',
						iconMask: true
					}
				]
			}
               
        ]
    }

});

