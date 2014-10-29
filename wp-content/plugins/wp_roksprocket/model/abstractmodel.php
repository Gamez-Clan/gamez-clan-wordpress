<?php
/**
 * @version   $Id: abstractmodel.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Model_AbstractModel
{
	/**
	 *
	 */
	const MAIN_TABLE = 'roksprocket';
	/**
	 *
	 */
	const ITEMS_TABLE = 'roksprocket_items';

	/**
	 * @var wpdb
	 */
	protected $db;

	/**
	 *
	 */
	public function __construct()
	{
		global $wpdb;
		$this->db = $wpdb;
	}

	/**
	 * @return string
	 */
	public function getLastError()
	{
		return $this->db->last_error;
	}
}
