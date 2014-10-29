/*!
 * @version   $Id: Dropdowns.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){

	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Dropdowns = new Class({

		Implements: [Options, Events],

		options: {
			/*
				onBeforeAttach: function(selects){},
				onAfterAttach: function(selects){},
				onBeforeDetach: function(selects){},
				onAfterDetach: function(selects){},
				onBeforeChange: function(select, value, dropdown){},
				onAfterChange: function(select, value, dropdown){},
				onSelection: function(select, value, dropdown){},
				onBeforeShow: function(select, dropdown){},
				onAfterShow: function(select, dropdown){},
				onBeforeHide: function(select, dropdown){},
				onAfterHide: function(select, dropdown){},
				onBeforeHideAll: function(selects, dropdowns){},
				onAfterHideAll: function(selects, dropdowns){},
			*/
		},

		initialize: function(options){
			this.selects = document.getElements('.dropdown-original select');

			this.setOptions(options);

			this.bounds = {
				document: this.hideAll.bind(this)
			};

			this.attach();
		},

		attach: function(select){
			var selects = (select ? new Elements([select]).flatten() : this.selects);

			this.fireEvent('beforeAttach', selects);

			selects.each(function(select){
				var click = select.retrieve('roksprocket:selects:click', function(event){
						this.click.call(this, event, select);
					}.bind(this)),

					selection = select.retrieve('roksprocket:selects:selection', function(event){
						this.selection.call(this, event, select);
					}.bind(this)),

					parent = select.getParent('.sprocket-dropdown');

				if (parent){
					// We now rely on the bootstrap ones for the open/close, if available
					if (typeof jQuery == 'undefined' || !jQuery.fn.dropdown) parent.addEvent('click', click);
					parent.getElements('.dropdown-menu > :not([data-divider])').addEvent('click', selection);

					if (!select.getElement('option[selected]') && !parent.getElement('.dropdown-original select option[selected]')){
						this.selection({target: parent.getElement('[data-value]')}, select);
					}
				}
			}, this);

			if (!document.retrieve('roksprocket:selects:document', false)){
				document.addEvent('click', this.bounds.document);
				document.store('roksprocket:selects:document', true);
			}

			this.fireEvent('afterAttach', selects);

			return this;
		},

		detach: function(select){
			var selects = (select ? new Elements([select]).flatten() : this.selects);

			this.fireEvent('beforeDetach', selects);

			selects.each(function(select){
				var click = select.retrieve('roksprocket:selects:click'),
					selection = select.retrieve('roksprocket:selects:selection'),
					parent = select.getParent('.sprocket-dropdown');

				if (parent){
					parent.removeEvent('click', click);
					parent.getElements('.dropdown-menu >').removeEvent('click', selection);
				}

			}, this);

			if (!select) document.store('roksprocket:selects:document', false).removeEvent('click', this.bounds.document);

			this.fireEvent('afterDetach', selects);

			return this;
		},

		reload: function(){
			this.selects = document.getElements('.dropdown-original select');
		},

		click: function(event, select){
			event.preventDefault();

			if (select.retrieve('roksprocket:selects:open', false)) this.hide(select);
			else this.show(select);
		},

		selection: function(event, select){
			if (event && event.preventDefault) event.preventDefault();

			if (!event || !event.target) return;

			var item = (event.target.get('tag') == 'li') ? event.target : event.target.getParent('li'),
				selected = item.getParent('.sprocket-dropdown').getElement('[data-toggle=dropdown]'),
				text = item.get('data-text'),
				icon = item.get('data-icon'),
				value = item.get('data-value');

			select.fireEvent('beforeChange', [event, select, value, selected]);

			selected.getElement('span').set('text', text);
			if (icon && icon.length) selected.getElement('i').set('class', 'icon ' + icon);

			select.set('value', value).fireEvent('change');
			select.fireEvent('click');

			select.fireEvent('afterChange', [event, select, value, selected]);
			this.fireEvent('selection', [event, select, value, selected]);

			return this;
		},

		show: function(select){
			this.hideAll();

			var dropdown = select.getParent('.sprocket-dropdown:not(.open)');
			select.store('roksprocket:selects:open', true);

			this.fireEvent('beforeShow', [select, dropdown]);

			if (dropdown) dropdown.addClass('open');

			this.fireEvent('afterShow', [select, dropdown]);
		},

		hide: function(select){
			var dropdown = select.getParent('.sprocket-dropdown.open');
			select.store('roksprocket:selects:open', false);

			this.fireEvent('beforeHide', [select, dropdown]);

			if (dropdown) dropdown.removeClass('open');

			this.fireEvent('afterHide', [select, dropdown]);
		},

		hideAll: function(event){
			if (event){
				var parents = this.selects.getParent('.sprocket-dropdown');

				if (RokSprocket.modal.isShown) return true;
				if (parents.contains(event.target) || parents.getElement(event.target).clean().length) return true;
			}

			var dropdowns = this.selects.getParent('.sprocket-dropdown.open').clean();
			this.selects.store('roksprocket:selects:open', false);

			this.fireEvent('beforeHideAll', [this.selects, dropdowns]);
			if (dropdowns.length) $$(dropdowns).removeClass('open');

			this.fireEvent('afterHideAll', [this.selects, dropdowns]);
		},

		redraw: function(select){
			var options = select.getChildren(),
				parent = select.getParent('.sprocket-dropdown'),
				list = parent.getElement('.dropdown-menu'),
				active = parent.getElement('[data-toggle]').getFirst('span');

			list.empty();
			options.each(function(option){
				var text = option.get('text'),
					value = option.get('value'),
					item;

				item = new Element('li[data-dynamic=false][data-text='+text+'][data-value='+value+']').adopt(
					new Element('a', {href: '#'}).adopt(new Element('span', {text: text}))
				);

				list.adopt(item);
			}, this);

			if (!select.getElement('option[selected]')){
				if (select.getElements('option').length)
					select.set('value', select.getFirst().get('value'));
			}

			this.attach(select);

			var item = list.getElement('[data-value='+select.get('value')+']');
			this.selection({target: item}, select);
		}

	});

})());
