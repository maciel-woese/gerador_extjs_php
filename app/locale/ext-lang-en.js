Ext.onReady(function() {
	Ext.define("Ext.locale.en.gerador.List", {
        override: "ShSolutions.view.gerador.List",

		colColuna: 'Column',
		colTipo: 'Type',
		colRequired: 'Required',
		colNomeCampo: 'Name Field',
		
		colPrimaryKey: 'Primary Key',
		colUniqueKey: 'Unique Key',
		colForeignKey: 'Foreign Key',
		
		colTabRef: 'Table Ref.',
		colRefValue: 'Col. Ref. Value',
		colRefLabel: 'Col. Ref. Label',
		
		colTipoCondicao: 'Type Condition',
		colValorCondicao: 'Value Condition',
		
		editorTrue: 'True',
		editorFalse: 'False',
		editorCondicao: {
			combo: 'Combobox',
			mask: 'Mask',
			rel1n: 'Relationship 1:N',
			type: 'Type Field',
			validate: 'Validate Field',
			cep: 'CEP',
			cnpj: 'CNPJ',
			cpf: 'CPF',
			fone: 'Phone',
			money: 'Money',
			password: 'Field Password',
			email: 'Validate Email'
		},
		
		buttonLoginBanco: 'Login DataBase <b>Ctrl+L</b>',
		buttonSelectTab: 'Select Tables <b>Shift+T</b>',
		buttonPrepareCrud: 'Prepare for Generate <b>Shift+P</b>',
		buttonSync: 'Synchronize <b>Shift+S</b>',
		buttonToolSync: 'Config. Previous',
		buttonZip: 'Export <b>Shift+E</b>',
		buttonTestApp: 'Generated Test App <b>Shift+G</b>',
		
		group_tpl: 'Table: {name}, ({rows.length} Column{[values.rows.length > 1 ? "s" : ""]})'
    });
	
	Ext.define("Ext.locale.en.gerador.Login", {
        override: "ShSolutions.view.gerador.Login",
		
		title: 'Login DataBase',
	
		field_tipo_banco: 'Tipo de DataBase',
		field_radio_mysql: 'Mysql',
		field_radio_pgsql: 'PostgreSql',
		field_servidor: 'Server',
		field_usuario: 'User',
		field_senha: 'Password',
		field_banco: 'DataBase',
		field_schema: 'Schema',
		
		buttonLoginBanco: 'Log In <b>Alt+L</b>'
    });
	
	Ext.define("Ext.locale.en.gerador.Prepare", {
        override: "ShSolutions.view.gerador.Prepare",
		
		title: 'Generate Crud',
		
		field_radio_padrao: 'Standard',
		field_radio_desktop: 'Desktop',
		field_radio_touch: 'Touch',
		
		field_container_touch_layout: 'Main Screen',
		field_container_perm_users: 'Users Permissions',
		
		field_pdf: 'Generate PDF',
		field_titulo: 'Title System',
		field_version: 'Version System',
		
		boxLista: 'List',
		boxIcone: 'Icons',
		boxYes: 'Yes',
		boxNo: 'No',
		
		button_gerar_crud: 'Generate Crud'
		
    });
	
	Ext.define("Ext.locale.en.gerador.Select", {
        override: "ShSolutions.view.gerador.Select",
		
		title: 'Select Tables',
		fieldTabela: 'Tables',
		button_select: 'Select'
		
    });
	
	Ext.define("Ext.locale.en.container.Principal", {
        override: "ShSolutions.view.container.Principal",
		
		button_gerador: 'Generator <b>Ctrl+R</b>',
		button_config: 'Configurations <b>Shift+O</b>',
		button_info: 'Information <b>Shift+B</b>',
		button_version: 'Buy Major Version <b>Shift+V</b>',
		button_info_bugs: 'Notify Bugs <b>Ctrl+B</b>',
		button_api: 'Download API <b>Shift+L</b>',
		button_logout: 'Exit <b>F4</b>',
		
		item_init_app: 'Init App <b>Ctrl+I</b>',
		item_app_gerada: 'Apps Generateds <b>Ctrl+G</b>',
		item_usuarios: 'Users <b>Shift+U</b>',
		item_sobre: 'About <b>Shift+X</b>',
		
		infoAlert: {
			desenvolvido_por: 'Developed By: ',
			desenvolvedor: 'Developer: ',
			email: 'E-Mail',
			telefone: 'Phone'
		}
    });
	
	Ext.define("Ext.locale.en.email.Edit", {
        override: "ShSolutions.view.email.Edit",
		
		field_nome: 'Name',
		field_message: 'Message',
		invalid_email: 'E-mail Invalid...',
		
		button_reset: 'Reset',
		button_save: 'Save',
		
		loading: 'Wait...'
		
    });
	
	Ext.define("Ext.locale.en.generated.List", {
        override: "ShSolutions.view.generated.List",
		
		col_projeto: 'Project',
		col_data: 'Date',
		col_version: 'Version',
		col_ip: 'IP',
		col_server: 'Server',
		col_layout: {
			title: 'Layout',
			opts: {
				padrao: 'Standard',
				desktop: 'Desktop',
				touch: 'Touch'
			}	
		},
		
		button_zip: 'Export',
		button_deletar: 'Delete',
		button_chart: 'Chart',
		
		tpl_generated: 'Client: {[values.rows[0].data.usuario]} ({rows.length} App{[values.rows.length > 1 ? "s" : ""]})'
    });
	
	Ext.define("Ext.locale.en.generated.Chart", {
        override: "ShSolutions.view.generated.Chart",
		num_app_generated: 'Numbers Generated Apps',
		meses_atual: 'Months of the Year (Current)'
		
    });
	
	Ext.define("Ext.locale.en.controller.ComboCompile", {
        override: "ShSolutions.controller.ComboCompile",
		
		error: 'Error!',
		field_blank: 'There Fields Blank...',
		select_regDel: 'Select a regostry to Delete!',
		select_regEdit: 'Select a regostry to Edit!'
		
    });
	
	Ext.define("Ext.locale.en.controller.Principal", {
        override: "ShSolutions.controller.Principal",
		
		sair: 'Exit...',
		msg_sair: 'Exit?'
		
    });
	
	Ext.define("Ext.locale.en.controller.Util", {
        override: "ShSolutions.controller.Util",
		
		chartTitle: 'Number of Apps Generated',
		version_principal: 'Get the major version for Export! <br> Contact Us: macielcr7@gmail.com',
		
		information_ls: '1 <b>List:</b> Modules List in List format <b>(Standard)</b>.<br>'+
						'2 <b>Icon:</b> Modules List in Icons format <b>(Desktop)</b>.',
				
		information_pu: '<b>Yes</b> to Generate <br> 1 - Authentication of Users <br>2 - '+ 
						'Permissions Modules. <br><br> Some will need <b> Insert Tables in Base</b>,'+
						'<br> sql file that is in. the root system',
						
		load_prepare_app: 'Wait... Preparing Generated App...',
		require_modulos: 'Is necessary to add some modules in the Database!',
		error_no: "Unexpected Error!",
		
		generate_app: 'Generating App...',
		prepare_dados: "preparing Data...",
		error_tabela: 'Error in table',
		no_table_ref: ' Ref table is missing!',
		no_value_ref: ' Ref value is missing!',
		no_label_ref: ' Ref label is missing!',
		require_gerar_crud: 'You need to select the records to generate Crud!',
		no_sync: 'There file synchronization server!',
		
		titleErro: 'Error!',
		avisoText: 'Notice',
		falhaServer: 'Failure Server Error Code: ',
		exportarText: 'Select Export to a Record!',
		
		saveFormText: 'Wait...',
		delGridText: 'Deleting, Wait...',
		delErroGrid: 'Select a registry to Delete!',
		editErroGrid: 'Select a registry to Edit!',
		loadingGridText: 'Wait Loading Data...',
		filteredText: 'Filter <span class="buttonFilter">*</span>',
		filterText: 'Filter',
		connectFalhaText: 'Lost Communication Ajax',
		fieldsInvalidText: 'With Disabled Fields Values',
		requiredsFieldsText: 'There are fields in White...'
		
    });
	
	
});