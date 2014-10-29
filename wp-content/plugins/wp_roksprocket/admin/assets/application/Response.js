/*!
 * @version   $Id: Response.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){
	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Response = new Class({

		Implements: [Options, Events],

		options:{
			/*
				onParse: function(data){},
				onSuccess: function(data){},
				onError: function(data){}
			*/
		},

		initialize: function(data, options){
			this.setOptions(options);
			this.setData(data);

			return this;
		},

		setData: function(data){
			this.data = data;
		},

		getData: function(){
			return (typeOf(this.data) != 'object') ? this.parseData(this.data) : this.data;
		},

		parseData: function(){
			if (!JSON.validate(this.data)) return this.error('Invalid JSON data <hr /> ' + this.data);

			this.data = JSON.decode(this.data);

			if (this.data.status != 'success') return this.error(this.data.message);

			this.fireEvent('parse', this.data);

			return this.success(this.data);

		},

		getPath: function(path){
			var data = this.getData();

			if (typeOf(data) == 'object') return Object.getFromPath(data, path || '');
			else return null;
		},

		success: function(data){
			this.data = data;

			this.fireEvent('success', this.data);
			return this.data;
		},

		error: function(message){

			this.fireEvent('error', message);
			return message;
		}

	});

})());
