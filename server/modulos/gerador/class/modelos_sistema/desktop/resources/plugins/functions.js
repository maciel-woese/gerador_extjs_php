function getParams(a){
	var b = document.getElementsByTagName("script");
	for (var i = 0; i < b.length; i++){
		if (b[i].src.indexOf("/" + a) > -1){
			var c = b[i].src.split("?").pop().split("&");
			var p = {};
			for (var j = 0; j < c.length; j++){
				var d = c[j].split("=");
				p[d[0]] = d[1]
			}
			return p
		}
	}
	return {}
	
}

function isEmail(email){
	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(!filter.test(email)){
		return false;
	}
	else return true;

}

/**
 * Modificações no Combo
 * */

Ext.override(Ext.form.field.ComboBox, {
	forceSelection: true,
	editable: true,
	displayField: 'descricao',
    queryMode: 'local',
    valueField: 'id',
    typeAhead: true,
    triggerAction: 'all',
    lazyRender: true,

    initComponent: function () {
        this.callParent();
    }
});

/**
 * Modificações no Window
 * */

Ext.override(Ext.window.Window, {
    modal: false,
	autoHeight: true,
    resizable: false,
    width: 260,
    stateful: false,
    isWindow: true,
    constrainHeader: true,
    border: false,

    initComponent: function () {
        this.callParent();
    }
});

/**
 * Modificações no FormPanel
 * */
Ext.override(Ext.form.Panel, {
    border: false,

    initComponent: function () {
        this.callParent();
    }
});

/**
 * Modificações no Store
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

Ext.override(Ext.form.RadioGroup, {
    labelAlign: 'top',
	columns: 2,
    labelStyle: 'font-weight: bold;font-size: 11px;',

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

/**
 * Modificações no Field
 * */

Ext.override(Ext.form.field.Text, {
    labelAlign: 'top',
	allowBlank: false,
    labelStyle: 'font-weight: bold;font-size: 11px;',

    initComponent: function () {
        this.callParent();
    }
});

Ext.override(Ext.form.Labelable, {
    labelAlign: 'top',
    labelStyle: 'font-weight: bold;font-size: 11px;',

    initComponent: function () {
        this.callParent();
    }
});

Ext.override(Ext.grid.Panel, {
	enableColumnHide: false,

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


/**
 * Modificações no MessageBox
 * */

Ext.override(Ext.MessageBox, {
	draggable: true,

    initComponent: function () {
        this.callParent();
    }
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
            	info('Erro!', response.responseText);
            }
            else if(dados.logout==true){
            	window.location = 'login.php';
            }
            else if(dados.msg){
            	info('Aviso!', dados.msg);
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

    maxHeight: 22,
    iconCls: 'bt_add',
    margins: '18 0 0 5',

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

    width: 520,

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
