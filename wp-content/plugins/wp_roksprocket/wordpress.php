<?php
/**
 * @version   $Id: wordpress.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Wordpress extends RokSprocket
{
	public function __construct(RokCommon_Registry $params)
	{
		parent::__construct($params);
		/** @var $platforminfo RokCommon_IPlatformInfo */
		$platforminfo = $this->container->getService('platforminfo');
		$this->context_base = self::BASE_PACKAGE_NAME;
		RokCommon_Composite::addPackagePath($this->context_base, $platforminfo->getRootPath() . '/wp-content/plugins/wp_roksprocket', 10);
		RokCommon_Composite::addPackagePath($this->context_base, $this->container['roksprocket.template.override.path'], 20);
	}

	/**
	 * @return RokSprocket_ItemCollection
	 */
	public function getData()
	{
		$items = RokSprocket::getItemsWithParams($this->params->get('module_id'), $this->params, true);
		$limit = $this->params->get('display_limit', '∞');
		if ($limit != '∞' && (int)$limit > 0) {
			$items = $items->trim($limit);
		}
		return $items;
	}


	public function renderGlobalHeaders($ajax_path = null)
	{
		if (is_null($ajax_path)) {
			// TODO make this the proper ajax path
			$ajax_path = '/wp-admin/admin-ajax.php?action=roksprocket_fe';
		}
		parent::renderGlobalHeaders($ajax_path);
	}

}
