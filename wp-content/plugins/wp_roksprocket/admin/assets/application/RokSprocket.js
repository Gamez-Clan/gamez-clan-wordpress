/*!
 * @version   $Id: RokSprocket.js 21927 2014-07-10 23:29:54Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){
	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	var OnInputEvent = (Browser.name == 'ie' && Browser.version <= 9) ? 'keypress' : 'input';

	this.RokSprocket.dynamicfields = {
		list: {},
		add: function(id, fieldname){
			RokSprocket.dynamicfields.list[id] = fieldname;
		},
		attach: function(){
			Object.each(RokSprocket.dynamicfields.list, function(fieldname, id){
				RokSprocket.dynamicfields.addChange(id, fieldname);
			});

			//$$('.panel-right > ul > li:not([style])').setStyle('display', 'block');
		},
		attachLastFire: function(){
			document.getElements('.dynamicfield-last-fire').addEvent('change', function(){
				var params = RokSprocket.params;
				document.id(params + '_layout').fireEvent('change');
			});
		},
		addChange: function(id, fieldname){
			document.id(id).addEvent('change', function(){
				RokSprocket.dynamicfields.fireChange.apply(document.id(id), [id, fieldname]);
			}).fireEvent('change');
		},
		fireChange: function(id, fieldname){
			var element = this;

			if (typeOf(element) != 'element') element = document.id(id);
			if (!element.options.length || !element.options[element.selectedIndex]) return;
			var rel = document.id(element.options[element.selectedIndex]).get('rel'),
				fields = document.getElements('.'+fieldname+':not([data-dynamic=false])'),
				values = document.getElements('.' + rel + ':not([data-dynamic=false])');

			var fieldsDropdowns = fields.filter(function(value){
				return value.get('tag') == 'option';
			});
			var dropdowns = values.filter(function(value){
				return value.get('tag') == 'option';
			});

			var fieldsParent = fields.getParent('li'),
				valuesParent = values.getParent('li');

			fieldsParent.each(function(field){ if (field) field.setStyle('display','none'); });
			valuesParent.each(function(field){ if (field) field.setStyle('display','block'); });

			//fields.getParent('li').setStyle('display','none');
			//values.getParent('li').setStyle('display','block');

			// special case for dropdowns
			[dropdowns, fieldsDropdowns].flatten().each(function(option){
				var select = option.getParent('select'),
					activeOption = select.getElement('option[value='+select.get('value')+']:not(.'+rel+')');

				if (select.get('value') == option.get('value') && activeOption && !activeOption.hasClass(rel)){
					var firstValue = select.getFirst().get('value'),
						sprocketDropdown = select.getParent('.sprocket-dropdown [data-value='+firstValue+']');
					if (sprocketDropdown) sprocketDropdown.fireEvent('click', {target: sprocketDropdown});
					else select.set('value', firstValue).fireEvent('change');
				}
			});


			// let's fire all the subinstances of dynamicfields to clear possible conflicts
			document.getElements('.dynamicfield-subinstance.'+rel+':not(#'+id+')').fireEvent('change');
		},
		refreshProvider: function(){
			var provider = RokSprocket.params + '_provider';
			//RokSprocket.dynamicfields.fireChange(provider, RokSprocket.dynamicfields.list[provider]);
		}
	};

	this.RokSprocket.displayLimit = {
		char: String.fromCharCode(8734),
		field: null,
		attach: function(){
			var params = RokSprocket.params,
				field = document.id(params + '_display_limit');

			RokSprocket.displayLimit.field = field;

			if (field){
				field.addEvent('keyup', RokSprocket.displayLimit.attachInputEvent);
				field.addEvent('blur', RokSprocket.displayLimit.attachBlurEvent);
			}
		},
		attachInputEvent: function(){
			var value = RokSprocket.displayLimit.cleanValue(this.value);
			if (this.get('value') == '0') this.set('value', RokSprocket.displayLimit.char);
			RokSprocket.articles.updateLimit(value);
		},
		attachBlurEvent: function(){
			if (!this.value.length) this.set('value', RokSprocket.displayLimit.char).fireEvent('change');
			else this.set('value', RokSprocket.displayLimit.getValue() || RokSprocket.displayLimit.char);
		},
		cleanValue: function(value){
			value = value.match(/\d+/g);
			if (!value) value = ['0'];

			value = value.join('').replace(RokSprocket.displayLimit.char, 0).toInt() || 0;

			return value;
		},
		getValue: function(){
			return RokSprocket.displayLimit.cleanValue(RokSprocket.displayLimit.field.get('value'));
		}
	};

	this.RokSprocket.previewLength = {
		char: String.fromCharCode(8734),
		field: null,
		attach: function(){
			var params = RokSprocket.params,
				field = document.id(params + '_' + RokSprocket.content.getLayout() + '_previews_length');

			RokSprocket.previewLength.field = field;

			if (field){
				field.addEvent('keyup', RokSprocket.previewLength.attachInputEvent);
				field.addEvent('blur', RokSprocket.previewLength.attachBlurEvent);
			}
		},
		attachInputEvent: function(){
			var value = RokSprocket.previewLength.cleanValue(this.value);
			if (this.get('value') == '0') this.set('value', RokSprocket.previewLength.char);
		},
		attachBlurEvent: function(){
			if (!this.value.length) this.set('value', RokSprocket.previewLength.char).fireEvent('change');
			else this.set('value', RokSprocket.previewLength.getValue() || RokSprocket.previewLength.char);
		},
		cleanValue: function(value){
			value = value.match(/\d+/g);
			if (!value) value = ['0'];

			value = value.join('').replace(RokSprocket.previewLength.char, 0).toInt() || 0;

			return value;
		},
		getValue: function(){
			return RokSprocket.previewLength.cleanValue(RokSprocket.previewLength.field.get('value'));
		}
	};

	this.RokSprocket.layout = {
		flag: false,
		attach: function(){
			var layout = document.getElement('#'+RokSprocket.params+'_layout'),
				value = layout.get('value'),
				list = layout.getElements('!> .dropdown-original !~ .dropdown-menu li[data-value]');

			layout.addEvent('change', function(){
				if (!RokSprocket.layout.flag){
					moofx(document.getElement('.panel-left h6 i.spinner')).animate({opacity: 1}, {duration: '300ms'});
					RokSprocket.articles.getItems();
				}
			});
		}
	};

	this.RokSprocket.init = function(){
		this.RokSprocket.content = {
			getModuleId: function(){
				var field = document.id('jform_id') || document.id('id');
				return (field ? field.get('value') : 0).toInt();
			},
			getInstanceId: function(){
				var field = document.id('jform_uuid') || document.id('uuid');
				return (field ? field.get('value') : "0");
			},
			getLayout: function(){
				return document.getElement('#'+RokSprocket.params+'_layout').get('value');
			},
			getProvider: function(){
				return document.getElement('#'+RokSprocket.params+'_provider').get('value');
			},
			getFilters: function(type){
				var provider = RokSprocket.content.getProvider();

				return RokSprocket.filters.getFilters(provider + (type || '_filters')) || {};
			},
			getArticlesIDs: function(){
				var filters = RokSprocket.content.getFilters('_articles'),
					articles = [];

				Object.each(filters.object, function(value, key){
					articles.push(RokSprocket.content.getFormat() + Object.getFromPath(filters.object[key], 'root.article'));
				});

				filters.json = JSON.encode(articles);

				return filters;
			},
			getSort: function(){
				var provider = RokSprocket.content.getProvider(),
					sort = document.getElement('[id$=' + provider + '_sort]'),
					append = document.getElement('[id$=' + provider + '_sort_manual_append]'),
					filter = sort ? RokSprocket.content.getFilters('_sort_' + sort.get('value') + '_filters') : null,
					result = {
						type: sort ? sort.get('value') : '',
						rules: filter ? filter.object : {}
					};

				if (result.type == 'manual' && append) result.append = append.get('value');

				return {json: JSON.encode(result)};
			},
			getProviderSubmit: function(){
				var datasets = document.getElements('[data-provider-submit].provider_' + RokSprocket.content.getProvider()),
					extras = {},
					query = [];
				if (!datasets.length) return false;

				datasets.each(function(dataset){
					var key = dataset.get('data-provider-submit'),
						value = dataset.get('value');

					extras[key] = value;
					query.push(key + '=' + value);
				});

				return {object: extras, keyvalue: query.join('&')};
			},
			getFormat: function(){
				return RokSprocket.content.getProvider() + '-';
			}
		};

		if (this.RokSprocket.content.getModuleId()){
			this.RokSprocket.dynamicfields.attach();
			this.RokSprocket.dynamicfields.attachLastFire();
			this.RokSprocket.dynamicfields.refreshProvider();
		} else {
			this.RokSprocket.selector = {
				init: function(){
					var provider  = document.id('create-new-provider'),
						layout    = document.id('create-new-layout'),
						providers = $$('[data-sprocket-provider]'),
						layouts   = $$('[data-sprocket-layout]'),
						recommendedElement;

					moofx(document.getElement('[data-sprocket-notice]')).style({opacity: 0, transform: 'scale(0)', visibility: 'visible'});

					providers.addEvent('click', function(e){
						if (e) e.preventDefault();
						providers.removeClass('active');
						this.addClass('active');
						provider.set('value', this.get('data-sprocket-provider'));
					});

					layouts.addEvent('click', function(e){
						if (e) e.preventDefault();
						layouts.removeClass('active');
						this.addClass('active');
						layout.set('value', this.get('data-sprocket-layout'));

						if (recommendedElement) recommendedElement.removeClass('asterisk');

						var recommended        = JSON.parse(this.get('data-sprocket-recommended')),
							notice             = document.getElement('[data-sprocket-notice]');

						recommendedElement = document.getElement('[data-sprocket-provider="'+recommended+'"]');
						if (recommended){
							var strongs = notice.getElements('strong');
							strongs[0].set('text', this.get('text'));
							strongs[1].set('text', recommendedElement.get('text'));
						}

						if (!recommended){
							if (recommendedElement) recommendedElement.removeClass('asterisk');
							moofx(notice).animate({ transform: 'scale(0)', opacity: 0 }, { duration: '250ms' });
						} else {
							if (recommendedElement) recommendedElement.addClass('asterisk').fireEvent('click');
							moofx(notice).animate({ transform: 'scale(1)', opacity: 1 }, { duration: '200ms' });
						}
					});
				}
			};

			var title = document.getElement('[name=title]');
			if (title){
				title.addEvent('keyup', function(e){
					if (e.key == 'enter'){
						e.stop();
						RokSprocket.continueButton.fireEvent('click');
					}
				});
			}

			this.RokSprocket.selector.init();
		}

		this.RokSprocket.displayLimit.attach();
		this.RokSprocket.tabs = new Tabs();
		this.RokSprocket.dropdowns = new Dropdowns({
			onSelection: function(event, select, value, dropdown){
				if (select.getParent('[data-article-id]')){
					select.getParent('[data-article-id]').fireEvent('change:relay(.item-params select, .item-params input)');
				}
			}
		});
		this.RokSprocket.modal = new Modal();
		this.RokSprocket.popover = new Popover();

		this.RokSprocket.flag = new Flag(true, {
			onInitialize: function(){
				var _this = this;
				this.elements = document.getElements('[data-flag]');
				this.target = null;
				this.events = {
					'mousedown': function(e){
						e.stop();
						this.target = null;

						if (e && e.target){
							if (e.target.get('tag') == 'li' && e.target.get('data-value')) _this.target = e.target;
							if (e.target.getParent('li[data-value')) _this.target = e.target.getParent('li[data-value');
						}

						RokSprocket.modal.set({
							title: "Changes Detected",
							body: "Unsaved settings have been detected. If you continue you could loose them. Click Save to save all the settings now or Ignore to continue.",
							type: ["yesno", {labels: {yes: "Save", no: "Ignore"}}],
							kind: 'rserror',
							beforeShow: function(){
								var save = this.statusbar.getElement('.yes'),
									ignore = this.statusbar.getElement('.no');

								this.buttonsEvents = {
									ignore: {
										'click:once': function(){
											RokSprocket.articles.resetFlag();
											if (_this.target){
												var select = _this.target.getElement('!> .dropdown-menu ~ .dropdown-original select');
												if (select) RokSprocket.dropdowns.selection({target: _this.target}, select).hideAll();
												else document.fireEvent('click', {target: _this.target.getElement('[data-additem-action]')});
											}
										}
									},

									save: {
										'click': function(){
											if (RokSprocket.save.ajax.isRunning()) return false;

											this.indicator.setStyle('display', 'block')
												.getElement('.message');
											save.addClass('disabled');
											RokSprocket.save.button.fireEvent('click');
										}.bind(this)
									}
								};

								ignore.addEvents(this.buttonsEvents.ignore);
								save.addEvents(this.buttonsEvents.save);

								this.indicator = new Element('div.indicator', {styles: {'display': 'none'}}).inject(this.statusbar);
								new Element('span').adopt(new Element('i.icon.spinner.spinner-16')).inject(this.indicator);
								new Element('span.message').inject(this.indicator);

								this.popupSave = {
									request: function(){
										RokSprocket.messages.hide();
										this.indicator.getFirst('span').setStyle('display', 'block');
										this.indicator.getElement('.message').set('text', 'Saving...');
									}.bind(this),
									failure: function(xhr){
										var message = 'Error: ' + (xhr.status ? xhr.status + ' - ' + xhr.statusText : xhr);
										this.indicator.getElement('.message').set('text', message);
										this.indicator.getFirst('span').setStyle('display', 'none');
									}.bind(this),
									success: function(response){
										response = new Response(response, {onError: this.popupSave.failure.bind(this)});

										var status = response.getPath('status'),
											message = 'Success: All changes have been successfully saved';
										if (status == 'success'){
											RokSprocket.messages.show('message', message);

											this.indicator.getElement('.message').set('text', message);
											this.indicator.getFirst('span').setStyle('display', 'none');
											this.statusbar.getElement('.yes').setStyle('display', 'none');
											this.statusbar.getElement('.no').addClass('btn-primary').set('text', 'Close');

											// all good, let's reset the flag
											RokSprocket.articles.resetFlag();
										}

									}.bind(this),
									complete: function(){
										save.removeClass('disabled');
										this.indicator.getFirst('span').setStyle('display', 'none');
									}.bind(this)
								};
								RokSprocket.save.ajax.addEvents(this.popupSave);
							},

							beforeHide: function(){
								this.indicator.dispose();
								RokSprocket.save.ajax.removeEvents(this.popupSave);
								this.statusbar.getElement('.no').removeEvents(this.buttonsEvents.ignore);
								this.statusbar.getElement('.yes').removeEvents(this.buttonsEvents.save);
							}
						}).show();
					}
				};

				if (!this.elements.length){
					var params = RokSprocket.params,
						list = ['[data-filter]',
								'[data-additem-action="addItem"]',
								'#'+params+'_provider !> .dropdown-original !~ .dropdown-menu li[data-value]',
								'#'+params+'_layout !> .dropdown-original !~ .dropdown-menu li[data-value]',
								'#'+params+'_joomla_sort !> .dropdown-original !~ .dropdown-menu li[data-value]',
								'#'+params+'_joomla_sort_manual_append !> .dropdown-original !~ .dropdown-menu li[data-value]'];

					this.elements = document.getElements(list.join(', '));
				}
			},
			onStateChange: function(state){
				if (!this.elements.length) return;

				var selects = this.elements.filter(function(select){
						return select.get('tag') == 'select' || select.getElement('!> .dropdown-menu ~ .dropdown-original select');
					}).clean(),
					elements = [
						selects,
						RokSprocket.filters.containers,
						RokSprocket.filters.containers.getElements('a'),
						document.getElement('[data-additem-action]')
					].flatten();

				if (state){
					RokSprocket.filters.detachAll();
					RokSprocket.dropdowns.detach(selects);
					new Elements(elements).addEvents(this.events);
				} else {
					RokSprocket.filters.attachAll();
					RokSprocket.dropdowns.attach(selects);
					new Elements(elements).removeEvents(this.events);
				}
			}
		});

		if (RokSprocket.content.getModuleId()){
		this.RokSprocket.articles = new Articles('.articles', {
			onModelSuccess: function(response){
				//console.log(response && !response.data.payload);
				//if (response && !response.data.payload) return;
				moofx(document.getElement('.panel-left h6 i.spinner')).animate({opacity: 0}, {duration: '300ms'});
				RokSprocket.layout.flag = true;
				//document.getElement('.layoutselection').fireEvent('change');
				if (RokSprocket.content.getProvider() == 'simple') RokSprocket.dynamicfields.refreshProvider();
				RokSprocket.layout.flag = false;
				document.getElements('.articles .sprocket-tip').twipsy({placement: 'left', offset: 5});

				RokSprocket.dropdowns.reload();
				RokSprocket.dropdowns.attach();

				RokSprocket.updateOrder();

				//RokSprocket.dynamicfields.refreshProvider();

				// attach image and peritem pickers
				var peritempickers = document.getElements('.articles [data-peritempicker]'),
					peritempickerstags = document.getElements('.articles [data-peritempickertags]'),
					imagepickers = document.getElements('.articles [data-imagepicker]');

				RokSprocket.peritempicker.attach(peritempickers);
				RokSprocket.peritempickertags.attach(peritempickerstags);
				RokSprocket.imagepicker.attach(imagepickers);

				// reattach tags and multiselect
				if (RokSprocket.multiselect) RokSprocket.multiselect.reattach();
				if (RokSprocket.tags) RokSprocket.tags.reattach();

				if (document.getElements('.articles [data-article-id]').length > 1){
					this.sortables = new Sortables('.articles', {
						clone: true,
						opacity: (Browser.firefox) ? 1 : 0.5,
						handle: '.handle',
						onStart: function(element, clone){
							clone.setStyle('z-index', 800);
							RokSprocket.sorting.toManual();
							element.removeClass('display-limit-flag').removeClass('first-child').removeClass('last-child');
							clone.removeClass('display-limit-flag').removeClass('first-child').removeClass('last-child');
							clone.addClass('i-am-a-clone');
						},
						onSort: function(element, clone){
							element.removeClass('display-limit-flag').removeClass('first-child').removeClass('last-child');
							clone.removeClass('display-limit-flag').removeClass('first-child').removeClass('last-child');
							RokSprocket.articles.updateLimit(RokSprocket.displayLimit.getValue());
						},
						onComplete: function(element){
							RokSprocket.updateOrder();
						}.bind(this),
						dragOptions: {
							container: document.getElement('.articles'),
							includeMargins: false
						}
					});
				}
			}
		});
		}

		this.RokSprocket.updateOrder = function(){
			RokSprocket.articles.container.getElements('[data-article-id]').each(function(element, i){
				var orderElement = element.getElement('[data-order]');
				if (orderElement){
					orderElement.set('value', i.toString());
				}
			}, this);

			RokSprocket.articles.updateLimit(RokSprocket.displayLimit.getValue());
		};

		/*this.RokSprocket.additem = new AddItem('.articles', {
			onModelSuccess: function(response){
				console.log('response');
			}
		});*/

		document.addEvent('click:relay([data-additem-action])', function(e, element){
			moofx(document.getElement('.panel-left h6 i.spinner')).animate({opacity: 1}, {duration: '300ms'});
			RokSprocket.articles.getItemsWithNew();
		});

		this.RokSprocket.filters = new Filters({
			onFiltersChange: function(provider, filters){
				if (!provider || !provider.contains('_sort_manual_filters')){
					moofx(document.getElement('.panel-left h6 i.spinner')).animate({opacity: 1}, {duration: '300ms'});
					RokSprocket.articles.getItems();
				}
			}
		});

		if (typeof RokSprocketFilters != 'undefined' && RokSprocketFilters.filters){
			this.RokSprocket.filters.addDataSets(RokSprocketFilters.filters, RokSprocketFilters.template);
		}

		this.RokSprocket.datepicker = new Picker.Date($$('.date-picker !~ .dateselection'), {
			animationDuration: 200,
			format: '%Y-%m-%d',
			timePicker: false,
			positionOffset: {x: (-172 - 7), y: 5},
			pickerClass: 'datepicker_vista',
			useFadeInOut: !Browser.ie,
			toggle: $$('.date-picker'),
			onSelect: function(date, input){
				input.fireEvent((Browser.name == 'ie' && Browser.version <= 9) ? 'keypress' : 'input');
			}
		});

		this.RokSprocket.messages = {
			// types: message / error
			show: function(type, message){
				var system = document.getElement('.sprocket-messages');

				system
					.setStyle('display', 'block')
					.getElement('#message').empty().set('html', '<p>' + message + '</p>')
					.removeClass('error').removeClass('updated')
					.addClass(type == 'message' ? 'updated' : 'error');

			},
			hide: function(type){
				var system = document.getElement('.sprocket-messages');
				system
					.setStyle('display', 'none')
					.getElement('#message')
					.removeClass('error').removeClass('updated');
			}
		};


		if (RokSprocket.content.getModuleId()) this.RokSprocket.previewLength.attach();

		this.RokSprocket.sorting = {
			init: function(){
				var value = 'manual',
					provider = RokSprocket.content.getProvider(),
					sortDropdown = document.getElement('[id$='+provider+'_sort]');

				RokSprocket.sorting.flag = new Flag(true, {
					onInitialize: function(){
						this.events = {
							'click': function(e){
								e.stop();
								var target = e.target.get('tag') == 'li' ? e.target : e.target.getParent('li');

								RokSprocket.modal.set({
									title: "Changes Detected",
									body: "By changing to '" + target.get('data-text') + "' you will loose any manual sorting you may have made. Do you wish to continue with this action?",
									type: ["yesno", {labels: {yes: "Yes", no: "No"}}],
									kind: 'rserror',
									beforeShow: function(){
										var yes = this.statusbar.getElement('.yes'),
											no = this.statusbar.getElement('.no');

										this.buttonsEvents = {
											no: {
												'click:once': function(){
													RokSprocket.sorting.flag.setState(true);
													RokSprocket.sorting.toManual();
													RokSprocket.dropdowns.hideAll();
												}
											},

											yes: {
												'click:once': function(){
													RokSprocket.sorting.flag.setState(true);

													var provider = RokSprocket.content.getProvider(),
														filter = document.getElement('[data-filter*='+provider+'_sort_manual_filters]');

													if (filter) RokSprocket.filters.empty(filter.get('data-filter'));
													RokSprocket.sorting.toItem(target.get('data-value'));
													if (filter) RokSprocket.filters.fireEvent('onFiltersChange');

													RokSprocket.dropdowns.hideAll();
													this.hide();
												}.bind(this)
											}
										};

										no.addEvents(this.buttonsEvents.no);
										yes.addEvents(this.buttonsEvents.yes);
									},

									beforeHide: function(){
										this.statusbar.getElement('.no').removeEvents(this.buttonsEvents.no);
										this.statusbar.getElement('.yes').removeEvents(this.buttonsEvents.yes);
									}
								}).show();
							}
						};
					},
					onStateChange: function(flag){
						if (!sortDropdown) return;

						if (!flag){
							RokSprocket.dropdowns.detach(sortDropdown);
							sortDropdown.getParent('.sprocket-dropdown').addEvents(this.events);
						} else {
							sortDropdown.getParent('.sprocket-dropdown').removeEvents(this.events);
							RokSprocket.dropdowns.attach(sortDropdown);
						}
					}
				});

				if (sortDropdown) sortDropdown.addEvent('beforeChange', RokSprocket.sorting.changeEvent);

			},
			changeEvent: function(event, select, value, selected){
				var target = event.target,
					provider = RokSprocket.content.getProvider(),
					filter = document.getElement('[data-filter*='+provider+'_sort_manual_filters]'),
					dataValue = target.getParent('[data-value]'),
					clicked = (dataValue && dataValue.get('data-value') != 'manual');

				if (value != 'manual' && clicked && select.get('value') != value){
					if (select.get('value') != 'random') RokSprocket.sorting.flag.setState(false);
				}
			},

			toItem: function(value){
				var provider = RokSprocket.content.getProvider(),
					filter = document.getElement('[data-filter*='+provider+'_sort_manual_filters]'),
					sortDropdown = document.getElement('[id$='+provider+'_sort]');

				if (sortDropdown && sortDropdown.get('value') != value){
					var li = sortDropdown.getParent('.sprocket-dropdown').getElement('[data-value='+value+']');
					if (li) RokSprocket.dropdowns.selection({target: li}, sortDropdown);
				}
			},

			toManual: function(){
				var value = 'manual',
					provider = RokSprocket.content.getProvider(),
					sortDropdown = document.getElement('[id$='+provider+'_sort]');

				if (sortDropdown && sortDropdown.get('value') != value){
					var li = sortDropdown.getParent('.sprocket-dropdown').getElement('[data-value='+value+']');
					if (li) RokSprocket.dropdowns.selection({target: li}, sortDropdown);
				}
			}
		};

		if (RokSprocket.content.getModuleId()){
			//document.getElement('.content_provider').addEvent('change', RokSprocket.sorting.init);
			this.RokSprocket.layout.attach();
		}

		this.RokSprocket.save = {
			ajax: null,
			button: null,
			init: function(){
				var save = document.getElement('#toolbar-save a.toolbar'),
					otherSave = document.getElements('[data-roksprocket-save]'),
					self = this;
				if (!save) return;

				this.modeSave = null;


				if (!RokSprocket.content.getModuleId()){
					var continueButton = document.getElement('.create-new .btn');
					RokSprocket.continueButton = continueButton;
					if (continueButton){
						continueButton.addEvent('click', function(e){
							if (e) e.preventDefault();
							if (this.hasClass('disabled')) return;

							RokSprocket.save.button.fireEvent('click');
							this.addClass('disabled');
						});
					}
				}

				// I don't know if I hate more Joomla! for the inline JS or IE for not handling properly the onclick
				// Workaround for IE that keeps dirty onclick events even if removed.
				if (Browser.ie){
					var clone = save.clone();
					clone.inject(save, 'after');
					save.dispose();
					save = clone;
				}

				RokSprocket.save.button = save;
				RokSprocket.save.ajax = new Request({
					url: RokSprocket.URL,
					method: 'post',
					onRequest: RokSprocket.save.events.request,
					onComplete: RokSprocket.save.events.complete,
					onSuccess: RokSprocket.save.events.success,
					onFailure: RokSprocket.save.events.failure
				});

				otherSave.addEvent('click', function(e){
					if (e) e.stop();

					if (otherSave.hasClass('disabled').contains(true) || otherSave.hasClass('spinner').contains(true)) return false;
					if (!RokSprocket.save.checkTitle()) return false;

					var form = document.id('module-form');

					if (form){
						var querystring = form.toQueryString().parseQueryString();
						self.modeSave = this.get('data-roksprocket-save') || 'save';

						Object.each(querystring, function(value, key){
							if (typeOf(value) == 'array'){
								for (var i = 0, l = value.length; i < l; i++) {
									querystring[key.replace(/\[\]$/, '['+i+']')] = value[i];
								}

								delete querystring[key];
							}
						});

						querystring['model'] = 'edit';
						querystring['model_action'] = self.modeSave;
						querystring['model_encoding'] = 'form';

						//document.adminForm.task.value = 'module.apply'; //'module.apply';
						RokSprocket.save.ajax.send({
							data: querystring
						});
					}
				});

				//document.getElements('[data-roksprocket-save]').addEvent('click', function(e){
				//	e.preventDefault();
				//	self.saveMode = this.get('data-roksprocket-save');
				//	save.fireEvent('click');
				//});
			},
			checkTitle: function(){
				var title = document.getElement('[name=title]');
				if (title.get('value').clean() !== '') return true;

				RokSprocket.modal.set({
					'title': 'Error while saving',
					'body': '<p>A title for the Widget is required. Please insert a new title and save again.</p>',
					kind: 'rserror',
					type: ['close', {labels: {close: 'Close'}}],
					'beforeHide': function(){
						if (RokSprocket.continueButton) RokSprocket.continueButton.removeClass('disabled');
						title.focus();
					}
				}).show();
			},
			events:{
				request: function(){
					RokSprocket.messages.hide();
					document.getElement('[data-roksprocket-save='+RokSprocket.save.modeSave+']').addClass('disabled spinner');
					if (RokSprocket.continueButton) RokSprocket.continueButton.addClass('disabled');
					//RokSprocket.save.button.addClass('disabled spinner');
				}.bind(this),
				complete: function(){
					document.getElement('[data-roksprocket-save='+RokSprocket.save.modeSave+']').removeClass('disabled spinner');
					if (RokSprocket.continueButton) RokSprocket.continueButton.removeClass('disabled');
					//RokSprocket.save.button.removeClass('disabled spinner');
				}.bind(this),
				success: function(response){
					response = new Response(response, {onError: RokSprocket.save.events.failure.bind(this)});
					if (RokSprocket.continueButton) RokSprocket.continueButton.removeClass('disabled');

					var status = response.getPath('status');
					if (status == 'success'){
						if (RokSprocket.save.modeSave != 'saveascopy') RokSprocket.messages.show('message', 'All changes have been successfully saved.');

						// all good, let's reset the flag
						if (RokSprocket.articles) RokSprocket.articles.resetFlag();

						// check if it's new module
						if (!RokSprocket.content.getModuleId()){
							RokSprocket.modal.set({
								'title': 'New RokSprocket Widget Saved',
								'body': '<p>The widget has been saved successfully and because it\'s been detected as new the page will be refreshed.</p><p>Please wait...</p>',
								kind: 'success',
								'beforeShow': function(){
									this.wrapper.getElements('[data-dismiss]').dispose();
									this.statusbar.empty().dispose();
								}
							}).show();
						}

						if (response.getPath('payload.redirect')) window.location.href = response.getPath('payload.redirect');
					}
				},

				failure: function(xhr){
					var status = xhr.status,
						statusText = xhr.statusText,
						body = xhr.response || xhr;

					if (!RokSprocket.modal.isShown){
						RokSprocket.modal.set({
							title: "Error while saving",
							body: body,
							kind: 'rserror',
							type: 'close'
						}).show();
					}
				}
			}
		};

		this.RokSprocket.save.init();

		this.RokSprocket.remove = {
			list: [],
			init: function(){
				RokSprocket.remove.attach();
			},

			attach: function(){
				var twoStepsClick = document.retrieve('roksprocket:simple:remove', function(e, element){
					e.preventDefault();
					var status = element.retrieve('roksprocket:simple:step', 0);
					if (!status) RokSprocket.remove.oneStep(element);
					else if (status == 1) RokSprocket.remove.deleteItem(element);
					else return false;
				});

				document.addEvents({
					'click:relay([data-article-id] .remove-wrapper)': twoStepsClick,
					'click:relay(:not([data-article-id] .remove-wrapper))': RokSprocket.remove.revertAll
				});
			},

			oneStep: function(element){
				element.store('roksprocket:simple:step', 1);
				element.getParent('.summary').getElement('.details').setStyle('display', 'block');
				element.getParent('.summary').getElement('.remove, .deleting').setStyle('display', 'none');
				element.getParent('.summary').getElement('.confirm').setStyle('display', 'inline-block');
				RokSprocket.remove.list.push(element);
			},

			deleteItem: function(element){
				var item = element.getParent('[data-article-id]'),
					id = item.get('data-article-id');

				element.store('roksprocket:simple:step', 2);
				element.getParent('.summary').getElement('.details').setStyle('display', 'none');
				element.getParent('.summary').getElements('.remove, .confirm').setStyle('display', 'none');
				element.getParent('.summary').getElement('.deleting').setStyle('display', 'inline-block');
				RokSprocket.articles.removeItem(id);
			},

			revertSingle: function(element){
				element.store('roksprocket:simple:step', 0);
				element.getParent('.summary').getElement('.details').setStyle('display', 'block');
				element.getParent('.summary').getElement('.confirm, .deleting').setStyle('display', 'none');
				element.getParent('.summary').getElement('.remove').setStyle('display', 'inline-block');
				RokSprocket.remove.list.erase(element);
			},

			revertAll: function(event, element){
				if (element.hasClass('details') || element.hasClass('remove-wrapper') || element.getParent('.remove-wrapper')) return true;
				for (var i = RokSprocket.remove.list.length - 1; i >= 0; i--) {
					RokSprocket.remove.revertSingle(RokSprocket.remove.list[i]);
				}
			}
		};

		this.RokSprocket.remove.init();

		this.RokSprocket.editTitle = {
			init: function(){
				RokSprocket.editTitle.attach();
			},
			attach: function(){
				var click = document.retrieve('roksprocket:edittitle:click', function(e, element){
						RokSprocket.editTitle.show(element);
					}),
					keyup = document.retrieve('roksprocket:edittitle:keyup', function(e, element){
						if (e.key == 'esc') RokSprocket.editTitle.hide(element);
						if (e.key == 'enter') RokSprocket.editTitle.save(element);
					}),
					check = document.retrieve('roksprocket:edittitle:check', function(e, element){
						RokSprocket.editTitle.save(element);
					}),
					cross = document.retrieve('roksprocket:edittitle:cross', function(e, element){
						RokSprocket.editTitle.hide(element);
					});

				document.addEvents({
					'click:relay([data-article-title-edit])': click,
					'click:relay([data-article-title-cross])': cross,
					'click:relay([data-article-title-check])': check,
					'keyup:relay([data-article-title-input])': keyup
				});
			},

			show: function(element){
				var parent = element.getParent('[data-article-title]'),
					input = parent.getElement('[data-article-title-input]'),
					text = parent.getElement('span'),
					edit = parent.getElements('[data-article-title-edit]'),
					actions = parent.getElements('[data-article-title-cross], [data-article-title-check]');

				text.setStyle('display', 'none');
				actions.setStyle('display', 'inline-block');
				edit.setStyle('display', 'none');
				input.set('type', 'text');
				input.focus();
				input.select();
			},

			hide: function(element){
				var parent = element.getParent('[data-article-title]'),
					input = parent.getElement('[data-article-title-input]'),
					text = parent.getElement('span'),
					edit = parent.getElements('[data-article-title-edit]'),
					actions = parent.getElements('[data-article-title-cross], [data-article-title-check]');

				text.setStyle('display', 'inline-block');
				edit.setStyle('display', 'inline-block');
				actions.setStyle('display', 'none');
				input.set('type', 'hidden');
			},

			save: function(element){
				var parent = element.getParent('[data-article-title]'),
					input = parent.getElement('[data-article-title-input]'),
					text = parent.getElement('span');

				text.set('text', input.get('value'));
				RokSprocket.editTitle.hide(element);
			}
		};

		this.RokSprocket.editTitle.init();

		this.RokSprocket.CopyToClipboard = {
			button: null,
			copyElement: null,
			init: function(){
				var button = document.getElement('a.copy-to-clipboard'),
					copyElement = document.getElement('.shortcode');

				if (!Browser.Plugins.Flash || !button || !copyElement){
					if (button) button.dispose();
					return false;
				}

				RokSprocket.CopyToClipboard.button = button;
				RokSprocket.CopyToClipboard.copyElement = copyElement;

				var clip = button.retrieve('clip');

				if (!clip){
					clip = new ZeroClipboard.Client();
					ZeroClipboard.setMoviePath(RokSprocket.SiteURL + ZeroClipboard.moviePath);
					button.store('clip', clip);

					clip.glue(button, button);
					clip.setHandCursor(true);
					clip.addEventListener('onLoad', RokSprocket.CopyToClipboard.onLoad);
					clip.addEventListener('onMouseUp', RokSprocket.CopyToClipboard.onMouseUp);
					clip.addEventListener('onComplete', RokSprocket.CopyToClipboard.onComplete);
					if (Browser.ie) button.setStyle('opacity', 0).fade('in');
				}

				button.addEvents({
					click: function(e){ if (e) e.preventDefault(); },
					mouseleave: function(){
						this.set('data-original-title', 'Copy to Clipboard');
					}
				});

				return true;
			},

			onLoad: function(){
				var button = RokSprocket.CopyToClipboard.button,
					copyElement = RokSprocket.CopyToClipboard.copyElement;

				button.setStyle('opacity', 0).fade('in');
			},

			onMouseUp: function(){
				var button = RokSprocket.CopyToClipboard.button,
					copyElement = RokSprocket.CopyToClipboard.copyElement,
					clip = button.retrieve('clip');

				clip.setText(copyElement.get('text').clean());
			},

			onComplete: function(){
				var button = RokSprocket.CopyToClipboard.button,
					copyElement = RokSprocket.CopyToClipboard.copyElement;

				button.set('data-original-title', 'Copied!');
				button.retrieve('twipsy').show();
			}
		};

		this.RokSprocket.CopyToClipboard.init();

		// loadmore
		this.RokSprocket.more = {
			button: document.getElement('.load-more'),
			attach: function(){
				var button = RokSprocket.more.button,
					click = button.retrieve('roksprocket:loadmore:click', function(e){
						var next_page = RokSprocket.Paging.next_page,
							data = {page: next_page};

						if (e.shift) data.load_all = true;

						this.addClass('loader disabled');
						RokSprocket.articles.getItems(data);
					}),
					docDown = document.body.retrieve('roksprocket:loadmore:shift:down', function(e){
						button.addClass('load-all').getElement('span.text').set('text', 'load all');
					}),
					docUp = document.body.retrieve('roksprocket:loadmore:shift:up', function(e){
						button.removeClass('load-all').getElement('span.text').set('text', 'load more');
					});

				button.removeClass('disabled').addEvent('click', click);
				if (!document.body.retrieve('roksprocket:loadmore:attached'))
					document.body.store('roksprocket:loadmore:attached', true)
						.addEvent('keydown:keys(shift)', docDown)
						.addEvent('keyup', docUp);
			},
			detach: function(){
				var button = RokSprocket.more.button,
					click = button.retrieve('roksprocket:loadmore:click'),
					docDown = document.body.retrieve('roksprocket:loadmore:shift:down'),
					docUp = document.body.retrieve('roksprocket:loadmore:shift:up');

				button.addClass('disabled').removeEvent('click', click);
				document.body.store('roksprocket:loadmore:attached', false)
					.removeEvent('keydown:keys(shift)', docDown)
					.removeEvent('keyup', docUp);
			}
		};

		if (this.RokSprocket.more.button){
			RokSprocket.more.attach();
			if (RokSprocket.Paging.more) RokSprocket.more.button.removeClass('hide-load-more');
		}

		// tips for animations dropdown
		document.getElements('.animations-dropdown ! > .sprocket-dropdown li:not(.divider,[class^=random])').each(function(animation){
			var cls = animation.className.trim(),
				desc = '<div class="animations-tip-img"><i class="icon animation '+cls+'"></i></div>';

			animation.set('data-original-title', desc);
			animation.twipsy({placement: 'left', html: true});
		});

		document.getElements('.group_imageresize .group-label label').each(function(label){
			label.set('data-placement', 'above');
		});

		// fix for sort
		var sortElements = document.getElements('[id$=_sort]'),
			sortTypes = document.getElements('[id$=_manual_append]');

		if (sortElements.length && sortElements.length == sortTypes.length){
			sortTypes.each(function(select, i){
				var prefix = select.id.replace(/_manual_append$/, ''),
					sort = document.getElement('[id='+prefix+']'),

					sortType = select.getParent('li'),
					sortElement = sort.getParent('li'),

					ul = new Element('ul', {styles: {display: 'inline-block'}}).inject(sortElement);

				sortType.inject(ul);
				sortElement.getElements('label').setStyles({'margin-right': 5, width: 'auto'});
			});
		}
		// document.getElement('select.joomla_sort_manual').getParent('li').addClass('sorting-li');

		// twipsy tooltips
		$$(".sprocket-tip").twipsy({placement: 'left', offset: 5});
		$$('.hasTip').each(function(tip){
			tip.removeClass('hasTip').addClass('sprocket-tip');
			tip.set('title', tip.get('title').split('::').pop());
			tip.twipsy({placement: 'left', offset: 5, html: true});
		});


		// alerts close
		document.getElements('[data-dismiss]:not([data-dismiss=true])').each(function(action){
			var alert = action.getParent('.' + action.get('data-dismiss')) || action.getParent('#system-message-container').getElement('.' + action.get('data-dismiss'));

			if (alert.get('data-cookie')){
				if (Cookie.read(alert.get('data-cookie')) == 'hide') alert.setStyle('display', 'none');
			}

			action.addEvent('click', function(e){
				e.stop();

				var dismiss = action.get('data-dismiss'),
					wrapper = action.getParent('.' + dismiss) || action.getParent('#system-message-container').getElement('.' + dismiss);

				if (wrapper){
					action.dispose();
					wrapper.fx({opacity: 0}, {
						callback: function(){
							wrapper.dispose();
							Cookie.write(wrapper.get('data-cookie'), 'hide', {duration: 1, path: new URI(window.location.href).get('directory')});
						}
					});
				}
			});

		}, this);

		// toggler for per-items
		document.getElements('.articles-view-option li').each(function(button, i){
			button.addEvent('click', function(e){
				if (e) e.preventDefault();
				Cookie.write('roksprocket-showitems', i, {duration: 365, path: '/'});

				var items = document.getElements('.articles-view-option li'),
					articles = document.getElement('.articles');

				items.removeClass('active');
				items[i].addClass('active');
				articles[!i ? 'addClass' : 'removeClass']('hide-items');
			});
		});


	}.bind(this);

	jQuery(document).ready(this.RokSprocket.init);
	window.addEvent('load', function(){
		// fire the provider again
		if (!RokSprocket.content.getModuleId()) return;

		//document.getElement('.content_provider').fireEvent('change');

		RokSprocket.articles.fireEvent('onModelSuccess');

		// hooking up provider change event
		document.getElements('[data-refresher=true]').addEvent('change', function(){
			RokSprocket.filters.fireEvent('filtersChange');
		});
	});

// Browser.Engine fix
if (!Browser.Engine){
	if (Browser.Platform.ios) Browser.Platform.ipod = true;

	Browser.Engine = {};

	var setEngine = function(name, version){
		Browser.Engine.name = name;
		Browser.Engine[name + version] = true;
		Browser.Engine.version = version;
	};

	if (Browser.ie){
		Browser.Engine.trident = true;

		switch (Browser.version){
			case 6: setEngine('trident', 4); break;
			case 7: setEngine('trident', 5); break;
			case 8: setEngine('trident', 6);
		}
	}

	if (Browser.firefox){
		Browser.Engine.gecko = true;

		if (Browser.version >= 3) setEngine('gecko', 19);
		else setEngine('gecko', 18);
	}

	if (Browser.safari || Browser.chrome){
		Browser.Engine.webkit = true;

		switch (Browser.version){
			case 2: setEngine('webkit', 419); break;
			case 3: setEngine('webkit', 420); break;
			case 4: setEngine('webkit', 525);
		}
	}

	if (Browser.opera){
		Browser.Engine.presto = true;

		if (Browser.version >= 9.6) setEngine('presto', 960);
		else if (Browser.version >= 9.5) setEngine('presto', 950);
		else setEngine('presto', 925);
	}

	if (Browser.name == 'unknown'){
		switch ((ua.match(/(?:webkit|khtml|gecko)/) || [])[0]){
			case 'webkit':
			case 'khtml':
				Browser.Engine.webkit = true;
			break;
			case 'gecko':
				Browser.Engine.gecko = true;
		}
	}

	this.$exec = Browser.exec;
}

/* Ugly workaround for data-sets issue for IE < 9 on Moo < 1.4.4 */
if (MooTools.version < "1.4.4" && (Browser.name == 'ie' && Browser.version < 9)){
	((function(){
		var dataList = [
			'rel', 'data-toggle', 'data-text', 'data-icon', 'data-value', 'data-filter',
			'data-filter-action', 'data-filter-name', 'data-filter-container', 'data-selector',
			'data-row', 'data-tab', 'data-panel', 'data-dynamic', 'data-key', 'data-value',
			'data-name', 'data-other', 'data-dismiss', 'data-article-id', 'data-cookie',
			'data-flag', 'data-refresher', 'data-order', 'data-imagepicker', 'data-imagepicker-id',
			'data-imagepicker-name', 'data-imagepicker-display', 'data-provider-submit',
			'data-peritempicker', 'data-peritempicker-id', 'data-peritempicker-name',
			'data-peritempicker-display', 'data-placement'
		];

		dataList.each(function(data){
			Element.Properties[data] = {get: function(){ return this.getAttribute(data); }};
		});
	})());
}

/* Implement moo into Moo! */
/*
---
provides: MooTools
requires: [Core/Element, fx]
author: "[Valerio Proietti](http://mad4milk.net)"
license: "[MIT](http://mootools.net/license.txt)"
...
*/

Element.implement({

	fx: function(){
		var mu = moofx(this);
		mu.animate.apply(mu, arguments);
		return this;
	},

	styles: function(){
		var mu = moofx(this), result = mu.style.apply(mu, arguments);
		if (arguments.length == 1 && typeof arguments[0] == 'string') return result;
		return this;
	}

});

var hasOwnProperty = Object.prototype.hasOwnProperty;

Object.extend({
	getFromPath: function(source, parts){
		if (typeof parts == 'string') parts = parts.split('.');
		for (var i = 0, check, l = parts.length; i < l; i++){
			if (!source) source = null;
			else if (hasOwnProperty.call(source, parts[i])) source = source[parts[i]];
			else return null;
		}

		return source;
	}
});

})());


