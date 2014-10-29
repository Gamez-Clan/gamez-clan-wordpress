<?php
/**
 * @version   $Id: abstract.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

abstract class RokSprocket_Model_Object_Abstract
{
	/**
	 * Name of the database table to model.
	 *
	 * @var    string
	 */
	protected $_tbl = '';

	/**
	 * Name of the primary key field in the table.
	 *
	 * @var    string
	 */
	protected $_tbl_key = '';


	/**
	 * @var wpdb
	 */
	protected $_db;

	public function __construct()
	{
		global $wpdb;
		$this->_db = $wpdb;
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
	 * Method to store a row in the database from the JTable instance properties.
	 * If a primary key value is set the row with that primary key value will be
	 * updated with the instance property values.  If no primary key value is set
	 * a new row will be inserted into the database with the properties from the
	 * JTable instance.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @link    http://docs.joomla.org/JTable/store
	 * @since   11.1
	 */
	public function store($updateNulls = false)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// If a primary key exists update the object, otherwise insert it.
		if ($this->$k) {
			$stored = $this->updateObject($this->_db->prefix . $this->_tbl, $this, $this->_tbl_key, $updateNulls);
		} else {
			$stored = $this->insertObject($this->_db->prefix . $this->_tbl, $this, $this->_tbl_key);
		}

		// If the store failed return false.
		if ($stored === false) {
			throw new Exception($this->_db->last_error);
		}
		return true;
	}

	/**
	 * Inserts a row into a table based on an object's properties.
	 *
	 * @param   string  $table    The name of the database table to insert into.
	 * @param   object  &$object  A reference to an object whose public properties match the table fields.
	 * @param   string  $key      The name of the primary key. If provided the object property is updated.
	 *
	 * @return  boolean    True on success.
	 */
	public function insertObject($table, &$object, $key = 'id')
	{
		$values = array();

		// Iterate over the object variables to build the query fields and values.
		foreach (get_object_vars($object) as $k => $v) {
			// Only process non-null scalars.
			if (is_array($v) or (is_object($v) && !method_exists($v, '__toString')) or $v === null) {
				continue;
			}

			// Ignore any internal fields.
			if ($k[0] == '_') {
				continue;
			}
			$values[$k] = (string)$v;
		}

		if (!($id = $this->_db->insert($table, $values))) {
			return false;
		}

		// Update the primary key if it exists.;
		if ($key && $id) {
			$object->$key = $this->_db->insert_id;
		}
		return true;
	}

	/**
	 * Updates a row in a table based on an object's properties.
	 *
	 * @param   string   $table    The name of the database table to update.
	 * @param   object   &$object  A reference to an object whose public properties match the table fields.
	 * @param   string   $key      The name of the primary key.
	 * @param   boolean  $nulls    True to update null fields or false to ignore them.
	 *
	 * @return  boolean  True on success.
	 *
	 */
	public function updateObject($table, &$object, $key = 'id', $nulls = false)
	{
		// Initialise variables.
		$fields = array();
		$where  = array();

		// Iterate over the object variables to build the query fields/value pairs.
		foreach (get_object_vars($object) as $k => $v) {
			// Only process scalars that are not internal fields.
			if (is_array($v) or (is_object($v) && !method_exists($v, '__toString')) or $k[0] == '_') {
				continue;
			}

			// Set the primary key to the WHERE clause instead of a field to update.
			if ($k == $key) {
				$where[$k] = $v;
				continue;
			}

			// Prepare and sanitize the fields and values for the database query.
			if ($v === null) {
				// If the value is null and we want to update nulls then set it.
				if ($nulls) {
					$val = 'NULL';
				} // If the value is null and we do not want to update nulls then ignore this field.
				else {
					continue;
				}
			} // The field is not null so we prep it for update.
			else {
				$val = (string)$v;
			}

			// Add the field to be updated.
			$fields[$k] = $val;
		}
		// We don't have any fields to update.
		if (empty($fields)) {
			return true;
		}
		return $this->_db->update($table, $fields, $where);
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$values = array();

		// Iterate over the object variables to build the query fields and values.
		foreach (get_object_vars($this) as $k => $v) {
			// Only process non-null scalars.
			if ((is_object($v) && !method_exists($v, 'toArray')) or $v === null) {
				continue;
			}
			// Ignore any internal fields.
			if ($k[0] == '_') {
				continue;
			}
			if (is_object($v)) {
				$v = $v->toArray();
			}
			$values[$k] = $v;
		}
		return $values;
	}

	/**
	 *
	 * @param $value
	 *
	 * @return array|string
	 */
	protected static function _stripSlashesRecursive($value)
	{
		$value = is_array($value) ? array_map(array(
		                                           'RokSprocket_Model_Object_Abstract',
		                                           '_stripSlashesRecursive'
		                                      ), $value) : stripslashes($value);
		return $value;
	}

	public function bind($src, $ignore = array())
	{
		// If the source value is not an array or object return false.
		if (!is_object($src) && !is_array($src)) {
			throw new Exception(rc__('Bind error on class %s', get_class($this)));
		}

		// If the source value is an object, get its accessible properties.
		if (is_object($src)) {
			$src = get_object_vars($src);
		}

		// If the ignore value is a string, explode it over spaces.
		if (!is_array($ignore)) {
			$ignore = explode(' ', $ignore);
		}

		// Bind the source value, excluding the ignored fields.
		foreach ($this->getProperties() as $k => $v) {
			// Only process fields not in the ignore array.
			if (!in_array($k, $ignore)) {
				if (isset($src[$k])) {
					$this->$k = $src[$k];
				}
			}
		}

		return true;
	}

	public function getProperties($public = true)
	{
		$vars = get_object_vars($this);
		if ($public) {
			foreach ($vars as $key => $value) {
				if ('_' == substr($key, 0, 1)) {
					unset($vars[$key]);
				}
			}
		}

		return $vars;
	}

}
