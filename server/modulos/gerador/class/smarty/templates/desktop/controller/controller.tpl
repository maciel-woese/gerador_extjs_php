{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

Ext.define('{$app|capitalize}.controller.{$TABELA|capitalize}', {
    extend: 'Ext.app.Controller',
	mixins: {
        controls: '{$app|capitalize}.controller.Util'
    },

{if $modelCombo==true}
	storePai: true,
{/if}
	tabela: '{$TABELA|capitalize}',
	
	refs: [
        {
        	ref: 'list',
        	selector: '{$TABELA}list gridpanel'
        },
        {
        	ref: 'form',
        	selector: 'add{$TABELA}win form'
        },
        {
        	ref: 'filterBtn',
        	selector: '{$TABELA}list button[action=filtrar]'
        },
        {
        	ref: 'filterWin',
        	selector: 'filter{$TABELA}win'
        },
        {
        	ref: 'filterForm',
        	selector: 'filter{$TABELA}win form'
        },
        {
        	ref: 'addWin',
        	selector: 'add{$TABELA}win'
        }
    ],
	
    models: [
{if $models>0}
		'ModelComboLocal',
{else}{/if}{if $modelCombo==true}
		'ModelCombo',
{else}{/if}		'Model{$TABELA|capitalize}'
	],
	stores: [
{foreach from=$stores item=field name=form}
		'StoreCombo{$field.store|capitalize}',
{/foreach}
{if $modelCombo==true}
		'StoreCombo{$TABELA|capitalize}',
{else}{/if}		'Store{$TABELA|capitalize}'		
	],
	
    views: [
        '{$TABELA}.List',
        '{$TABELA}.Filtro',
        '{$TABELA}.Edit'
    ],

    init: function(application) {
    	this.control({
    		'{$TABELA}list gridpanel': { {if $permissoes == 'sim'}                
				afterrender: this.getPermissoes,
{/if}
                render: this.gridLoad
            },
            '{$TABELA}list button[action=filtrar]': {
            	click: this.btStoreLoadFielter
            },
            '{$TABELA}list button[action=adicionar]': {
                click: this.add
            },
            '{$TABELA}list button[action=editar]': {
                click: this.btedit
            },
            '{$TABELA}list button[action=deletar]': {
                click: this.btdel
            },{if $pdf==true}            
            '{$TABELA}list button[action=gerar_pdf]': {
                click: this.gerarPdf
            },
{/if}
            'add{$TABELA}win button[action=salvar]': {
                click: this.update
            },
            'add{$TABELA}win button[action=resetar]': {
                click: this.reset
            },
            'add{$TABELA}win form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'add{$TABELA}win form fieldcontainer button[action=reset_combo]': {
                click: this.resetCombo
            },
			'add{$TABELA}win form fieldcontainer button[action=add_win]': {
                click: this.getAddWindow
            },
            'filter{$TABELA}win form fieldcontainer combobox': {
                change: this.enableButton,
				render: this.comboLoad
            },
            'filter{$TABELA}win button[action=resetar_filtro]': {
                click: this.resetFielter
            },
            'filter{$TABELA}win button[action=filtrar_busca]': {
                click: this.setFielter
            },
            'filter{$TABELA}win': {
                show: this.filterSetFields
            }
        });
    },
{if $pdf==true}   
    gerarPdf: function(button){
		var me = this;
		window.open('server/modulos/{$TABELA}/pdf.php?'+
			Ext.Object.toQueryString(me.getList().store.proxy.extraParams)
		);
	},
{/if}
	
    edit: function(grid, record) {
    	var me = this;
		me.getDesktopWindow('Add{$TABELA|capitalize}Win', '{$TABELA|capitalize}', '{$TABELA}.Edit', function(){
    		me.getAddWin().setTitle('{$title_window_edit} {$TABELA|capitalize}');
	        me.getValuesForm(me.getForm(), me.getAddWin(), record.get('{$CHAVE}'), 'server/modulos/{$TABELA}/list.php');
	        Ext.getCmp('action_{$TABELA}').setValue('EDITAR');
    	});
    },

    del: function(grid, record, button) {
     	var me = this;
     	me.deleteAjax(grid, '{$TABELA}', {
			action: 'DELETAR',
			id: record.get('{$CHAVE}')
		}, button, false);

    },

    btedit: function(button) {
        if (this.getList().selModel.hasSelection()) {
			var record = this.getList().getSelectionModel().getLastSelected();
			this.edit(this.getList(), record);
		}
		else{
			info(this.titleErro, this.editErroGrid);
			return true;
		}
    },

    btdel: function(button) {
    	var me = this;
        if (me.getList().selModel.hasSelection()) {
			var record = me.getList().getSelectionModel().getLastSelected();

			Ext.Msg.confirm('{$confirm}', '{$delete_msg}: '+record.get('{$CHAVE}')+'?', function(btn){
				if(btn=='yes'){
					me.del(me.getList(), record, button);
				}
			});
		}
		else{
			info(this.titleErro, this.delErroGrid);
			return true;
		}
    },

    add: function(button) {
		var me = this;
        me.getDesktopWindow('{$TABELA|capitalize}', '{$TABELA|capitalize}', '{$TABELA}.Edit', false);
    },

    update: function(button) {
    	var me = this;
		me.saveForm(me.getList(), me.getForm(), me.getAddWin(), button, false, false);
    },

    btStoreLoadFielter: function(button){
		var win = this.getFilterWin();
    	if(!win) var win = Ext.create('{$app|capitalize}.view.{$TABELA}.Filtro', {
    		animateTarget: button.getEl()
    	});
    	win.show();
    }

});
