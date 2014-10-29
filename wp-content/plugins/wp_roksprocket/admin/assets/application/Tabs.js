/*!
 * @version   $Id: Tabs.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){
	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Tabs = new Class({

		Implements: [Options, Events],

		options: {
			/*
				onBeforeAttach: function(tab){},
				onAfterAttach: function(tab){},
				onBeforeDetach: function(tab){},
				onAfterDetach: function(tab){},
				onBeforeChange: function(tab, panel, {current_tab, current_panel}){},
				onAfterChange: function(tab, panel){}
			*/
		},

		initialize: function(options){
			this.tabs = document.getElements('.tab[data-tab]');
			this.panels = document.getElements('[data-panel=' + this.tabs.get('data-tab').join('], [data-panel=') + ']');

			this.setOptions(options);

			this.tabs.each(function(tab){
				this.attach(tab);
			}, this);

		},

		attach: function(tab){
			var tabs = (tab ? Array.from(tab) : this.tabs);

			this.fireEvent('beforeAttach', tabs);

			tabs.each(function(tab){
				var click = tab.retrieve('roksprocket:tabs:click', function(event){
					this.click.call(this, event, tab);
				}.bind(this));
				tab.addEvent('click', click);
			}, this);

			this.fireEvent('afterAttach', tabs);
		},

		detach: function(tab){
			var tabs = (tab ? Array.from(tab) : this.tabs);

			this.fireEvent('beforeDetach', tabs);

			tabs.each(function(tab){
				var click = tab.retrieve('roksprocket:tabs:click');
				tab.removeEvent('click', click);
			}, this);

			this.fireEvent('afterDetach', tabs);
		},

		click: function(event, tab){
			event.preventDefault();

			var id = tab.get('data-tab'),
				panel = document.getElement('[data-panel='+id+']');

			if (panel){
				var active = {
					tab: this.tabs.filter(function(tab){
						return tab.hasClass('active');
					})[0],
					panel: this.panels.filter(function(panel){
						return panel.hasClass('active');
					})[0]
				};

				this.fireEvent('beforeChange', [tab, panel, active]);

				$$(this.tabs, this.panels).removeClass('active');
				this.panels.setStyle('display', 'none');

				$$(tab, panel).addClass('active');
				panel.setStyle('display', 'block');

				this.fireEvent('afterChange', [tab, panel]);
			}
		}
	});

})());
