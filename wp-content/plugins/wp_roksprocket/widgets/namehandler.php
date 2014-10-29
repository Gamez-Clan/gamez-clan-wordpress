<?php
/**
 * @version   $Id: namehandler.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Widgets_NameHandler implements RokCommon_Form_IItemNameHandler
{
	protected $instance;

	public function setInstance($instance)
	{
		$this->instance = $instance;
	}

	public function getInstance()
	{
		return $this->instance;
	}

	/**
	 *
	 * @param string       $name
	 * @param string       $group
	 * @param string|null  $formcontrol
	 * @param bool         $multiple
	 *
	 * @return string the name to use for the html tag
	 */
	public function getName($name, $group = null, $formcontrol = null, $multiple = false)
	{
		return 'widget-' . $this->instance['id_base'] . '[' . $this->instance['number'] . '][' . $name . ']';
	}

	/**
	 *
	 * @param string       $name
	 * @param string|null  $id
	 * @param string       $group
	 * @param string|null  $formcontrol
	 * @param bool         $multiple
	 *
	 * @return string the id to use for the html tag
	 */
	public function getId($name, $id = null, $group = null, $formcontrol = null, $multiple = false)
	{
		return 'widget-' . $this->instance['id_base'] . '-' . $this->instance['number'] . '-' . $name;
	}
}
