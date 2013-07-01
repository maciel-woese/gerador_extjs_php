/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('{$app|capitalize}.controller.Permissoes', {
    extend: 'Ext.app.Controller',
	
	mixins: {
		controls: '{$app|capitalize}.controller.Util'
    },
    
	storePai: true,
	tabela: 'Permissoes',
	
    config: {
		id: 'Permissoes',
		
		refs: {
			list: {
				selector: 'addpermissoeswin',
				xtype: 'addpermissoeswin',
				autoCreate: true
			}
		},
		
		models: [
			'ModelPermissoes'
		],
		stores: [
			'StorePermissoes'	
		],
        
        views: [
            'permissoes.Edit'
        ],
		
		control: {
        	'addpermissoeswin toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'addpermissoeswin toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'addpermissoeswin toolbar button[action=refresh]' : {
        		tap: 'loadList'
			}
        }
    },
	
	prepareJsonPerfil: function(){
    	var json = [];
    	var data = this.getList().getSelection();
		Ext.each(data, function(v){
       		json.push(Ext.encode(v.getData()));
    	});

    	return json;
    },
	
	in_selected: function(model){
		var m = Ext.getCmp('AddPermissoesWin').getSelection();
		var res = false;
		for(var i in m){
			if(m[i]==model){
				res = true;
			}
		}
		
		return res;
	},
	
    prepareJsonUsuario: function(){
    	var json = [];
		var me = this;
		var models = Ext.getCmp('AddPermissoesWin').getStore().getData().items;
		Ext.each(models, function(m){
       		var data = m.getData();
			var action = 0;
			if(data.is_perfil==true){
				if((data.init_checked==false) && (me.in_selected(m)==true)){
					action = 4; //remover Acesso N...
				}
				else if((data.init_checked==true)  && (me.in_selected(m)==false)){
					action = 3; //adicionar Acesso N...
				}
			}
			else{
				if((data.init_checked==false) && (me.in_selected(m)==true)){
					action = 1; //adicionar Acesso S...
				}
				else if((data.init_checked==true)  && (me.in_selected(m)==false)){
					action = 2; //remover Acesso S...
				}
			}
			
			if(action>0){
				data.action = action;
				json.push(Ext.encode(data));
			}
    	});
		
    	return json;
    },
	
	atualizar: function(button){
		var me = this;
		me.mask(me.saveFormText);
		
		var params = me.getList().getStore().getProxy().config.extraParams;
		var action = params.action;
		if(action=='USUARIO'){
    		var json = me.prepareJsonUsuario();
    	}
    	else if(action=='PERFIL'){
    		var json = me.prepareJsonPerfil();
    	}
		params.json = [json];
		
		Ext.Ajax.request({
			url: 'server/modulos/permissoes/save.php',
			params: params,
			success: function(o){
				var o = Ext.decode(o.responseText);
				me.mask(false);
				if(o.success==true){
					me.mask(false);
					Ext.Msg.alert('Aviso!', o.msg);
				}
				else{
					Ext.Msg.alert('Aviso!', o.msg);
				}
			},
			failure: function(o){
				me.mask(false);
				var o = Ext.decode(o.responseText);
				Ext.Msg.alert('Aviso!', o.msg);
			}
		});
	}
	
});