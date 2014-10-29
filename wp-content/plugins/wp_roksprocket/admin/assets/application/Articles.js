/*!
 * @version   $Id: Articles.js 19467 2014-03-04 21:36:09Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){
	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	this.Articles = new Class({

		Implements: [Options, Events],

		options:{
			/*
				onModelRequest: function(){},
				onModelSuccess: function(Response response){}
			*/
		},

		initialize: function(container, options){
			this.setOptions(options);

			this.container = document.id(container) || document.getElement(container) || null;
			this.flag = RokSprocket.flag;
			this.model = new Request({
				url: RokSprocket.URL,
				data: {model: 'wparticles', model_action: 'getItems', params: {}},
				onRequest: this.onModelRequest.bind(this),
				onSuccess: this.onModelSuccess.bind(this)
			});

			this.bounds = {
				article: {
					getInfo: this.getItemInfo.bind(this),
					getInfoOn: this.showPopover.bind(this),
					getInfoOff: this.hidePopover.bind(this),
					getPreview: this.getItemPreview.bind(this),
					setFlag: this.setFlag.bind(this)
				}
			};

			this.articles = [];
			this.loadmore = false;

			if (!this.container) throw new Error('Articles container "' + container.toString() + '" not found in the DOM.');
			else {
				this.container.getElements('[data-article-id]').each(this.addArticle.bind(this));
			}

			return this;
		},

		getItem: function(){

		},

		getItemInfo: function(element, html){
			RokSprocket.popover.setBody(html);
		},

		getItemPreview: function(element, html){
			RokSprocket.modal.set({
				title: element.getElement('.title h1').get('text'),
				type: 'close',
				body: html
			}).show();
		},

		getItems: function(more){
			if (this.model.isRunning) this.model.cancel();
			this.model.options.data.model_action = 'getItems';
			//if (this.flag.getState()) return;

			var extras = RokSprocket.content.getProviderSubmit().object,
				params = {
					provider: RokSprocket.content.getProvider(),
					layout: RokSprocket.content.getLayout(),
					module_id: RokSprocket.content.getModuleId(),
					uuid: RokSprocket.content.getInstanceId(),
					filters: RokSprocket.content.getFilters('_filters').json,
					articles: RokSprocket.content.getFilters('_articles').json,
					sort: RokSprocket.content.getSort().json,
					display_limit: RokSprocket.displayLimit.getValue()
				};

			if (extras) params['extras'] = extras;
			params['load_all'] = (more && more.load_all) ? more.load_all : false;

			params['page'] = (more && more.page ? more.page : 1);

			this.loadmore = !!more;

			this.setParams(params).send();
		},

		getItemsWithNew: function(more){
			if (this.model.isRunning) this.model.cancel();
			this.model.options.data.model_action = 'getItemsWithNew';
			//if (this.flag.getState()) return;

			var extras = RokSprocket.content.getProviderSubmit().object,
				params = {
					provider: RokSprocket.content.getProvider(),
					layout: RokSprocket.content.getLayout(),
					module_id: RokSprocket.content.getModuleId(),
					uuid: RokSprocket.content.getInstanceId(),
					filters: RokSprocket.content.getFilters('_filters').json,
					articles: RokSprocket.content.getFilters('_articles').json,
					sort: RokSprocket.content.getSort().json,
					display_limit: RokSprocket.displayLimit.getValue()
				};

			if (extras) params['extras'] = extras;
			params['load_all'] = (more && more.load_all) ? more.load_all : false;

			params['page'] = (more && more.page ? more.page : 1);

			this.loadmore = !!more;

			this.setParams(params).send();
		},

		removeItem: function(item, more){
			if (this.model.isRunning) this.model.cancel();
			this.model.options.data.model_action = 'removeItem';
			//if (this.flag.getState()) return;

			var extras = RokSprocket.content.getProviderSubmit().object,
				params = {
					provider: RokSprocket.content.getProvider(),
					layout: RokSprocket.content.getLayout(),
					module_id: RokSprocket.content.getModuleId(),
					uuid: RokSprocket.content.getInstanceId(),
					filters: RokSprocket.content.getFilters('_filters').json,
					articles: RokSprocket.content.getFilters('_articles').json,
					sort: RokSprocket.content.getSort().json,
					display_limit: RokSprocket.displayLimit.getValue(),
					item_id: item
				};

			if (extras) params['extras'] = extras;
			params['load_all'] = (more && more.load_all) ? more.load_all : false;

			params['page'] = (more && more.page ? more.page : 1);

			this.loadmore = !!more;

			this.setParams(params).send();
		},

		showPopover: function(element, container){
			document.id(RokSprocket.popover).inject(element);
			RokSprocket.popover.set({
				title: container.getElement('.title h1').get('text'),
				body: '<div class="spinner"><i class="icon spinner spinner-64"></i></div>',
				kind: 'popover-right'
			}).show();
		},

		hidePopover: function(element, container){
			RokSprocket.popover.hide();
		},

		addArticle: function(article){
			var item = new Article(article).addEvents(this.bounds.article);
			this.articles.push(item);
		},

		onModelRequest: function(){
			this.fireEvent('modelRequest');
		},

		onModelSuccess: function(response){
			response = new Response(response, {onError: this.error.bind(this)});

			this.articles.empty();
			var html = response.getPath('payload.html');

			if (html !== null){
				this.container.set('class', 'clearfix provider-' + RokSprocket.content.getProvider() + ' articles no-articles');

				var dummy = new Element('div', {html: html});
				if (!this.loadmore) this.container.getElements('[data-article-id]').dispose();
				this.container.adopt(dummy.getChildren());
				this.container.getElements('[data-article-id]').each(this.addArticle.bind(this));
				if (this.articles.length) this.container.set('class', 'clearfix provider-' + RokSprocket.content.getProvider() + ' articles');
			} else {
				var payload = response.getPath('payload');
				if (payload){
					var removedItem = JSON.decode(payload).removed_item,
						removedItemElement = this.container.getElement('[data-article-id='+removedItem+']');

					moofx(removedItemElement).animate({opacity: 0, transform: 'scale(0)'}, {duration: 300, callback: function(){
						removedItemElement.dispose();
						this.container.getElements('[data-article-id]').each(this.addArticle.bind(this));
						this.container.set('class', 'clearfix provider-' + RokSprocket.content.getProvider() + ' articles' + (this.articles.length ? '' : ' no-articles'));
					}.bind(this)});
				}
			}

			RokSprocket.Paging.more = response.getPath('payload.more') || false;
			RokSprocket.Paging.page = response.getPath('payload.page') || 1;
			RokSprocket.Paging.next_page = response.getPath('payload.next_page') || 2;

			RokSprocket.more.button[(!RokSprocket.Paging.more) ? 'addClass' : 'removeClass']('hide-load-more');
			RokSprocket.more.button.removeClass('loader disabled');

			this.fireEvent('modelSuccess', response);
			this.loadmore = false;
		},

		setFlag: function(field, article){
			this.flag.setState(true);
			this.fireEvent('setFlag', [this.flag, field, article]);
		},

		resetFlag: function(){
			this.flag.setState(false);
			this.fireEvent('resetFlag', this.flag);
		},

		setParams: function(params){
			var data = Object.merge(this.model.options.data, {params: params || {}});

			data.params = JSON.encode(data.params);
			return this.model.setOptions(data);
		},

		updateLimit: function(limit){
			var articles = [], limited = [];

			if (!limit) limit = this.articles.length;

			articles = this.container.getElements('[data-article-id]:not(.i-am-a-clone)');
			limited = new Elements(articles.slice(0, limit));

			articles.removeClass('display-limit-flag').removeClass('last-child').removeClass('first-child');

			if(limited.length != articles.length || limit > articles.length) limited.addClass('display-limit-flag');
			if (limited[0]) limited[0].addClass('first-child');
			if (limit <= articles.length && limited.getLast()) limited.getLast().addClass('last-child');
		},

		error: function(message){
			RokSprocket.modal.set({
				kind: 'rserror',
				title: 'Error',
				type: ['close', {labels: {close: 'Close'}}],
				body: '<p>Error while retrieving the Articles with the applied filters:</p>' + '<p><pre>' + message + '</pre></p>'
			}).show();
		}

	});

	this.Article = new Class({

		Extends: Articles,

		Implements: [Options, Events],

		options:{
			/*
				onModelRequest: function(){},
				onModelSuccess: function(Response response){}
			*/
		},

		initialize: function(element, options){
			this.element = document.id(element) || null;
			this.model = new Request({
				url: RokSprocket.URL,
				data: {model: 'wparticles', model_action: '', params: {}},
				onRequest: this.onModelRequest.bind(this),
				onSuccess: this.onModelSuccess.bind(this)
			});

			this.bounds = {
				relay: {
					'click:relay(.preview-wrapper)': this.getPreview.bind(this),
					'change:relay(.item-params select, .item-params input)': this.setFlag.bind(this),
					'keyup:relay(.item-params input, [data-article-title-input])': this.setFlag.bind(this),
					'mouseenter:relay(.item-params input[type=text]:not([data-imagepicker-display],[data-peritempicker-display]))': this.showTipPreview.bind(this),
					'mouseleave:relay(.item-params input[type=text]:not([data-imagepicker-display],[data-peritempicker-display]))': this.hideTipPreview.bind(this),
					'blur:relay(.item-params input[type=text])': this.hideTipPreview.bind(this),
					'keyup:relay(.item-params input[type=text]:not([data-imagepicker-display],[data-peritempicker-display]))': this.updateTipPreview.bind(this)
				},
				info: {
					'mouseenter': this.getInfoOn.bind(this),
					'mouseleave': this.getInfoOff.bind(this)
				}
			};

			this.attach();
		},

		attach: function(){
			this.element.addEvents(this.bounds.relay);
			var info = this.element.getElement('.info-wrapper');
			if (info) info.addEvents(this.bounds.info);
		},

		detach: function(){
			this.element.removeEvents(this.bounds.relay);
			var info = this.element.getElement('.info-wrapper');
			if (info) info.removeEvents(this.bounds.info);
		},

		getID: function(){
			return this.element.get('data-article-id');
		},

		getAction: function(){
			return this.model.options.data.model_action;
		},

		getInfoOn: function(e){
			e.preventDefault();
			clearTimeout(this.timer);

			var extras = RokSprocket.content.getProviderSubmit().object,
				params = {id: this.getID()};

			if (extras) params['extras'] = extras;

			var timer = function(){
				this.model.options.data.model_action = 'getInfo';
				this.setParams(params);
				this.model.send();
				this.fireEvent('getInfoOn', [e.target, this.element]);
			}.bind(this);

			this.timer = timer.delay(400);
		},

		getInfoOff: function(e){
			e.preventDefault();
			clearTimeout(this.timer);

			this.fireEvent('getInfoOff', [e.target, this.element]);
		},

		getPreview: function(e){
			e.preventDefault();

			var extras = RokSprocket.content.getProviderSubmit().object,
				params = {id: this.getID()};

			if (extras) params['extras'] = extras;

			this.model.options.data.model_action = 'getPreview';
			this.setParams(params);
			this.model.send();
		},

		showTipPreview: function(event, input){
			input = document.id(input);

			var twipsy = input.retrieve('twipsy', input.twipsy({placement: 'above', offset: 5, html: true}));

			this.updateTipPreview(event, input);
		},

		hideTipPreview: function(event, input){
			input = document.id(input);

			var twipsy = input.retrieve('twipsy', input.twipsy({placement: 'above', offset: 5, html: true}));
			twipsy.hide();
		},

		updateTipPreview: function(event, input){
			input = document.id(input);

			var value = input.get('value'),
				twipsy = input.retrieve('twipsy', input.twipsy({placement: 'above', offset: 5, html: true}));

			if (!value.length) return this.hideTipPreview(event, input);

			input.set('data-original-title', value);
			twipsy.show().setContent(value);
		},

		setFlag: function(event, field){
			this.fireEvent('setFlag', [field, this.element]);
		},

		onModelSuccess: function(response){
			response = new Response(response, {onError: this.error.bind(this)});

			var html = response.getPath('payload.html');
			if (html !== null){
				this.fireEvent(this.getAction(), [this.element, html]);
			}

			this.fireEvent('modelSuccess', response);
		},

		toElement: function(){
			return this.element;
		}

	});

})());
