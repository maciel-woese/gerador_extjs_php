
function BooleanColor(val) {
    if (val==true) {
        return '<span style="color:blue;">' + val + '</span>';
    } else if (val==false) {
        return '<span style="color:red;">' + val + '</span>';
    }
    return val;
};

Ext.define('ShSolutions.view.gerador.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.geradorlist',

	id: 'GridGerador',
	
	colTabela: 'Tabela',
	colColuna: 'Coluna',
	colTipo: 'Tipo',
	colRequired: 'Obrigat&oacute;rio',
	colNomeCampo: 'Nome Campo',
	
	colPrimaryKey: 'Chave Prim&aacute;ria',
	colUniqueKey: 'Chave &Uacute;nica',
	colForeignKey: 'Relacionamento',
	
	colTabRef: 'Tabela de Ref.',
	colRefValue: 'Col. Ref. Value',
	colRefLabel: 'Col. Ref. Label',
	
	colTipoCondicao: 'Tipo Condi&ccedil;&atilde;o',
	colValorCondicao: 'Valor Condi&ccedil;&atilde;o',
	
	editorTrue: 'Verdadeiro',
	editorFalse: 'Falso',
	editorCondicao: {
		combo: 'Combobox',
		rel1n: 'Relacionamento 1:N',
		mask: 'Máscara',
		type: 'Tipo de Campo',
		validate: 'Validar Campo',
		cep: 'CEP',
		cnpj: 'CNPJ',
		cpf: 'CPF',
		fone: 'Telefone',
		money: 'Dinheiro',
		password: 'Campo Senha',
		email: 'Validar Email'
	},
	
	buttonLoginBanco: 'Login do Banco <b>Ctrl+L</b>',
	buttonSelectTab: 'Selecionar Tabelas <b>Shift+T</b>',
	buttonPrepareCrud: 'Preparar para Gerar <b>Shift+P</b>',
	buttonSync: 'Sincronizar <b>Shift+S</b>',
	buttonToolSync: 'Config. Anteriores',
	buttonZip: 'Exportar <b>Shift+E</b>',
	buttonTestApp: 'Testar App Gerada <b>Shift+G</b>',
	
	group_tpl: 'Tabela: {name}, ({rows.length} Coluna{[values.rows.length > 1 ? "s" : ""]})',
	
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
			store: 'StoreGerador',
			enableColumnHide: false,
		    columnLines: true,
		    selModel: Ext.create('Ext.selection.CheckboxModel'),
            features: [
                {
                    ftype: 'grouping',
                    enableGroupingMenu: false,
                    groupHeaderTpl: me.group_tpl,
                    hideGroupedHeader: true
                }
            ],
            plugins: [
                {
                	ptype: 'cellediting',
                	listeners: {
            	       beforeedit: {
            	           fn: function(e, o) {
            	        		if(o.record.data.foreign_key==false){
            	        			if(o.field=='coluna_ref_label'){
            	        				return false;
            	        			}
            	        			else if(o.field=='coluna_value_condicao'){
            	        				if(o.record.data.coluna_label_condicao=='combo'){
            	        					var win = Ext.getCmp('AddComboWin');
                    	        			if(!win) win = Ext.widget('addcombowin');
                    	        			win.show();
                    	        			Ext.getCmp('ColIndex').setValue(o.rowIdx);
                    	        			var d = Ext.decode(o.value);
                    	        			var rows = [];
                    	        			for(var i in d){
                    	        				Ext.getCmp('GridCombo').store.add({
                    	        					'label': d[i]['descricao'],
                    	        					'value': d[i]['id']
                    	        				});
                    	        			}
                    	        			
                    	        			return false;
            	        				}
            	        			}
            	        		}
            	        		else{
            	        			if(o.field=='coluna_value_condicao' || o.field=='coluna_label_condicao'){
            	        				//Add unique option rel 1:n
										//return false;
            	        			}
            	        		}
            	        	}
            	       },
            	       edit: {
            	           fn: function(e, o){
            	        		if(o.value=='combo'){
            	        			var win = Ext.getCmp('AddComboWin');
            	        			if(!win) win = Ext.widget('addcombowin');
            	        			win.show();
            	        			Ext.getCmp('ColIndex').setValue(o.rowIdx);
            	        		}
            	        	}
            	       }
            	   }
                }
            ],
            columns: [
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'tabela',
                    text: me.colTabela
                },
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'coluna',
                    text: me.colColuna
                },
                {
                    xtype: 'gridcolumn',
                    width: 50,
                    dataIndex: 'tipo',
                    text: me.colTipo
                },
                {
                    xtype: 'booleancolumn',
                    width: 70,
                    dataIndex: 'required',
                    text: me.colRequired,
                    renderer: BooleanColor,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'required',
                        triggerAction: 'all',
                        store: [
                           [true, me.editorTrue],
                           [false, me.editorFalse]
                        ],
                        lazyRender: true,
                        listClass: 'x-combo-list-small'
                    })
                },
                {
                    xtype: 'booleancolumn',
                    width: 100,
                    dataIndex: 'primary_key',
                    text: me.colPrimaryKey,
                    renderer: BooleanColor
                },
                {
                    xtype: 'booleancolumn',
                    width: 100,
                    dataIndex: 'unique_key',
                    text: me.colUniqueKey,
                    renderer: BooleanColor
                },
                {
                    xtype: 'booleancolumn',
                    width: 100,
                    dataIndex: 'foreign_key',
                    text: me.colForeignKey,
                    renderer: BooleanColor,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'relacionamento',
                        triggerAction: 'all',
                        store: [
                           [true, me.editorTrue],
                           [false, me.editorFalse]
                        ],
                        lazyRender: true,
                        listClass: 'x-combo-list-small'
                    })
                },
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'tabela_ref',
                    text: me.colTabRef,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'coluna_ref_label',
                        triggerAction: 'all',
                        store: ['NONE', ''],
                        lazyRender: true,
                        listClass: 'x-combo-list-small',
                        listeners: {
                        	focus: function(combo, opts){
                        		var rec = combo.up('grid').getSelectionModel().getLastSelected();
                        		var stors = [];
								var t = "";
								Ext.each(Ext.getCmp('GridGerador').store.data.items, function(recs){
									if(rec.get('tabela')!=t){
										if(recs.get('tabela')!=rec.get('tabela')){
											var p=0;
											for(var i in stors){
												if(stors[i][0]==recs.get('tabela')){
													p = 1;
												}
											}
											if(p==0){
												stors.push([recs.get('tabela'), recs.get('tabela')]);
												t = recs.get('tabela');
											}
										}
									}
								});
                        		
                        		combo.store.loadData(stors);
                        	}
                        }
                    })
                },
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'coluna_ref_value',
                    text: me.colRefValue,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'coluna_ref_label',
                        triggerAction: 'all',
                        store: ['NONE', ''],
                        lazyRender: true,
                        listClass: 'x-combo-list-small',
                        listeners: {
                        	focus: function(combo, opts){
								var rec = combo.up('grid').getSelectionModel().getLastSelected();
                        		var stors = [];
                        		combo.up('grid').store.each(function(recs){
                        			if(recs.get('tabela')==rec.get('tabela_ref')){

                        				if(recs.get('primary_key')==true)
                        					stors.push([recs.get('coluna'), recs.get('coluna')]);
                        			}
                        		});
                        		combo.store.loadData(stors);
                        	}
                        }
                    })
                },
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'coluna_ref_label',
                    text: me.colRefLabel,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'coluna_ref_label',
                        triggerAction: 'all',
                        store: ['NONE', ''],
                        lazyRender: true,
                        listClass: 'x-combo-list-small',
                        listeners: {
                        	focus: function(combo, opts){
                        		var rec = combo.up('grid').getSelectionModel().getLastSelected();
                        		var stors = [];
                        		combo.up('grid').store.each(function(recs){
                        			if(recs.get('tabela')==rec.get('tabela_ref')){

                        				if(recs.get('primary_key')!=true)
                        					stors.push([recs.get('coluna'), recs.get('coluna')]);
                        			}
                        		});

                        		combo.store.loadData(stors);
                        	}
                        }
                    })
                },
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'coluna_label_condicao',
                    text: me.colTipoCondicao,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'coluna_label_condicao',
                        triggerAction: 'all',
                        store: [
                           ['combo', me.editorCondicao.combo],
                           ['mask', me.editorCondicao.mask],
                           ['type', me.editorCondicao.type],
                           ['validate', me.editorCondicao.validate]
                        ],
                        lazyRender: true,
                        listClass: 'x-combo-list-small',
                        listeners: {
                        	focus: function(combo, opts){
								var rec = combo.up('grid').getSelectionModel().getLastSelected();
								var opts = [
								   ['combo', me.editorCondicao.combo],
								   ['mask', me.editorCondicao.mask],
								   ['type', me.editorCondicao.type],
								   ['validate', me.editorCondicao.validate]
								];
								if(rec.get('foreign_key')==true){
									var opts = [
									   ['relationship_1n', me.editorCondicao.rel1n]
									];
								}
                        		combo.store.loadData(opts);
                        	}
                        }
                    })
                },
                {
                    xtype: 'gridcolumn',
                    width: 120,
                    dataIndex: 'coluna_value_condicao',
                    text: me.colValorCondicao,
                    editor: new Ext.form.field.ComboBox({
                        typeAhead: true,
                        name: 'coluna_value_condicao',
                        triggerAction: 'all',
                        store: [
                           ['', ' ']
                        ],
                        lazyRender: true,
                        listClass: 'x-combo-list-small',
                        listeners: {
                        	focus: function(combo, opts){
                        		var rec = combo.up('grid').getSelectionModel().getLastSelected();
                        		var stors = [];
                        		if(rec.get('coluna_label_condicao')=='mask'){
                        			stors = [
                        			    ['cep', me.editorCondicao.cep],
                        			    ['cnpj', me.editorCondicao.cnpj],
                        			    ['cpf', me.editorCondicao.cpf],
                        			    ['fone', me.editorCondicao.fone],
                        			    ['money', me.editorCondicao.money]
                        			];
                        			combo.store.loadData(stors);
                        		}
                        		else if(rec.get('coluna_label_condicao')=='type'){
                        			stors = [
                        			    ['password', me.editorCondicao.password]
                        			];
                        			combo.store.loadData(stors);
                        		}
                        		else if(rec.get('coluna_label_condicao')=='validate'){
                        			stors = [
                        			    ['email', me.editorCondicao.email]
                        			];
                        			combo.store.loadData(stors);
                        		}
                        		else{
                        			combo.store.removeAll();
                        		}
                        	}
                        }
                    })
                },
                {
                    xtype: 'gridcolumn',
                    width: 130,
                    dataIndex: 'nome_campo',
                    text: me.colNomeCampo,
                    editor: new Ext.form.field.Text({
                    	name: 'nome_campo'
                    })
                }
            ],
            viewConfig: {

            },
            dockedItems: [
				{
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            action: 'login',
                            id: 'button_login_banco',
                            iconCls: 'bt_login',
                            text: me.buttonLoginBanco
                        },
                        {
                            xtype: 'button',
                            id: 'button_select_tabelas',
							action: 'select_tabelas',
                            iconCls: 'bt_edit',
                            disabled: true,
							text: me.buttonSelectTab
                        },
						{
                            xtype: 'button',
                            id: 'button_prepare_crud',
                            action: 'prepare_crud',
                            iconCls: 'bt_gerar',
                            disabled: true,
                            text: me.buttonPrepareCrud
                        },
                        {
                            xtype: 'button',
                            action: 'sync',
                            id: 'button_sync_crud',
                            disabled: true,
                            tooltip: me.buttonToolSync,
                            iconCls: 'refresh',
                            text: me.buttonSync
                        },
                        {
                            xtype: 'button',
                            id: 'button_export_crud',
                            disabled: true,
                            action: 'export',
                            iconCls: 'zip',
                            text: me.buttonZip
                        },
                        {
                            xtype: 'button',
                            id: 'button_test_crud',
                            disabled: true,
                            action: 'testar',
                            iconCls: 'acao',
                            text: me.buttonTestApp
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});