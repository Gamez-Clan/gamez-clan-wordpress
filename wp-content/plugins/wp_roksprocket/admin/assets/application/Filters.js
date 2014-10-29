/*!
 * @version   $Id: Filters.js 11781 2013-06-26 21:40:26Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
((function(){
	if (typeof this.RokSprocket == 'undefined') this.RokSprocket = {};

	var OnInputEvent = (Browser.name == 'ie' && Browser.version <= 9) ? 'keypress' : 'input';

	Element.implement({
		filtersQueryString: function(){
			var queryString = [];
			this.getElements('input:not([data-selector]), select:not([data-selector]), textarea:not([data-selector])').each(function(el){
				var type = el.type;
				if (!el.name || el.disabled || type == 'submit' || type == 'reset' || type == 'file' || type == 'image') return;

				var value = (el.get('tag') == 'select') ? el.getSelected().map(function(opt){
					// IE
					return document.id(opt).get('value');
				}) : ((type == 'radio' || type == 'checkbox') && !el.checked) ? null : el.get('value');

				Array.from(value).each(function(val){
					if (typeof val != 'undefined') queryString.push(encodeURIComponent(el.name) + '=' + encodeURIComponent(val));
				});
			});
			return queryString.join('&');
		},

		filtersQueryObject: function(){
			return decodeURIComponent(this.filtersQueryString()).parseQueryString();
		},

		restoreEvents: function(events){
			events = events || {};

			if (Object.getLength(events)) this.removeEvents();

			Object.each(events, function(event, type){
				var keys = event['keys'];
				keys.each(function(fn){
					this.addEvent(type, fn);
				}, this);
			}, this);

			return this;
		}
	});

	this.Filters = new Class({

		Implements: [Options, Events],

		options: {
			/*
				onBeforeAttach: function(elements, type){},
				onAfterAttach: function(elements, type){},
				onBeforeDetach: function(elements, type){},
				onAfterDetach: function(elements, type){},
				onBeforeAttachRow: function(selectors, actions){},
				onAfterAttachRow: function(selectors, actions){},
				onBeforeDetachRow: function(selectors, actions){},
				onAfterDetachRow: function(selectors, actions){},
				onAddRow: function(row){},
				onRemoveRow: function(){},
				onBeforeFilterChange: function(){},
				onFilterChange: function(row, chunk, render, dataset){},
				onBeforeFiltersChange: function(){},
				onFiltersChange: function(provider, filters){}
			*/
		},

		dataSets: {},

		initialize: function(options){
			this.setOptions(options);

			this.containers = document.getElements('[data-filter]');

			this.containers.each(function(container){
				var rows = container.getElements('[data-row=true]'),
					actions = container.getElements('[data-filter-action]');

				this.attachRows(rows, 'dontfire');
				this.attach(actions, 'action');
			}, this);

		},

		attach: function(elements, type, silent){
			elements = Array.from(elements);

			this.fireEvent('beforeAttach', [elements, type]);

			elements.each(function(element){
				if (!element.retrieve('roksprocket:filters:element:attached')) {
					element.store('roksprocket:filters:element:attached', true);
					var click = element.retrieve('roksprocket:filters:events:' + type, function(event){
						this[element.get('data-filter-' + type)].call(this, event, element, type);
					}.bind(this));

					element.addEvent('click', click);
				}
			}, this);

			this.fireEvent('afterAttach', [elements, type]);
		},

		detach: function(elements, type, silent){
			elements = Array.from(elements);

			this.fireEvent('beforeDetach', [elements, type]);

			elements.each(function(element){
				if (element.retrieve('roksprocket:filters:element:attached')) {
					element.store('roksprocket:filters:element:attached', false);
					var click = element.retrieve('roksprocket:filters:events:' + type);

					element.removeEvent('click', click);
				}
			}, this);

			this.fireEvent('beforeDetach', [elements, type]);
		},

		attachRow: function(row, nofire, silent){
			var actions = row.getElements('[data-filter-action]'),
				selectors = row.getElements('[data-selector=true]').filter(function(selector){
					return !selector.retrieve('roksprocket:filters:selector:attached');
				}),
				inputs = row.getElements('input[name], select:not([data-selector])'),
				links = row.getElements('a');

			this.fireEvent('beforeAttachRow', [selectors, actions]);

			selectors.each(function(selector){
				selector.store('roksprocket:filters:selector:attached', true);

				var change = selector.retrieve('roksprocket:filters:events:selector', function(event){
					this.changeFilter.call(this, event, selector);
				}.bind(this));

				selector.addEvent('change', change).set('disabled', null);
				if (typeof nofire == 'undefined') change();
				if (selector.getChildren().length == 1) selector.setStyle('display', 'none');
			}, this);

			inputs.each(function(input){
				input.store('roksprocket:filters:input:attached', true);

				var change = input.retrieve('roksprocket:filters:events:input', function(event){
					this.changeRowValue.call(this, event, input);
				}.bind(this)),
					eventType = (input.get('tag') == 'select') ? 'change' : OnInputEvent;

				input.addEvent(eventType, change).set('disabled', null);
				if (typeof nofire == 'undefined') change();
			}, this);

			links.each(function(link){
				var storage = 'roksprocket:filters:element:',
					events = link.retrieve(storage + 'attached:events', {});

				link.store(storage + 'attached', true);
				if (Object.getLength(events)) link.restoreEvents(events);
			}, this);

			this.attach(actions, 'action', silent);
			if (!silent) row.removeClass('detached');

			this.fireEvent('afterAttachRow', [selectors, actions]);
		},

		attachRows: function(rows, nofire, silent){
			rows.each(function(row){
				this.attachRow(row, nofire, silent);
			}, this);
		},

		detachRow: function(row, silent){
			var actions = row.getElements('[data-filter-action]'),
				selectors = row.getElements('[data-selector=true]').filter(function(selector){
					return selector.retrieve('roksprocket:filters:selector:attached');
				}),
				inputs = row.getElements('input[type=text], select:not([data-selector])'),
				links = row.getElements('a');

			this.fireEvent('beforeDetachRow', [selectors, actions]);

			selectors.each(function(selector){
				selector.store('roksprocket:filters:selector:attached', false);

				var change = selector.retrieve('roksprocket:filters:events:selector');
				selector.removeEvent('change', change);
				if (!silent) selector.set('disabled', 'disabled');
			}, this);

			inputs.each(function(input){
				input.store('roksprocket:filters:input:attached', false);

				var change = input.retrieve('roksprocket:filters:events:input'),
					eventType = (input.get('tag') == 'select') ? 'change' : OnInputEvent;
				input.removeEvent(eventType, change);
				if (!silent) input.set('disabled', 'disabled');
			}, this);

			links.each(function(link){
				var storage = 'roksprocket:filters:element:';
				if (link.retrieve(storage + 'attached')) link.store(storage + 'attached:events', Object.clone(link.retrieve('events')));
				link.store(storage + 'attached', false);
				link.removeEvents().addEvent('click', function(e){ e.stop(); });
			}, this);

			this.detach(actions, 'action', silent);
			if (!silent) row.addClass('detached');

			this.fireEvent('AfterDetachRow', [selectors, actions]);
		},

		detachRows: function(rows, nofire, silent){
			rows.each(function(row){
				this.detachRow(row, nofire, silent);
			}, this);
		},

		attachFilter: function(filterType, silent){
			var containerPosition = this.containers.get('data-filter').indexOf(filterType);
			if (containerPosition == '-1') return;

			var container = this.containers[containerPosition],
				rows = container.getElements('[data-row=true]'),
				actions = container.getElements('[data-filter-action]');

			this.attachRows(rows, 'dontfire', silent);
			this.attach(actions, 'action', silent);
		},

		detachFilter: function(filterType, silent){
			var containerPosition = this.containers.get('data-filter').indexOf(filterType);
			if (containerPosition == '-1') return;

			var container = this.containers[containerPosition],
				rows = container.getElements('[data-row=true]'),
				actions = container.getElements('[data-filter-action]');

			this.detachRows(rows, 'dontfire', silent);
			this.detach(actions, 'action', silent);
		},

		attachAll: function(silent){
			this.containers.each(function(container){
				this.attachFilter(container.get('data-filter'), silent);
			}, this);

			this.detached = false;
		},

		detachAll: function(silent){
			this.containers.each(function(container){
				this.detachFilter(container.get('data-filter'), silent);
			}, this);

			this.detached = true;
		},

		addRow: function(event, element, action){
			if (!Object.getLength(this.dataSets)) return;
			var parent = element.getParent('.create-new'),
				container = element.getParent('[data-filter]'),
				id = container.get('data-filter'),
				row = new Element('div', {html: this.dataSets[id].template}).getFirst(),
				wrapper = element.getParent('[data-row=true]') || parent;

			if (parent) container.removeClass('empty');

			var filtersContainer = row.getElement('[data-filter-container]');
			if (filtersContainer){
				var chunkBit = Array.from({chunk: this.dataSets[id].json.root}),
					assembled = this.assemble(chunkBit, this.render(id, chunkBit, row), row),
					render = assembled.html;
				filtersContainer.set('html', render);

				if (container.getChildren().length <= 1) row.addClass('first');

				row.set('data-row', true).inject(wrapper, 'after');
				this.updateRowNames(row);
				this.refreshRowNames(container);

				if (assembled.js){
					(function(){
						assembled.js = this.parseJavaScript(assembled.js, render);
						var evil = eval(assembled.js),
							link = render.getElement('a');

						link.store('roksprocket:filters:element:attached', true);
						link.removeClass('disabled');
						if (typeof evil == 'function') evil();
					}.bind(this).delay(10));
				}

				this.attachRow(row);
				this.fireEvent('addRow', row);
				// probably don't need this since we fire input/selects events already, when adding a row
				//this.fireEvent('filtersChange', [id, this.getFilters(id)]);
			}

		},

		removeRow: function(event, element, action){
			var row = element.getParent('[data-row=true]'),
				parent = element.getParent('[data-filter]'),
				id = parent.get('data-filter'),
				first = row.hasClass('first');

			if (first && row.getNext()) row.getNext().addClass('first');
			this.detachRow(row);
			row.dispose();

			if (parent.getChildren().length <= 1) parent.addClass('empty');

			this.refreshRowNames(parent);

			this.fireEvent('removeRow');
			this.fireEvent('filtersChange', [id, this.getFilters(id)]);
		},

		empty: function(id){
			var container = this.containers.filter(function(container){
				return container.get('data-filter') == id;
			});

			var rows = container.getElements('[data-row=true]');
			rows.each(function(row){
				this.detachRow(row);
				row.dispose();
			}, this);

			container.addClass('empty');
		},

		updateRowNames: function(row){
			var elements = row.getElements('[data-key]');
			elements.each(function(element){
				var name = element.get('name'),
					dataName;

				if (name == '|name|'){
					var parent = element.getParent('[data-filter-name]'),
						child = element.getParent('[data-row=true]'),
						filterName = parent.get('data-filter-name'),
						dataKey = element.get('data-key'),
						chunk = element.getParent('.chunk');

					var previous = chunk.getElement('!~ .chunk');

					if (!previous) element.set('name', filterName + '[0]' + '[' + dataKey + ']');
					else {
						var inherit = previous.getElement('[data-key]'),
							naming = inherit.get('name') + '[' + inherit.get('value') + ']';
						element.set('name', naming);
						if (element.get('data-value')) element.set('name', naming + '['+element.get('data-value')+']');
					}

					dataName = chunk.getElement('[data-name]');
					if (dataName){
						dataName.set('data-name', element.get('name'));

						if (dataName.get('id') == '|name|') dataName.set('id', dataName.get('data-name').replace(/\[|\]/g, ""));
						var links = chunk.getElements('[href*=|name|]');
						if (links.length) links.each(function(link){
							link.set('href', link.get('href').replace(/\|name\|/g, function(match, position){
								return dataName.get('data-name');
							}));
						}, this);

					}

				}

			});
		},

		refreshRowNames: function(container){
			var rows = container.getElements('[data-row=true]');

			rows.each(function(row, i){
				row.getElements('[data-key]').each(function(element){
					var name = element.get('name');
					name = name.replace(/\[(\d{1,})\]/, '['+(i+1)+']');

					element.set('name', name);

					if (element.get('data-name')){
						var chunk = element.getParent('.chunk'),
							links = chunk.getElements('a');

						links.each(function(link){
							var dataName = element.get('data-name'),
								newName = name.replace(/\[|\]/g, ""),
								href = link.get('href');

							href = href.replace(dataName, newName);
							link.set('href', href);
						});

						if (element.get('id')) element.set('id', name.replace(/\[|\]/g, ""));
						element.set('data-name', name);
					}
				}, this);
			}, this);
		},

		changeRowValue: function(event, element){
			this.fireEvent('onBeforeFiltersChange');

			if (this.detached) return;

			clearTimeout(this.timer);
			var parent = element.getParent('[data-filter]'),
				id = parent.get('data-filter');

			// let's delay a little bit the fireEvent so it will only fire once
			// in case of multiple values changes in a row
			var timer = function(){
				this.fireEvent('filtersChange', [id, this.getFilters(id)]);
			}.bind(this);

			this.timer = timer.delay(10, this);
		},

		changeFilter: function(event, element){
			this.fireEvent('onBeforeFiltersChange');

			if (this.detached) return;

			var chunk = element.get('class').replace(/\schzn-done/, ''),
				value = element.get('value'),
				container = element.getParent('[data-filter]'),
				id = container.get('data-filter'),
				dataset = this.dataSets[id].json[chunk];

			var row = element.getParent('[data-row=true]'),
				chunkBit = this.getChunk(id, dataset.selections[value].render),
				assembled = this.assemble(chunkBit, this.render(id, chunkBit, row), row),
				html = new Element('div', {html: assembled.html}),
				wrapper = element.getParent('.chunk'),
				render = html.getFirst();

			wrapper.getElements('~ .chunk').dispose();
			render.inject(wrapper, 'after');
			this.updateRowNames(row);

			if (assembled.js){
				(function(){
					assembled.js = this.parseJavaScript(assembled.js, render);
					var evil = eval(assembled.js),
						link = render.getElement('a');

					link.store('roksprocket:filters:element:attached', true);
					link.removeClass('disabled');
					if (typeof evil == 'function') evil();
				}.bind(this).delay(10));
			}

			this.attachRow(row);

			this.fireEvent('filterChange', [row, chunk, render, dataset]);
		},

		getFilters: function(provider){
			var container = document.getElement('[data-filter*=' + provider + ']');

			if (!container) return null;

			var object = Object.getFromPath(
					container.filtersQueryObject(),
					container.get('data-filter-name').replace(/\]\[|\[/g, '.').replace(']', '')
				);

			return {element: container, object: object, json: JSON.encode(object || {})};
		},

		parseJavaScript: function(js, render){
			// replaces %ID% with name without [ and ]
			var dataName = render.getElement('[data-name]');
			if (dataName) js = js.replace(/%ID%/g, dataName.get('data-name').replace(/\[|\]/g, ""));

			return js;
		},

		getChunk: function(id, render){
			var match = render.match(/\|[^|]+\|/g),
				chunks = [];

			if (match){
				match = match.join('').split('|').filter(function(item){ return item !== ""; });
				match.each(function(chunk){
					var split = chunk.split(':'),
						dataset = this.dataSets[id].json[split[0]],
						find = '|' + match.join('| |') + '|';

					if (split[1]) Array.push(chunks, {value: split[1], find: find, render: render, chunk: dataset});
					else Array.push(chunks, {find: find, render: render, chunk: dataset});

				}, this);
			}

			return chunks;
		},

		assemble: function(chunks, render, row){
			var div, js = null;

			chunks.each(function(chunk, i){
				if (chunk.chunk.javascript !== null){
					js = chunk.chunk.javascript.replace(/\\?\%([^%]+)\%/g, function(match, selector){
						if (match.charAt(0) == '\\') return match.slice(1);

						return (match === '%ID%') ? '%ID%' : 'row.getElements("' + selector + '")';
					});
				}

				if (chunk.value){
					if (!div) div = new Element('div', {html: render});

					var elements = div.getElements('[data-key]');
					if (elements && elements[i]){
						elements[i].set('data-value', chunk.value);
					}
				}
			}, this);

			return {html: (div) ? div.innerHTML : render, js: js};
		},

		render: function(id, bits, row){
			var chunk, render, html = '<span class="chunk">';

			bits.each(function(bit){
				chunk = bit.chunk;

				if (chunk){
					html += (bit.find && bit.render) ? bit.render.replace(bit.find, chunk.render) : chunk.render;
				}
			}, this);

			return html + '</span>';
		},

		/*addDataSet: function(key, json){
			var model = this.model;
			if (!this.model || this.model.isRunning){
				model = new Request({
					url: RokSprocket.URL,
					data: {model: 'filters', action: 'getFilters', params: {}},
					onRequest: this.onModelRequest.bind(this),
					onSuccess: this.onModelSuccess.bind(this)
				});
			}

			this.setParams(Object.merge(json, {key: key, template: json.template}), model).send();
		},*/

		addDataSets: function(list, template){
			var model = this.model;

			this.template = template || '';
			if (!this.model || this.model.isRunning){
				model = new Request({
					url: RokSprocket.URL,
					data: {model: 'filters', model_action: 'getFilters', params: {}},
					onRequest: this.onModelRequest.bind(this),
					onSuccess: this.onModelSuccess.bind(this)
				});
			}

			this.setParams({filters: list}, model).send();
		},

		onModelRequest: function(){
			this.fireEvent('modelRequest');
		},

		onModelSuccess: function(response){
			response = new Response(response, {onError: this.error.bind(this)});

			var json = response.getPath('payload.json'),
				key = response.getPath('payload.key'),
				template = response.getPath('payload.template');

			if (json !== null){
				Object.each(json, function(data, key){
					if (!this.dataSets) this.dataSets = {};
					this.dataSets[key] = {};
					this.dataSets[key].template = this.template;
					this.dataSets[key].json = JSON.decode(data);
				}, this);
			}

			this.fireEvent('modelSuccess', response);
		},

		setParams: function(params, model){
			var data = Object.merge(model.options.data, {params: params || {}});

			data.params = JSON.encode(data.params);

			return model.setOptions(data);
		},

		error: function(message){
			RokSprocket.modal.set({
				kind: 'rserror',
				title: 'Error',
				type: ['close', {labels: {close: 'Close'}}],
				body: '<p>Error while retrieving the Filters DataSet:</p>' + '<p><pre>' + message + '</pre></p>'
			}).show();
		}

	});

})());
