{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.{$TABELA|capitalize}', {
    extend: 'Ext.app.Controller',
    alias: 'controller.controller{$TABELA}',
	
	mixins: {
		controls: '{$app|capitalize}.controller.Util'
    },
    
{if $modelCombo==true}
	storePai: true,
{/if}
	tabela: '{$TABELA|capitalize}',
	
    config: {
		id: '{$TABELA|capitalize}',
		
		refs: {
			filter: {
				selector: '{$TABELA}filter',
				xtype: '{$TABELA}filter',
				autoCreate: true
			},
			form: {
				selector: '{$TABELA}form',
				xtype: '{$TABELA}form',
				autoCreate: true
			},
			list: {
				selector: '{$TABELA}list',
				xtype: '{$TABELA}list',
				autoCreate: true
			}
		},
		
		models: [
{if $models>0}
			'ModelComboLocal',
{else}{/if}{if $modelCombo==true}
			'ModelCombo',
{else}{/if}			'Model{$TABELA|capitalize}'
		],
		stores: [
{foreach from=$stores item=field name=form}
			'StoreCombo{$field.store|capitalize}',
{/foreach}
{if $modelCombo==true}
			'StoreCombo{$TABELA|capitalize}',
{else}{/if}			'Store{$TABELA|capitalize}'		
		],
        
        views: [
            '{$TABELA}.Edit',
            '{$TABELA}.Filtro',
            '{$TABELA}.List'
        ],
		
		control: {
        	'{$TABELA}form toolbar button[action=salvar]' : {
        		tap: 'atualizar'
			},
			'{$TABELA}form toolbar button[action=back]' : {
        		tap: 'showList'
			},
			'{$TABELA}form container button[action=add_win]' : {
        		tap: 'getWin'
			},
			'{$TABELA}list toolbar button[action=back_menu]' : {
        		tap: 'backMenu'
			},
			'{$TABELA}list toolbar button[action=refresh]' : {
        		tap: 'loadList'
			},
			'{$TABELA}list toolbar button[action=adicionar]' : {
        		tap: 'showEdit'
			},
			'{$TABELA}list toolbar button[action=editar]' : {
        		tap: 'showEdit'
			},
			'{$TABELA}list toolbar button[action=deletar]' : {
        		tap: 'deletar'
			},
			'{$TABELA}list toolbar button[action=search]' : {
        		tap: 'showFiltro'
			},
			'{$TABELA}filter toolbar button[action=reset]' : {
        		tap: 'resetFiltro'
			},
			'{$TABELA}filter toolbar button[action=filter]' : {
        		tap: 'setFiltro'
			},
			'{$TABELA}filter toolbar button[action=back]' : {
        		tap: 'showList'
			}
        }
    },
    
    getWin: function(button){
    	{$app|capitalize}.app.getController(button.config.modulo).showEdit(button, this.getForm());
    },
	
	deletar: function(button){
		var me = this;
		if(me.getList().getSelectionCount()>0){
			var record = me.getList().getSelection()[0];
			Ext.Msg.confirm('{$confirm}', '{$delete_msg}: '+record.get('{$CHAVE}')+'?', function(btn){
				if(btn=='yes'){
					me.deleteAjax(me.getList(), '{$TABELA}', {
						action: 'DELETE',
						id: record.get('{$CHAVE}')
					}, false);
				}
			});
		}
		else{
			Ext.Msg.alert(this.titleErro, this.delErroGrid);
		}
	},
{if $setmask|count > 0}	
	prepareValuesMask: function(data){
{foreach from=$setmask item=field name=setmask}		
		data.{$field.dataIndex} = setMask(data.{$field.dataIndex}, '{$field.mask}');{/foreach}
				
		return data;
	},
{/if}	
	atualizar: function(button){
		var usr = Ext.create('{$app|capitalize}.model.Model{$TABELA|capitalize}', this.getForm().getValues()),
		errs = usr.validate(),
		msg = '';
		if (!errs.isValid()){
			errs.each(function (err) {
				msg += err.getMessage() + '<br/>';
			});
			Ext.Msg.alert(this.titleErro, msg);
		} 
		else {
			this.save(this.getList(), this.getForm(), false);
		}
		usr.destroy();
	}
	
});