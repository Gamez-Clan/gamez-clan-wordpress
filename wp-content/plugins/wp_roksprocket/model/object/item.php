<?php
/**
 * @version   $Id: item.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Model_Object_Item extends RokSprocket_Model_Object_Abstract
{

	/**
	 * @var string
	 */
	protected $_tbl = 'roksprocket_items';
	/**
	 * @var string
	 */
	protected $_tbl_key = 'id';

	/**
	 * @var int
	 */
	protected $id = 0;

    /**
     * @var
     */
    protected $widget_id;

    /**
     * @var
     */
    protected $displayed_ids;


    /**
     * @var
     */
    protected $provider;

    /**
     * @var
     */
    protected $provider_id;

    /**
     * @var
     */
    protected $order;

	/**
	 * @var RokCommon_Registry
	 */
	protected $params;

	/**
	 * @param RokSprocket_Model_Object_Widget
	 *
	 * @return \RokSprocket_Model_Object_Widget
	 */
	public static function genereateFromArray($array)
	{
		$instance = new self();
		$instance->bind($array);
		return $instance;
	}


	/**
	 * @param array  $array
	 *
	 * @param string $ignore
	 *
	 * @return bool
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params'])) {
			if (get_magic_quotes_gpc()) {
				$array['params'] = self::_stripSlashesRecursive($array['params']);
			}
			$registry = new RokCommon_Registry;
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}
		return parent::bind($array, $ignore);
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

    /**
     * @param $order
     */
    public function setOrder($order)
	{
		$this->order = $order;
	}

    /**
     * @return mixed
     */
    public function getOrder()
	{
		return $this->order;
	}

    /**
     * @param $provider
     */
    public function setProvider($provider)
	{
		$this->provider = $provider;
	}

    /**
     * @return mixed
     */
    public function getProvider()
	{
		return $this->provider;
	}

    /**
     * @param $provider_id
     */
    public function setProviderId($provider_id)
	{
		$this->provider_id = $provider_id;
	}

    /**
     * @return mixed
     */
    public function getProviderId()
	{
		return $this->provider_id;
	}

    /**
     * @param $widget_id
     */
    public function setWidgetId($widget_id)
	{
		$this->widget_id = $widget_id;
	}

    /**
     * @param $widget_id
     */
    public function setDisplayedIds($displayed_ids)
    {
        $this->displayed_ids = $displayed_ids;
    }

    /**
     * @return mixed
     */
    public function getWidgetId()
	{
		return $this->widget_id;
	}



	/**
	 * @param \RokCommon_Registry $params
	 */
	public function setParams($params)
	{
		$this->params = $params;
	}

	/**
	 * @param $json
	 */
	public function setParamsFromJSON($json)
	{
		$this->params = new RokCommon_Registry($json);
	}

	/**
	 * @return \RokCommon_Registry
	 */
	public function getParams()
	{
		return $this->params;
	}
}
