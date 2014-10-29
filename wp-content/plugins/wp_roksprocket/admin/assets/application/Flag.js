/*!
 * @version   $Id: Flag.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){
	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Flag = new Class({

		Implements: [Options, Events],

		options:{
			/*
				onInitialize: function(){},
				onStateChange: function(flag){}
			*/
		},

		initialize: function(state, options){
			this.setOptions(options);
			this.flag = state || false;
			this.fireEvent('initialize');

			return this;
		},

		getState: function(){
			return this.flag;
		},

		setState: function(state){
			this.flag = state;

			this.fireEvent('stateChange', this.flag);
			return this;
		},

		reset: function(){
			this.flag = false;

			return this;
		}

	});

})());
