<?php
/**
 * @version   $Id: edit.php 19577 2014-03-10 20:35:34Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Model_Edit extends RokSprocket_Model_AbstractModel
{
	/**
	 * @param $id
	 *
	 * @return RokSprocket_Model_Object_Widget|bool
	 */
	public function get($id)
	{
		$row = $this->db->get_row($this->db->prepare("SELECT * FROM `" . $this->db->prefix . self::MAIN_TABLE . "` WHERE `id` = %d", $id), ARRAY_A);
		if ($row !== false) {
			$row      = RokSprocket_Model_Object_Widget::genereateFromArray($row);
			$registry = new RokCommon_Registry();
			if (!is_null($row->params)) {
				$registry->loadString($row->params);
			}
			$registry->set('module_id', $row->getId());
			$row->params   = $registry;
			$row->modified = new RokCommon_Date($row->modified);
		}
		return $row;
	}

	public function getItems($id)
	{
		$ret  = array();
		$rows = $this->db->get_results($this->db->prepare("SELECT * FROM `" . $this->db->prefix . self::ITEMS_TABLE . "` WHERE `widget_id` = %d", $id), ARRAY_A);
		if ($rows !== false) {
			foreach ($rows as $row) {
				$item                                            = RokSprocket_Model_Object_Item::genereateFromArray($row);
				$ret[$item->provider . '-' . $item->provider_id] = $item;
				$registry                                        = new RokCommon_Registry();
				if (!is_null($row->params)) {
					$registry->loadString($row->params);
				}
				$item->params = $registry->toArray();
			}
		}
		return $ret;
	}

	public function getArticles($module_id, $params)
	{
		if (!is_object($params)) {
			$params = new RokCommon_Registry($params);
		}
		return RokSprocket::getItemsWithParams($module_id, $params, false, true);
	}

	/**
	 * @param $widget RokSprocket_Model_Object_Widget
	 */
	protected function prepareItem(&$widget)
	{
		$widget->title = htmlspecialchars_decode($widget->title, ENT_QUOTES);
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   1.6
	 */
	public function save($data, $copyof = null)
	{
		$original_data = $data;
		$pk            = $data['id'];

		// Load the row if saving an existing record.
		if ($pk > 0) {
			$widget = $this->get($pk);
			if ($widget === false) throw new Exception('Unable to get information for roksprocket id ' . $pk);
		} else {
			$widget = new RokSprocket_Model_Object_Widget();

			// clear session cache of articles being saved
			if (isset($data['uuid']) && $data['uuid'] != '0')
			{
				RokCommon_Session::clear('roksprocket.'.$data['uuid']);
			}
		}


		// Bind the data.
		$widget->bind($data);

		$this->prepareItem($widget);

		// Store the data.
		$widget->store();

		// Add the per item custom settings
		$items = $data['items'];


		$old_moduleid = (int)$widget->id;
		if (!is_null($copyof)) {
			$old_moduleid = (int)$copyof;
		}

		// get the old set of items for the module
		$old_items = $this->getItems($old_moduleid);


		$all_new_items = $this->getArticles((int)$widget->getId(), $widget->getParams());

		if (is_null($copyof)) {
			if ($this->db->delete($this->db->prefix . self::ITEMS_TABLE, array('widget_id'=> (string)$widget->id), array('%s')) === false) {
				throw new Exception($this->getLastError());
			}
			if (empty($original_data['id'])) {
				$original_data['id'] = (int)$widget->id;
			}
		}
		$per_item_form = $this->getPerItemsForm();

		// Save the Showing Items
		$last_ordernumber = 0;
		foreach ($items as $item_id => $item_settings) {
			$item_settings['widget_id'] = (int)$widget->id;
			list($item_settings['provider'], $item_settings['provider_id']) = explode('-', $item_id);
			/** @var $item_table RokSprocket_Model_Object_Item */
			$item_table = new RokSprocket_Model_Object_Item();

			$fields = $per_item_form->getFieldsetWithGroup('peritem');
			foreach ($fields as $field) {
				if (!array_key_exists($field->fieldname, $item_settings['params'])) {
					if (!empty($old_items) && isset($old_items[$item_id]) && array_key_exists($field->fieldname, $old_items[$item_id]->params)) {
						$item_settings['params'][$field->fieldname] = $old_items[$item_id]->params[$field->fieldname];
					} else {
						$item_settings['params'][$field->fieldname] = $per_item_form->getFieldAttribute($field->fieldname, 'default', null, 'params');
					}
				}
			}

			// Bind the data.
			$item_table->bind($item_settings);
			// Store the data.
			$item_table->store();


			$last_ordernumber = $item_table->order;
			if (isset($old_items[$item_id])) unset($old_items[$item_id]);
			if (isset($all_new_items[$item_id])) unset($all_new_items[$item_id]);
		}

		//Save the remaining items  (Not Shown)
		foreach ($all_new_items as $item_id => $unseen_item) {
			$item_settings              = array();
			$item_settings['widget_id'] = (int)$widget->id;
			list($item_settings['provider'], $item_settings['provider_id']) = explode('-', $item_id);
			$item_settings['order'] = ++$last_ordernumber;
			if (isset($old_items[$item_id]) && $old_items[$item_id]->params != null) {
				$item_settings['params'] = $old_items[$item_id]->params;
			} elseif (isset($all_new_items[$item_id]) && $all_new_items[$item_id]->getParams() != null) {
				$item_settings['params'] = RokCommon_JSON::encode($all_new_items[$item_id]->getParams());
			}


			/** @var $item_table RokSprocket_Model_Object_Item */
			$item_table = new RokSprocket_Model_Object_Item();

			// Bind the data.
			$item_table->bind($item_settings);
			// Store the data.
			$item_table->store();
		}
		RokCommon_Session::clear('roksprocket.'.$widget->getId());
				// fire the providers postSave for any provider cleanup
		$container = RokCommon_Service::getContainer();
		/** @var RokSprocket_IProvider $provider */
		$provider = $container->getService("roksprocket.provider.{$data['params']['provider']}");
		$provider->postSave($widget->id);

		return $widget->getId();
	}

	/**
	 * @param $type
	 *
	 * @return \RokSprocket_ConfigForm
	 */
	public function getPerItemsForm($type = null)
	{
		$options   = new RokCommon_Options();
		$container = RokCommon_Service::getContainer();
		// load up the layouts

		if (null == $type) {
			foreach ($container['roksprocket.layouts'] as $type => $layoutinfo) {
				$this->addPerItemsOptionsForLayout($type, $options);
			}
		} else {
			$this->addPerItemsOptionsForLayout($type, $options);
		}

		$rcform    = $rcform = new RokSprocket_ConfigForm(new RokCommon_Form('roksprocket_peritem'));
		$xml       = $options->getJoinedXml();
		$jxml      = new RokCommon_XMLElement($xml->asXML());
		$fieldsets = $jxml->xpath('/config/fields[@name = "params"]/fieldset');
		foreach ($fieldsets as $fieldset) {
			$overwrite = ((string)$fieldset['overwrite'] == 'true') ? true : false;
			$rcform->load($fieldset, $overwrite, '/config');
		}
		return $rcform;
	}

	protected function addPerItemsOptionsForLayout($type, RokCommon_Options &$options)
	{
		$container  = RokCommon_Service::getContainer();
		$layoutinfo = $container['roksprocket.layouts.' . $type];
		if (isset($layoutinfo->options->peritem)) {
			$section = new RokCommon_Options_Section('peritem_' . $type, $layoutinfo->options->peritem);
			foreach ($layoutinfo->paths as $layoutpath) {
				$section->addPath($layoutpath);
			}
			$options->addSection($section);
		}
	}
}
