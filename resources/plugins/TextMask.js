String.leftPad = function (d, b, c) {
	var a = String(d);
	if (!c) {
		c = " "
	}
	while (a.length < b) {
		a = c + a
	}
	return a
};
Ext.define('Ext.ux.TextMaskCore', {
	constructor : function (mask, money) {
		this.money = money === true;
		this.setMask(mask);
	},
	blankChar : '_',
	money : false,
	moneyZeros : 0,
	moneyPrecision : 0,
	version : '2.6',
	specialChars : {
		'L' : /^[A-Z]$/,
		'l' : /^[a-z]$/,
		'9' : /^[0-9]$/,
		'A' : /^[A-Za-z]$/,
		'_' : /^.$/
	},
	mask : function (v) {
		return this.money ? this.maskMoney(v) : this.maskNormal(v);
	},
	maskNormal : function (v) {
		v = this.unmask(v);
		v = v.split('');
		var m = '';
		var i = 0;
		Ext.each(this.maskList, function (item) {
			if (Ext.isString(item)) {
				m += item;
			} else {
				if (v[i] && item.test(v[i])) {
					m += v[i];
				} else {
					m += this.blankChar;
				};
				i++;
			}
		}, this);
		return m;
	},
	maskMoney : function (v) {
		v = String(this.unmask(v));
		var negativo = false;
		if (v.indexOf('-') >= 0) {
			negativo = true;
			v = v.replace(new RegExp('\[-\]', 'g'), '');
		};
		if (Math.round(v) !== v) {
			v = Math.round(Number(Ext.num(v, 0)) * Number('1' + String.leftPad('', this.moneyPrecision, '0')));
		};
		v = String.leftPad(Number(Ext.num(v, 0)), this.moneyZeros, '0');
		v = v.split('');
		var m = '';
		var i = v.length - 1;
		var mi = this.maskList.length - 1;
		while (i >= 0) {
			var item = this.maskList[mi];
			if (mi >= 0) {
				if (Ext.isString(item)) {
					m = item + m;
				} else {
					if (v[i] && item.test(v[i])) {
						m = v[i] + m;
					} else {
						m = '0' + m;
					};
					i--;
				};
				mi--;
			} else {
				if (this.specialChars['9'].test(v[i])) {
					m = v[i] + m;
				};
				i--;
			}
		};
		if (this.textMask.indexOf('#') >= 0) {
			m = this.textMask.slice(0, this.textMask.indexOf('#')) + (negativo ? '-' : '') + m;
		};
		return m;
	},
	unmask : function (v) {
		v = v === undefined ? '' : v;
		return this.money ? this.unmaskMoney(v) : this.unmaskNormal(v);
	},
	unmaskNormal : function (v) {
		v = String(v);
		var specialChars = '';
		Ext.iterate(this.specialChars, function (k) {
			specialChars += k;
		});
		var chars = this.textMask.replace(new RegExp('\[' + specialChars + '\]', 'g'), '');
		v = v.replace(new RegExp('\[' + chars + '\]', 'g'), '');
		v = v.split('');
		var m = '';
		var i = 0;
		Ext.each(this.maskList, function (item) {
			if (!Ext.isString(item)) {
				if (v[i] && item.test(v[i])) {
					m += v[i];
				};
				i++;
			}
		}, this);
		return m;
	},
	unmaskMoney : function (v) {
		v = String(v);
		if (v.indexOf('+') >= 0) {
			v = v.replace(new RegExp('\[-\]', 'g'), '');
		};
		var negativo = v.indexOf('-') >= 0;
		var precision = v.lastIndexOf('.');
		if (precision === -1) {
			precision = 0;
		} else {
			precision = v.length - precision - 1;
		};
		if (precision > this.moneyPrecision) {
			v = v.slice(0,  - (precision - this.moneyPrecision));
			precision = this.moneyPrecision;
		};
		var specialChars = '';
		Ext.iterate(this.specialChars, function (k) {
			specialChars += k;
		});
		var chars = this.textMask.replace(new RegExp('\[' + specialChars + '\]', 'g'), '');
		v = v.replace(new RegExp('\[' + chars + '\]', 'g'), '');
		v = v.split('');
		var m = '';
		var i = v.length - 1;
		var mi = this.maskList.length - 1;
		while (i >= 0) {
			if (mi >= 0) {
				var item = this.maskList[mi];
				if (!Ext.isString(item)) {
					if (v[i] && item.test(v[i])) {
						m = v[i] + m;
					};
					i--;
				};
				mi--;
			} else {
				if (v[i] && this.specialChars['9'].test(v[i])) {
					m = v[i] + m;
				};
				i--;
			}
		};
		m = this.parsePrecision(m, precision);
		if (negativo) {
			m = '-' + m;
		};
		return String(m);
	},
	parsePrecision : function (v, precision) {
		v = String(v);
		var sinal = v.indexOf('-') >= 0 ? '-' : '';
		v = v + String.leftPad('', this.moneyPrecision - precision, '0');
		if (this.moneyPrecision > 0) {
			v = String.leftPad(v, this.moneyPrecision + 1, '0');
			return sinal + String(Ext.num(v.slice(0, -this.moneyPrecision), 0)) + '.' + v.slice(-this.moneyPrecision);
		} else {
			return sinal + v;
		}
	},
	parseMask : function (mask) {
		var regList = [];
		if (this.money) {
			this.moneyZeros = 0;
			while (mask.indexOf('0') >= 0) {
				mask = mask.replace('0', '9');
				this.moneyZeros++;
			};
			this.moneyPrecision = Math.min(mask.length - Math.max(mask.lastIndexOf('.'), mask.lastIndexOf(',')) - 1, mask.length);
		};
		Ext.each(mask.match(/<![^<][^!]*!>/g), function (exp) {
			regList.push(new RegExp('^' + exp.replace(/(<!)|(!>)/g, '') + '$', ''));
		});
		mask = mask.replace(/<![^<][^!]*!>/g, '?');
		this.textMask = mask;
		if (this.money) {
			mask = mask.slice(mask.indexOf('#') + 1);
		};
		this.maskList = [];
		var regI = 0;
		var maskArr = mask.split('');
		for (var i = 0; i < maskArr.length; i++) {
			if (maskArr[i] === '?') {
				this.maskList.push(regList[regI]);
				regI++;
			} else {
				this.maskList.push(this.specialChars[maskArr[i]] || maskArr[i]);
			}
		};
		return this.maskList;
	},
	getLength : function (v) {
		v = this.mask(v);
		var i = v.indexOf(this.blankChar);
		if (i === -1) {
			i = v.length;
		};
		return i;
	},
	setMask : function (mask) {
		if (!Ext.isEmpty(mask) && mask !== this.oldMask) {
			this.oldMkask = mask;
			this.parseMask(mask);
		} else if (Ext.isEmpty(this.oldMask)) {
			this.parseMask('');
		};
		return this;
	}
});
Ext.util.Format.TextMask = new Ext.ux.TextMaskCore();
Ext.util.Format.MoneyMask = new Ext.ux.TextMaskCore('', true);
Ext.util.Format.maskRenderer = function (mask, money) {
	return function (v) {
		Ext.util.Format.TextMask.money = money;
		return Ext.util.Format.TextMask.setMask(mask).mask(v);
	}
};
Ext.require(['Ext.ux.TextMaskCore']);
Ext.define('Ext.ux.TextMaskPlugin', {
	extend : 'Ext.AbstractPlugin',
	alias : "plugin.textmask",
	useMask : true,
	date : false,
	maskRel : {
		m : '99',
		d : '99',
		n : '99',
		j : '99',
		Y : '9999'
	},
	init : function (cp) {
		this.cp = cp;
		if (this.cp.xtype === 'datefield') {
			this.date = true;
		}
		if (this.date) {
			this.cp.mask = '';
			Ext.each(this.cp.format.split(''), function (item) {
				this.cp.mask += this.maskRel[item] || item;
			}, this);
		}
		cp.textMask = new Ext.ux.TextMaskCore(cp.mask, cp.money);
		cp.emptyText = cp.textMask.mask('');
		cp.updateHidden = this.updateHidden;
		cp.getKeyCode = this.getKeyCode;
		cp.simpleUpdateHidden = this.simpleUpdateHidden;
		cp.getValue = this.getValue;
		cp.getRawValue = this.getRawValue;
		cp.getValueWithMask = this.getValueWithMask;
		cp.getValueWithoutMask = this.getValueWithoutMask;
		cp.setMask = this.setMask;
		if (this.date) {
			cp.setValue = this.setDateValue;
		} else {
			cp.setValue = this.setValue;
		}
		if (Ext.isEmpty(cp.useMask)) {
			cp.useMask = this.useMask;
		}
		cp.on('afterrender', this.afterRender, cp);
	},
	afterRender : function () {
		if (this.money) {
			this.inputEl.setStyle('text-align', 'right');
		}
		this.hiddenField = this.inputEl.insertSibling({
				tag : 'input',
				type : 'hidden',
				name : this.name,
				value : this.textMask.mask(this.value)
			}, 'after');
		this.hiddenName = this.name;
		this.inputEl.dom.removeAttribute('name');
		this.enableKeyEvents = true;
		this.inputEl.on({
			keypress : this.updateHidden,
			keydown : function (e) {
				if (this.readOnly) {
					return false;
				}
				if (e.getKey() === e.BACKSPACE) {
					if (this.money) {
						this.hiddenField.dom.value = this.hiddenField.dom.value.substr(0, this.hiddenField.dom.value.length - 1);
						this.hiddenField.dom.value = this.hiddenField.dom.value.replace(/[.]/g, '');
						this.hiddenField.dom.value = this.textMask.parsePrecision(this.hiddenField.dom.value, this.textMask.moneyPrecision);
						this.hiddenField.dom.value = this.textMask.unmask(this.hiddenField.dom.value);
					} else {
						this.hiddenField.dom.value = this.hiddenField.dom.value.substr(0, this.hiddenField.dom.value.length - 1);
					}
					this.updateHidden(e);
				}
				this.keyDownEventKey = e.getKey();
			},
			keyup : this.simpleUpdateHidden,
			scope : this
		});
		this.inputEl.dom.value = this.textMask.mask(this.hiddenField.dom.value);
		this.setValue(this.value);
	},
	getKeyCode : function (onKeyDownEvent, type) {
		if (this.readOnly) {
			return false;
		}
		var keycode = {};
		keycode.unicode = onKeyDownEvent.getKey();
		keycode.isShiftPressed = onKeyDownEvent.shiftKey;
		keycode.isDelete = ((onKeyDownEvent.getKey() === Ext.EventObject.DELETE && type === 'keydown') || (type === 'keypress' && onKeyDownEvent.charCode === 0 && onKeyDownEvent.keyCode === Ext.EventObject.DELETE)) ? true : false;
		keycode.isTab = (onKeyDownEvent.getKey() === Ext.EventObject.TAB) ? true : false;
		keycode.isBackspace = (onKeyDownEvent.getKey() === Ext.EventObject.BACKSPACE) ? true : false;
		keycode.isLeftOrRightArrow = (onKeyDownEvent.getKey() === Ext.EventObject.LEFT || onKeyDownEvent.getKey() === Ext.EventObject.RIGHT) ? true : false;
		keycode.pressedKey = String.fromCharCode(keycode.unicode);
		return (keycode);
	},
	updateHidden : function (e) {
		if (this.readOnly || !this.useMask) {
			return false;
		}
		var key = this.getKeyCode(e, 'keydown');
		var kk = this.keyDownEventKey || e.getKey();
		if (!(kk >= e.F1 && kk <= e.F12) && !e.isNavKeyPress()) {
			if (this.inputEl.dom.selectionStart === 0 && this.inputEl.dom.selectionEnd === this.inputEl.dom.value.length) {
				this.hiddenField.dom.value = this.money ? 0 : '';
			}
			if (!key.isBackspace) {
				if (this.money) {
					this.hiddenField.dom.value = String(this.hiddenField.dom.value) + String(key.pressedKey);
					this.hiddenField.dom.value = this.hiddenField.dom.value.replace(/[.]/g, '');
					this.hiddenField.dom.value = this.textMask.parsePrecision(this.hiddenField.dom.value, this.textMask.moneyPrecision);
					this.hiddenField.dom.value = this.textMask.unmask(this.hiddenField.dom.value);
				} else {
					this.hiddenField.dom.value = this.textMask.unmask(this.hiddenField.dom.value + key.pressedKey);
				}
			}
			this.inputEl.dom.value = this.textMask.mask(this.hiddenField.dom.value);
			this.inputEl.dom.selectionStart = this.textMask.getLength(this.hiddenField.dom.value);
			this.inputEl.dom.selectionEnd = this.inputEl.dom.selectionStart;
			e.preventDefault();
		}
	},
	simpleUpdateHidden : function (e) {
		if (this.readOnly || this.useMask) {
			return false;
		}
		this.hiddenField.dom.value = this.inputEl.dom.value;
	},
	getValue : function () {
		if (this.returnWithMask) {
			var valor = this.getValueWithMask();
			if (this.emptyText == this.getValueWithMask()) {
				return "";
			}
			return this.getValueWithMask();
		} else {
			return this.getValueWithoutMask();
		}
	},
	getValueWithMask : function () {
		if (this.hiddenField) {
			return this.inputEl.dom.value;
		} else {
			return '';
		}
	},
	getValueWithoutMask : function () {
		if (this.hiddenField) {
			var value = this.hiddenField.dom.value;
			if (value == '0.00') {
				value = '';
			}
			return value;
		} else {
			return '';
		}
	},
	getRawValue : function () {
		return this.getValue();
	},
	setValue : function (v) {
		if (this.useMask) {
			if (this.inputEl) {
				this.hiddenField.dom.value = this.textMask.unmask(v);
				this.inputEl.dom.value = this.textMask.mask(v);
			}
			this.value = this.textMask.unmask(v);
		} else {
			if (this.inputEl) {
				this.hiddenField.dom.value = v;
				this.inputEl.dom.value = v;
			}
			this.value = v;
		}
	},
	setDateValue : function (v) {
		if (v === 'now') {
			v = new Date();
		}
		if (this.inputEl) {
			v = this.formatDate(this.parseDate(v));
			this.hiddenField.dom.value = v;
			this.inputEl.dom.value = this.textMask.mask(v);
		}
		this.value = v;
	},
	setMask : function (mask) {
		this.textMask.setMask(mask);
		this.setValue(this.hiddenField.dom.value);
	}
});
