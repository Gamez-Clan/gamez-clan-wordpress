<?php

/**
 * @version   $Id: view.php 22593 2014-08-08 14:46:31Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
class RokSprocket_Views_Edit_View implements RokSprocket_Views_IView
{

	/**
	 * @var mixed|string
	 */
	protected $id;
	/**
	 * @var mixed|string
	 */
	protected $provider;
	/**
	 * @var mixed|string
	 */
	protected $search;
	/**
	 * @var mixed|string
	 */
	protected $paged;
	/**
	 * @var mixed|string
	 */
	protected $orderby;
	/**
	 * @var mixed|string
	 */
	protected $order;
	/**
	 * @var string
	 */
	protected $context;
	/**
	 * @var
	 */
	protected $nonce;
	/**
	 * @var RokSprocket_Model_Object_Widget
	 */
	protected $data;
	/**
	 * @var RokCommon_Form
	 */
	protected $form;
	/**
	 * @var array
	 */
	protected $articles = array();
	/**
	 * @var RokSprocket_ConfigForm
	 */
	protected $perItemForm;
	/**
	 * @var
	 */
	protected $showitems;
	/**
	 * @var
	 */
	protected $total_articles;

	/**
	 * @param null $instance
	 *
	 * @return \RokSprocket_Views_Edit_View
	 */
	public function __construct($instance = null)
	{
		$this->nonce    = wp_create_nonce('roksprocket-ajax-nonce');
		$this->id       = RokSprocket_Request::getInt('id', 0);
		$this->provider = RokSprocket_Request::getString('provider', '');
		$this->search   = RokSprocket_Request::getString('search', '');
		$this->paged    = RokSprocket_Request::getInt('paged', 1);
		$this->orderby  = RokSprocket_Request::getString('orderby', 'title');
		$this->order    = RokSprocket_Request::getString('order', 'ASC');

		$link_args = array();
		if ($this->orderby) $link_args['orderby'] = $this->orderby;
		if ($this->order) $link_args['order'] = $this->order;
		if ($this->provider) $link_args['provider'] = $this->provider;
		if ($this->paged) $link_args['paged'] = $this->paged;
		if ($this->search) $link_args['search'] = '%' . $this->search . '%';

		//build the back_url
		$this->base_url = site_url() . '/wp-admin/admin.php?page=roksprocket-edit&nonce=' . $this->nonce;
		$this->list_url = RokCommon_URL::updateParams(site_url() . '/wp-admin/admin.php?page=roksprocket-list&nonce=' . $this->nonce, $link_args);
		$this->ajax_url = site_url() . '/wp-admin/admin-ajax.php?action=roksprocket_ajax&nonce=' . $this->nonce;
		$this->siteURL  = site_url();
		$this->adminURL = site_url() . '/wp-admin/';

		// Read cookie for showing/hide per-article items
		if (!isset($_COOKIE['roksprocket-showitems'])) {
			$showitems_cookie = 1;
			setcookie("roksprocket-showitems", $showitems_cookie, time() + 60 * 60 * 24 * 365, '/');
		} else {
			$showitems_cookie = $_COOKIE['roksprocket-showitems'];
		}

		$this->showitems = (bool)$showitems_cookie;

		$this->container = RokCommon_Service::getContainer();
		$this->context   = 'rs_templates.edit';
		$this->toolbar   = $this->getToolbar($this->base_url, $this->list_url);
	}

	/**
	 * @return array
	 */
	protected function getToolbar($base_url, $list_url)
	{
		$buttons = array();

		$buttons[] = array(
			'input' => false,
			'title' => 'Close',
			'image' => 'icon-32-close.png',
			'class' => 'icon-32-close',
			'id'    => 'toolbar-close',
			'link'  => $list_url
		);
		$buttons[] = array(
			'input'     => false,
			'title'     => 'Save As Copy',
			'image'     => 'icon-32-saveascopy.png',
			'class'     => 'icon-32-saveascopy',
			'id'        => 'toolbar-saveascopy',
			'link'      => '#',
			'data_save' => 'saveascopy'
		);
		$buttons[] = array(
			'input'     => false,
			'title'     => 'Save & New',
			'image'     => 'icon-32-savenew.png',
			'class'     => 'icon-32-savenew',
			'id'        => 'toolbar-savenew',
			'link'      => '#',
			'data_save' => 'saveandnew'
		);
		$buttons[] = array(
			'input'     => false,
			'title'     => 'Save & Close',
			'image'     => 'icon-32-.png',
			'class'     => 'icon-32-saveclose',
			'id'        => 'toolbar-saveclose',
			'link'      => '#',
			'data_save' => 'saveandclose'
		);
		$buttons[] = array(
			'input'       => false,
			'title'       => 'Save',
			'image'       => 'icon-32-save.png',
			'class'       => 'icon-32-save',
			'id'          => 'toolbar-save',
			'link'        => '#',
			'extra_class' => 'save btn-primary',
			'data_save'   => 'save'
		);

		return $buttons;

	}

	/**
	 * @param $name
	 *
	 * @return null
	 */
	public function __get($name)
	{
		if (isset($this->$name)) {
			return $this->$name;
		}
		return null;
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	/**
	 * @return \RokSprocket_Model_Object_Widget
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param \RokSprocket_Model_Object_Widget $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 *
	 */
	public function initialize()
	{
		$this->form = new RokCommon_Form('jform');
		$this->form->loadFile(dirname(__FILE__) . '/base.xml', false, '//form');
		$this->processModuleConfig($this->form, $this->data);
		if (!isset($this->data)) {
			$this->data = new RokSprocket_Model_Object_Widget();
		}
		if ((int)$this->id == 0) {
			$this->data->setUuid(RokCommon_UUID::generate());
		} else {
			$this->data->setUuid(0);
		}
		$this->form->bind(array_merge($this->data->toArray(), array('uuid' => $this->data->getUuid())));
		$this->form->initialize();
	}

	/**
	 * @param RokCommon_Form $form
	 */
	protected function processModuleConfig(RokCommon_Form $form, $data)
	{
		$container = RokCommon_Service::getContainer();
		$options   = new RokCommon_Options();

		$section = new RokCommon_Options_Section('roksprocket_module', 'module_config.xml');
		$section->addPath(dirname(__FILE__));
		$section->addPath($container['roksprocket.template.override.path']);
		$options->addSection($section);

		$this->provider = 'wordpress';
		$this->layout   = 'tabs';
		if (isset($data)) {
			$provider = $this->provider = $data->params->get('provider', 'wordpress');
			$layout   = $this->layout = $data->params->get('layout', 'tabs');
			if (isset($provider) && isset($layout)) {
				// load up the Providers
				$provider_key = "roksprocket.providers.registered.{$provider}";
				if ($container->hasParameter($provider_key)) {
					$providerinfo   = $container->getParameter($provider_key);
					$provider_class = $container[sprintf('roksprocket.providers.registered.%s.class', $provider)];
					$available      = call_user_func(array($provider_class, 'isAvailable'));
					if ($available) {
						$section = new RokCommon_Options_Section('provider_' . $provider, $providerinfo->optionfile);
						$section->addPath($providerinfo->path);
						$options->addSection($section);
					}
				}

				// load up the layouts
				/** @var $i18n RokCommon_I18N_Wordpress */
				$i18n = $container->i18n;

				// load up the layouts
				$layout_key = "roksprocket.layouts.{$layout}";

				if ($container->hasParameter($layout_key)) {
					$layoutinfo = $container->getParameter($layout_key);
					$section    = new RokCommon_Options_Section('layout_' . $layout, $layoutinfo->options->file);

					foreach ($layoutinfo->paths as $layoutpath) {
						if (is_dir($layoutpath . '/language')) {
							rs_load_plugin_textdomain('wp_roksprocket_layout_' . $layout, $layoutpath . '/language');
						}
						$section->addPath($layoutpath);
					}
					$options->addSection($section);
					$i18n->addDomain('wp_roksprocket_layout_' . $layout);

					$section = new RokCommon_Options_Section('layout_' . $layout, $layoutinfo->options->file);
					foreach ($layoutinfo->paths as $layoutpath) {
						$section->addPath($layoutpath);
					}
					$options->addSection($section);
				}
			}
		}

		$xml       = $options->getJoinedXml();
		$jxml      = new RokCommon_XMLElement($xml->asXML());
		$fieldsets = $jxml->xpath('/config/fields[@name = "params"]/fieldset');
		foreach ($fieldsets as $fieldset) {
			$overwrite = ((string)$fieldset['overwrite'] == 'true') ? true : false;
			$form->load($fieldset, $overwrite, '/config');
		}
	}

	/**
	 *
	 */
	public function renderHeader()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_style('thickbox');
		add_thickbox();

		$this->compileJS();
		$this->compileLess();
		RokCommon_Header::addStyle(RokCommon_Composite::get('rc_context_path')->getURL('RokCommon/Form/Fields/assets/filter/css/datepicker.css'));
	}

	/**
	 *
	 */
	protected function compileJS()
	{
		if (defined('ROKSPROCKET_DEV') && ROKSPROCKET_DEV) {
			$buffer = "";
			RokCommon_Composite::addPackagePath('rokcommon_form_field_assets', ROKSPROCKET_ASSETS_DIR, 75);

			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.js')->get('moofx.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('RokSprocket.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Tabs.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Dropdowns.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Filters.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Articles.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Response.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Twipsy.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Popover.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Modal.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.application')->get('Flag.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.imagepicker.js')->get('imagepicker.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.peritempicker.js')->get('peritempicker.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.peritempickertags.js')->get('peritempickertags.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.tags.js')->get('resizable-textbox.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.tags.js')->get('tags.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.multiselect.js')->get('multiselect.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.filters.js')->get('Picker.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.filters.js')->get('Picker.Attach.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.filters.js')->get('Picker.Date.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.js')->get('joomla-calendar.js');
			$files[] = RokCommon_Composite::get('rokcommon_form_field_assets.js')->get('ZeroClipboard.js');

			foreach ($files as $file) {
				$content = false;
				if (file_exists($file)) $content = file_get_contents($file);
				$buffer .= (!$content) ? "\n\n !!! File not Found: " . $file . " !!! \n\n" : $content;
			}
			file_put_contents(ROKSPROCKET_ASSETS_DIR . '/js/roksprocket.js', $buffer);
		}

		RokCommon_Header::addScript(RokCommon_Composite::get('rs_admin_assets.js')->getURL('roksprocket.js'));
		/*
			To keep track of the ordering
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/js/moofx.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/RokSprocket.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Tabs.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Dropdowns.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Filters.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Articles.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Response.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Twipsy.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Popover.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Modal.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/application/Flag.js');
		RokCommon_Header::addScript($siteURL. '/components/com_roksprocket/fields/imagepicker/js/imagepicker.js');
		RokCommon_Header::addScript($siteURL. '/components/com_roksprocket/fields/peritempicker/js/peritempicker.js');
		RokCommon_Header::addScript($siteURL. '/components/com_roksprocket/fields/tags/js/resizable-textbox.js');
		RokCommon_Header::addScript($siteURL. '/components/com_roksprocket/fields/tags/js/tags.js');
		RokCommon_Header::addScript($siteURL. '/components/com_roksprocket/fields/multiselect/js/multiselect.js');
		RokCommon_Header::addScript($siteURL. '/components/com_roksprocket/fields/filters/js/Picker.js');
		RokCommon_Header::addScript($siteURL . '/components/com_roksprocket/fields/filters/js/Picker.Attach.js');
		RokCommon_Header::addScript($siteURL . '/components/com_roksprocket/fields/filters/js/Picker.Date.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/js/joomla-calendar.js');
		RokCommon_Header::addScript($adminURL . '/components/com_roksprocket/assets/js/ZeroClipboard.js');
		*/
	}

	/**
	 * @throws exception
	 */
	protected function compileLess()
	{

		if (defined('ROKSPROCKET_DEV') && ROKSPROCKET_DEV) {
			try {
				$css_file = ROKSPROCKET_ASSETS_DIR . '/styles/roksprocket.css';
				@unlink($css_file);
				/** @var $less RokCommon_Less_Compiler */
				$less = $this->container->getService('less.compiler');
				$less->checkedCompile(ROKSPROCKET_ASSETS_DIR . '/less/global.less', $css_file);
			} catch (exception $e) {
				// TODO handle bad less compile
				throw $e;
			}
		}
		RokCommon_Header::addStyle(RokCommon_Composite::get('rs_admin_assets.styles')->getURL('roksprocket.css'));
	}

	/**
	 *
	 */
	public function renderInlines()
	{
		/** @var $platforminfo RokCommon_IPlatformInfo */
		$platforminfo    = $this->container->getService('platforminfo');
		$load_more_total = count($this->articles);
		$limit           = 10;
		if ($load_more_total > $limit) {
			$this->articles = $this->articles->trim($limit);
			$load_more      = 'true';
		} else {
			$load_more = 'false';
		}
		$load_more_script = sprintf('RokSprocket.Paging = {more: %s, page: 1, next_page: 2, amount: %d};', $load_more, $load_more_total);
		RokCommon_Header::addInlineScript("RokSprocket.params = 'params'; RokSprocket.URL = '" . $platforminfo->getRootUrl() . "/wp-admin/admin-ajax.php?action=roksprocket&nonce=" . $this->nonce . "'; RokSprocket.SiteURL = '" . $platforminfo->getRootUrl() . "';" . $load_more_script);
	}

	/**
	 *
	 */
	public function render()
	{
		ob_start();
		$container = RokCommon_Service::getContainer();
		if (isset($this->data)) {
			$template_path_param = sprintf('roksprocket.providers.registered.%s.templatepath', strtolower($this->data->getParams()->get('provider', 'wordpress')));
			if ($container->hasParameter($template_path_param)) {
				RokCommon_Composite::addPackagePath('rs_templates', $container->getParameter($template_path_param), 30);
			}
		}
		echo RokCommon_Composite::get($this->context)->load('edit.php', array('that' => $this));
		echo ob_get_clean();
	}

}
