Ext.Loader.setConfig({
    enabled : true,
    paths   : {
    	ShSolutions : 'app'
    } 
});

Ext.application({
	controllers: [
	    'Principal',
	    'Gerador',
	    'ComboCompile',
	    'Grupo',
	    'Usuarios',
	    'Generated'
	 ],
    autoCreateViewport: true,
    name: 'ShSolutions',
    launch: function() {
    	Ext.get('loading').hide();
		Ext.get('loading-mask').setOpacity(0, true);
		
		setTimeout(function(){
			Ext.get('loading-mask').hide();
			window.tipo_usuario = getParams('app.js');
			if(window.tipo_usuario.exportar=='1'){
				Ext.getCmp('button_version').setVisible(false);
			}
			if(window.tipo_usuario.id_grupo!='1'){
				Ext.getCmp('button_config_admin').destroy();
			}
		},800);
		
		setInterval(function(){
			Ext.Ajax.request({
				url: 'server/modulos/login/list.php',
				params: {
					action: 'SET_TEMPO'
				},
				success: function(o){
					var o = Ext.decode(o.responseText);
					if(o.success==false){
						Ext.Msg.alert('Error!', o.msg, function(){
							if((o.logout) && (o.logout==true)){
								window.location = 'login.php';
							}
						});
					}
				}
			});
		},18000);
    }
});

