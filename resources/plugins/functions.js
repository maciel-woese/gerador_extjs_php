function getParams(a){var b=document.getElementsByTagName("script");for(var i=0;i<b.length;i++){if(b[i].src.indexOf("/"+a)>-1){var c=b[i].src.split("?").pop().split("&");var p={};for(var j=0;j<c.length;j++){var d=c[j].split("=");p[d[0]]=d[1]}return p}}return{}}

function setMenu(key){
	if(key=='administrador'){
		Ext.getCmp('bt_desenvolvedores').setVisible(false);
		Ext.getCmp('bt_projeto').setVisible(false);
		Ext.getCmp('bt_base_dados').setVisible(false);
		Ext.getCmp('bt_generated').setVisible(false);
		Ext.getCmp('bt_exported').setVisible(false);
		Ext.getCmp('button_gerador_manual').setVisible(true);
	}
	else if(key=='cliente'){
		Ext.getCmp('bt_clientes').setVisible(false);
		Ext.getCmp('bt_grupo').setVisible(false);
	}
	else if(key=='desenvolvedor'){
		Ext.getCmp('bt_clientes').setVisible(false);
		Ext.getCmp('bt_grupo').setVisible(false);
		Ext.getCmp('bt_base_dados').setVisible(false);
		Ext.getCmp('bt_generated').setVisible(false);
		Ext.getCmp('bt_exported').setVisible(false);
		Ext.getCmp('bt_desenvolvedores').setVisible(false);
	}
}

function isEmail(email){
	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(!filter.test(email)){
		return false;
	}
	else return true;

}

function IsMAC(strMAC) {
	var objER = /^([0-9A-F]{2}[:-]){5}[0-9A-F]{2}$/i;

	if(strMAC.length > 0) {
		if(objER.test(strMAC))
			return true;
		else
			return false;
	}
	else
		return false;
}

function validateIP(id) {
    var RegExPattern = /^((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.){3}(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])$/;

    if( (!(id.match(RegExPattern)) && (id!="")) || id=='0.0.0.0' || id=='255.255.255.255' ) {
       return false;
    }
    else{
    	return true;
    }
}

function IsUser(strUser) {
	var objER = /^[0-9a-z]{8,}$/;

	if(strUser.length > 0) {
		if(objER.test(strUser))
			return true;
		else
			return false;
	}
	else
		return false;
}

Ext.override(Ext.grid.feature.Summary, {
	refresh: function() {
		if(this.view.rendered) {
			var tpl = Ext.create(
						'Ext.XTemplate',
						'{[this.printSummaryRow()]}',
						this.getFragmentTpl()
					  );
			tpl.overwrite(this.getRowEl(), {});
		}
	},

	getRowEl: function() {
		return this.view.el.down('tr.x-grid-row-summary');
	}
});

Ext.override(Ext.Ajax, {
	timeout: 60000,

    initComponent: function () {
        this.callParent();
    }
});	

/**
 * ModificaÃ§Ãµes no Combo
 * */

Ext.override(Ext.form.field.ComboBox, {
	forceSelection: true,
	editable: true,
	typeAhead: true,
	allowBlank: false,
	queryMode: 'local',
	displayField: 'descricao',
	valueField: 'id',

    initComponent: function () {
        this.callParent();
    }
});

/**
 * ModificaÃ§Ãµes no Window
 * */

Ext.override(Ext.window.Window, {
    modal: true,
	autoHeight: true,
    width: 400,
	maxHeight: 400,

    initComponent: function () {
        this.callParent();
    }
});

/**
 * ModificaÃ§Ãµes no FormPanel
 * */
Ext.override(Ext.form.Panel, {
    border: false,

    initComponent: function () {
        this.callParent();
    }
});

/**
 * ModificaÃ§Ãµes no Store
 * */

Ext.override(Ext.data.Store, {
	listeners: {
		beforeload: function(store){
			store.clearFilter();
        } 
	},
	initComponent: function () {
		this.callParent();
        
    }
});


Ext.override(Ext.form.field.Number, {
    minValue: 1,
	allowBlank: false,
    decimalPrecision: 12,

    initComponent: function () {
        this.callParent();
    }
});

Ext.override(Ext.form.field.Date, {
	allowBlank: false,

    initComponent: function () {
        this.callParent();
    }
});

Ext.override(Ext.form.field.TextArea, {
	allowBlank: false,

    initComponent: function () {
        this.callParent();
    }
});

/**
 * ModificaÃ§Ãµes no Field
 * */

Ext.override(Ext.view.Table, {
	loadMask: false,

   initComponent: function () {
       this.callParent();
   }
});

Ext.override(Ext.grid.Panel, {
	enableColumnHide: false,
	loadMask: false,

   initComponent: function () {
       this.callParent();
   }
});

Ext.form.field.Base.override({
    setLabel: function (text) {
        if (this.rendered) {
            Ext.get(this.labelEl.id).update(text);
        }
        this.fieldLabel = text;
    }
});


Ext.override(Ext.form.field.Hidden, {
    fieldSubTpl: [ // note: {id} here is really {inputId}, but {cmpId} is available
        '<input id="{id}" type="{type}" {inputAttrTpl}',
        ' size="1"', // allows inputs to fully respect CSS widths across all browsers
        '<tpl if="name"> name="{name}"</tpl>',
        '<tpl if="value"> value="{[Ext.util.Format.htmlEncode(values.value)]}"</tpl>',
        '<tpl if="placeholder"> placeholder="{placeholder}"</tpl>',
        '<tpl if="readOnly"> readonly="readonly"</tpl>',
        '<tpl if="disabled"> disabled="disabled"</tpl>',
        '<tpl if="tabIdx"> tabIndex="{tabIdx}"</tpl>',
        '<tpl if="fieldStyle"> style="{fieldStyle}"</tpl>',
        ' class="{fieldCls} {typeCls} {editableCls}" autocomplete="off"/>',
        {
            disableFormats: true
        }
    ]
});

Ext.override(Ext.data.proxy.Proxy, {
	reader: {
    	type: 'json',
    	messageProperty: 'logout',
        root: 'dados'
    },
    writer: {
        type: 'json',
        messageProperty: 'message',
        writeAllFields: false
    },
    listeners: {
        exception: function(proxy, response, operation){
        	var dados = Ext.decode(response.responseText, true);
            if(dados==null){
            	//info('Erro!', response.responseText);
            }
            else if(dados.logout==true){
            	window.location = 'login.php';
            }
            else if(dados.msg){
            	info('Aviso!', dados.msg);
            	if(dados.tabela){
            		var tb = dados.tabela.toUpperCase();
            		if(Ext.getCmp('LISTAGEM_'+tb)){
            			Ext.getCmp('LISTAGEM_'+tb).close();
            		}
            	}
            	
            }
        }
    },

    initComponent: function () {
        this.callParent();
    }
});


/**
 * Modificações no Button - Referente a field labelAlign-Top
 * */

Ext.define('ShSolutions.view.ButtonAdd', {
    extend: 'Ext.button.Button',
    alias: 'widget.buttonadd',

    height: 22,
    iconCls: 'bt_add',
    margins: '0 0 0 5',

    initComponent: function() {
        var me = this;

        me.callParent(arguments);
    }

});

/**
 * Modificações no Window - Medium
 * */

Ext.define('ShSolutions.view.WindowMedium', {
    extend: 'Ext.window.Window',
    alias: 'widget.windowmedium',

    width: 550,

    initComponent: function() {
        var me = this;

        me.callParent(arguments);
    }

});


/**
 * Modificações no Window - Big
 * */

Ext.define('ShSolutions.view.WindowBig', {
    extend: 'Ext.window.Window',
    alias: 'widget.windowbig',

    width: 780,

    initComponent: function() {
        var me = this;

        me.callParent(arguments);
    }

});

Ext.define('ShSolutions.view.ContainerWin', {
    extend: 'Ext.window.Window',
    alias: 'widget.containerwin',

    height: 400,
    stateful: true,
	resizable: true,
    maximizable: true,
    width: 750,
    layout: {
        type: 'fit'
    },

    initComponent: function() {
        var me = this;

        me.callParent(arguments);
    }

});

