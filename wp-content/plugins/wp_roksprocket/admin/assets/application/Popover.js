/*!
 * @version   $Id: Popover.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){

	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Popover = new Class({

		Implements: [Options, Events],

		options: {
			/* */
		},

		initialize: function(options){
			this.built = false;
			this.build();
		},

		build: function(){
			if (this.built) return this.wrapper;

			if (document.getElement('.popover-wrapper')){
				['wrapper', 'arrow', 'inner', 'content'].each(function(type, i){
					this[type.camelCase()] = document.getElement('.popover-' + type);
				}, this);

			} else {
				this.wrapper = new Element('div.popover-wrapper', {styles: {display: 'none'}}).inject(document.body);
				this.wrapper.addEvent('click:relay([data-dismiss])', this.hide.bind(this));

				['arrow', 'inner', 'content'].each(function(type, i){
					this[type] = new Element('div.popover-' + type).inject(type == 'content' ? this.inner : this.wrapper);
				}, this);

				//this.close = new Element('a.close[data-dismiss=true]', {html: '&times;'}).inject(this.header);
				//this.title = new Element('h3').inject(this.header);
			}

			this.wrapper.styles({opacity: 0});

			this.built = true;
		},

		inject: function(element, where){
			this.wrapper.inject(element, where || 'inside');

			return this;
		},

		set: function(object){
			Object.each(object, function(args, action){
				var method = 'set' + action.capitalize();
				if (this[method]) this[method](args);
			}, this);

			return this;
		},

		setTitle: function(title){
			if (!this.title) this.title = new Element('h1.popover-title').inject(this.content, 'top');
			this.title.set('html', title);

			return this;
		},

		setBody: function(body){
			this.content.set('html', body);

			return this;
		},

		setKind: function(kind){
			this.kind = kind;
			this.wrapper.addClass(this.kind);

			return this;
		},

		show: function(){
			if (this.isShown) return;

			this.wrapper.setStyle('display', 'block');
			this.wrapper.fx({opacity: 1}, {
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

			this.wrapper.fx({opacity: 0}, {
				duration: '300ms',
				equation: 'ease-out',
				callback: function(){
					if (this.kind) this.wrapper.removeClass(this.kind);
					this.wrapper.setStyle('display', 'none');
					this.isShown = false;
				}.bind(this)
			});

			return this;
		},

		toElement: function(){
			return this.wrapper;
		}

	});

})());
