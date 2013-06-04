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


function Mascara(tipo, campo, teclaPress) {
		if (window.event)
        {
                var tecla = teclaPress.keyCode;
        } else {
                tecla = teclaPress.which;
        }
		
        var s = new String(campo);
        // Remove todos os caracteres à seguir: ( ) / - . e espaço, para tratar a string denovo.
        s = s.replace(/(\.|\(|\)|\/|\-|\:| )+/g,'');

        tam = s.length + 1;

        if ( tecla != 9 && tecla != 8 ) {
                switch (tipo)
                {
                case 'cpf' :
                        if (tam > 3 && tam < 7)
                                campo = s.substr(0,3) + '.' + s.substr(3, tam);
                        if (tam >= 7 && tam < 10)
                                campo = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,tam-6);
                        if (tam >= 10 && tam < 12)
                                campo = s.substr(0,3) + '.' + s.substr(3,3) + '.' + s.substr(6,3) + '-' + s.substr(9,tam-9);
                        if (tam > 12)                           
                                campo = campo.substr(0,campo.length-1);                                                       
                break;
				
				case 'hora' :
						if (tam > 2 && tam < 4)
                                campo = s.substr(0,2) + ':' + s.substr(2, tam);
                        if (tam > 4 && tam < 9)
                                campo = s.substr(0,2) + ':' + s.substr(2,2) + ':' + s.substr(4,tam-4);
                        if (tam > 7)                            
                                campo = campo.substr(0,campo.length-1);                                                      
                break;

                case 'cnpj' :

                        if (tam > 2 && tam < 6)
                                campo = s.substr(0,2) + '.' + s.substr(2, tam);
                        if (tam >= 6 && tam < 9)
                                campo = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,tam-5);
                        if (tam >= 9 && tam < 13)
                                campo = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,tam-8);
                        if (tam >= 13 && tam < 15)
                                campo = s.substr(0,2) + '.' + s.substr(2,3) + '.' + s.substr(5,3) + '/' + s.substr(8,4)+ '-' + s.substr(12,tam-12);
                        if (tam > 15)                           
                                campo = campo.substr(0,campo.length-1);                       
                                
                break;

                case 'fone' :
                        if (tam > 2 && tam < 4)
                                campo = '(' + s.substr(0,2) + ') ' + s.substr(2,tam);
                        if (tam >= 7 && tam < 11)
                                campo = '(' + s.substr(0,2) + ') ' + s.substr(2,4) + '-' + s.substr(6,tam-6);
                        if (tam > 11)                           
                                campo = campo.substr(0,campo.length-1);                       
                break;

                case 'data' :
                        if (tam > 2 && tam < 4)
                                campo = s.substr(0,2) + '/' + s.substr(2, tam);
                        if (tam > 4 && tam < 11)
                                campo = s.substr(0,2) + '/' + s.substr(2,2) + '/' + s.substr(4,tam-4);
                        if (tam > 9)                            
                                campo = campo.substr(0,campo.length-1);                       
                                
                break;
                
                case 'cep' :
                        if (tam > 5 && tam < 7)
                                campo = s.substr(0,5) + '-' + s.substr(5, tam);
                        if (tam > 9)                            
                                campo = campo.substr(0,campo.length-1);                       
                                
                break;
                }
				return campo;
        }
}

function setMask(v, mask){
	if(mask=='fone'){
		var m = "(99) 9999-9999";
	}
	else if(mask=='cep'){
		var m = "99.999-999";
	}
	else if(mask=='cpf'){
		var m = "999.999.999-99";
	}
	else if(mask=='cnpj'){
		var m = "99.999.999/9999-99";
	}
	else if(mask=='money'){
		return setMaskMoney(v);
	}
	
	var retorno = '';
	var i = 0;
	m = m.split('');
	v = v.split('');
	
	for(var p in m){
		if(m[p]=='9'){
			if(v[i]){
				retorno += v[i];
				i++;
			}
			else{
				retorno += "_";
			}
		}
		else{
			retorno += m[p];
		}
	}
	
	return retorno;
}

function setMaskMoney(num){
	num = new Number(num);
    var p = num.toFixed(2).split(".");
    return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "." : "") + acc;
    }, "") + "," + p[1];
}

Ext.define('MyTextField', {
    extend: 'Ext.field.Text',
	alias: 'widget.maskfield',
	
    config: {
		tipo: 'cpf',
		change: true,
		
        listeners: {
			keyup: function(comp, event){
				if(comp.config.tipo!='money'){
					comp.setValue(Mascara(comp.config.tipo, comp.getValue(true), event.event));
				}	
				else{
					
				}
			}
		}
    },
	
	getValue: function(replace){
        var me = this;

        me._value = me.getComponent().getValue();
		if(!replace){
			if(me.config.tipo){
				if(me.config.tipo=='money'){
					
				}
				else{
					me._value = new String(me._value);
					me._value = me._value.replace(/(\.|\(|\)|\/|\-|\:| )+/g,'');
				}
			}
		}
        me.syncEmptyCls();
        return me._value;
    }

});

Ext.define('MySelectField', {
    extend: 'Ext.field.Select',
	alias: 'widget.selectfield',
	
    config: {
		displayField: 'descricao',
		valueField: 'id',
		usePicker: true,
		defaultPhonePickerConfig: {
			doneButton: 'Ok',
			cancelButton: 'Cancelar'
		},
		defaultTabletPickerConfig: {
			doneButton: 'Ok',
			cancelButton: 'Cancelar'
		}
    }

});

Ext.define('MyDatePicker', {
    extend: 'Ext.field.DatePicker',
	alias: 'widget.datepickerfield',
	
    config: {
		picker: {
			useTitles: true,
			dayText: 'Dia',
			monthText: 'M&ecirc;s',
			slotOrder: [
				'day',
				'month',
				'year'
			],
			yearText: 'Ano',
			doneButton: 'Ok',
			cancelButton: 'Cancelar'
		}
    }

});

