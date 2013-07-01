/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('ShSolutions.view.generated.Chart', {
    extend: 'Ext.chart.Chart',
    alias: 'widget.generatedchart',
    requires: [
    	'ShSolutions.store.StoreGeneratedChart'
    ],
	
	id: 'GridGeneratedChart',
    store: 'StoreGeneratedChart',
	
	num_app_generated: 'Numeros de Apps Geradas',
	meses_atual: 'Meses do Ano (Atual)',
	
    initComponent: function() {
        var me = this;
		
        Ext.applyIf(me, {
			style: 'background:#fff',
            animate: true,
            shadow: true,
            axes: [
				{
					type: 'Numeric',
					position: 'left',
					fields: ['numero'],
					label: {
						renderer: Ext.util.Format.numberRenderer('0,0')
					},
					title: me.num_app_generated,
					grid: true,
					maximum: 100,
					minimum: 0
				}, 
				{
					type: 'Category',
					position: 'bottom',
					fields: ['mes'],
					title: me.meses_atual
				}
			],
            series: [{
                type: 'column',
                axis: 'left',
                highlight: true,
                tips: {
                  trackMouse: true,
                  width: 140,
                  height: 28,
                  renderer: function(storeItem, item) {
                    this.setTitle(storeItem.get('mes') + ': ' + storeItem.get('numero'));
                  }
                },
                label: {
                  display: 'insideEnd',
                  'text-anchor': 'middle',
                    field: 'numeri',
                    renderer: Ext.util.Format.numberRenderer('0'),
                    orientation: 'vertical',
                    color: '#333'
                },
                xField: 'mes',
                yField: 'numero'
            }]
        });

        me.callParent(arguments);
    }

});
