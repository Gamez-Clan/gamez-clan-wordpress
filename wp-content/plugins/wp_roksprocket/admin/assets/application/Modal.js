/*!
 * @version   $Id: Modal.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){

	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Modal = new Class({

		Implements: [Options, Events],

		options: {
			/*
				onBeforeShow: function(){},
				onBeforeHide: function(){}
			*/
		},

		initialize: function(options){
			this.built = false;
			this.callback = {};
			this.build();
		},

		build: function(){
			if (this.built) return this.wrapper;

			if (document.getElement('.modal-wrapper')){
				['wrapper', 'outer', 'inner', 'container', 'header', 'body', 'statusbar', 'close', 'title'].each(function(type, i){
					this[type.camelCase()] = document.getElement('.modal-' + type) || document.getElement('h3');
				}, this);

				this.wrapper.addEvent('click:relay([data-dismiss])', this.hide.bind(this));

			} else {
				this.wrapper = new Element('div.modal-wrapper', {styles: {display: 'none'}}).inject(document.body);
				this.wrapper.addEvent('click:relay([data-dismiss])', this.hide.bind(this));

				['outer', 'inner', 'container',
				'header', 'body', 'statusbar'].each(function(type, i){
					var level = ' > div ',
						location = (!i) ? this.wrapper : this.wrapper.getElement(level.repeat(i));

					if (i > 2) location = this.container;

					this[type] = new Element('div.modal-' + type).inject(location);
				}, this);

				this.close = new Element('a.close[data-dismiss=true]', {html: '&times;'}).inject(this.header);
				this.title = new Element('h3').inject(this.header);

			}

			this.container.styles({top: -500, opacity: 0});

			this.built = true;
		},

		set: function(object){
			Object.each(object, function(args, action){
				var method = 'set' + action.capitalize();
				if (this[method]) this[method](args);
			}, this);

			return this;
		},

		setTitle: function(title){
			this.title.set('html', title);

			return this;
		},

		setBody: function(body){
			this.body.set('html', body);

			return this;
		},

		setKind: function(kind){
			this.kind = kind;
			this.wrapper.addClass(this.kind);

			return this;
		},

		setType: function(){
			var args = Array.from(arguments).flatten(),
				type = args[0] || 'close',
				options = args[1] || {labels: false},
				labels = {};

			type = type || 'close';

			switch(type){
				case 'yesno':
					labels = {no: (options.labels.no ? options.labels.no : 'No'), yes: (options.labels.yes ? options.labels.yes : 'Yes')};
					this.statusbar.empty().adopt(
						new Element('div.btn.no', {href: '#', text: labels.no, 'data-dismiss': 'true'}),
						new Element('div.btn.btn-primary.yes', {href: '#', text: labels.yes})
					);
					break;
				case 'close': default:
					labels = {close: (options.labels.close ? options.labels.close : 'Close')};
					this.statusbar.empty().adopt(
						new Element('div.btn.btn-primary.close', {href: '#', text: labels.close, 'data-dismiss': 'true'})
					);
			}
		},

		setBeforeShow: function(fn){
			this.callback.show = fn.bind(this);
			this.addEvent('beforeShow', this.callback.show);

			return this;
		},

		setBeforeHide: function(fn){
			this.callback.hide = fn.bind(this);
			this.addEvent('beforeHide', this.callback.hide);

			return this;
		},

		show: function(){
			if (this.isShown) return;

			this.fireEvent('beforeShow');
			this.removeEvents('beforeShow');
			document.body.addClass('modal-opened');
			document.getElement('body !> html').setStyle('overflow', 'hidden');
			this.wrapper.setStyles({'display': 'block', 'opacity': 1});
			this.container.fx({top: 0, opacity: 1}, {
				duration: '300ms',
				equation: 'ease-out',
				callback: function(){
					this.isShown = true;
				}.bind(this)
			});

			return this;
		},

		hide: function(){
			if (!this.isShown) return;

			this.fireEvent('beforeHide');
			this.removeEvents('beforeHide');
			var html = document.getElement('body.modal-opened !> html');
			document.body.removeClass('modal-opened');
			this.container.fx({top: -500, opacity: 0}, {
				duration: '300ms',
				equation: 'ease-out',
				callback: function(){
					html.setStyle('overflow', 'visible');
					this.wrapper.fx({'opacity': 0}, {
						callback: function(){
							if (this.kind) this.wrapper.removeClass(this.kind);
							this.setType('close');
							this.wrapper.setStyle('display', 'none');
							this.isShown = false;
						}.bind(this)
					});
				}.bind(this)
			});

			return this;
		},

		/*clearEvents: function(){
			this.removeEvents('beforeShow');
			this.removeEvents('beforeHide');
		},*/

		toElement: function(){
			return this.wrapper;
		}

	});

})());
