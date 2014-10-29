<?php
/**
 * @version   $Id: functions.php 20722 2014-04-30 09:12:33Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 * @return bool
 */
function rs_db_check()
{
	global $wpdb;
	if (!$wpdb->query("SHOW tables LIKE '%roksprocket_files%';")) {
		rs_force_deactivate();
		return false;
	} else {
		return true;
	}
}

/**
 * @param $className
 *
 * @return mixed
 * @throws Exception
 */
function rs_load_class($className)
{
	if (class_exists($className)) return;

	try {
		$parts = explode('_', strtolower($className));
		array_shift($parts); //remove RokGallery
		$parts    = array_reverse($parts); //reverse to get file name
		$fileName = array_shift($parts) . ".php";
		$parts    = array_reverse($parts); //reverse back to get path
		$filePath = implode($parts, '/'); //rebuild path

		$full_file_path = @realpath(realpath(dirname(__FILE__) . '/' . $filePath . '/' . $fileName));
		if (file_exists($full_file_path) && is_readable($full_file_path) && is_file($full_file_path)) require_once($full_file_path);
	} catch (Exception $e) {
		throw $e;
	}
}

spl_autoload_register('rs_load_class');

/**
 * @param        $name
 * @param null   $value
 * @param string $namespace
 *
 * @return null
 */
function rs_set_session_var($name, $value = null, $namespace = 'default')
{
	$old = isset($_SESSION[$namespace][$name]) ? $_SESSION[$namespace][$name] : null;

	if (null === $value) {
		unset($_SESSION[$namespace][$name]);
	} else {
		$_SESSION[$namespace][$name] = $value;
	}

	return $old;
}

/**
 * @param        $name
 * @param null   $default
 * @param string $namespace
 *
 * @return null
 */
function rs_get_session_var($name, $default = null, $namespace = 'default')
{

	if (isset($_SESSION[$namespace][$name])) {
		return $_SESSION[$namespace][$name];
	}
	return $default;
}

/**
 * @param $var
 *
 * @return mixed
 */
function rs_escape($var)
{
	if (in_array('htmlspecialchars', array('htmlspecialchars', 'htmlentities'))) {
		return call_user_func('htmlspecialchars', $var, ENT_COMPAT, 'UTF-8');
	}

	return call_user_func('htmlspecialchars', $var);
}

/**
 * @param $str
 *
 * @return string
 */
function rs_smartstripslashes($str)
{
	$cd1 = substr_count($str, "\"");
	$cd2 = substr_count($str, "\\\"");
	$cs1 = substr_count($str, "'");
	$cs2 = substr_count($str, "\\'");
	$tmp = strtr($str, array(
	                        "\\\"" => "",
	                        "\\'"  => ""
	                   ));
	$cb1 = substr_count($tmp, "\\");
	$cb2 = substr_count($tmp, "\\\\");
	if ($cd1 == $cd2 && $cs1 == $cs2 && $cb1 == 2 * $cb2) {
		return strtr($str, array(
		                        "\\\"" => "\"",
		                        "\\'"  => "'",
		                        "\\\\" => "\\"
		                   ));
	}
	return $str;
}

/**
 * @param $instance
 *
 * @return array
 */
function rs_parse_custom_post($instance)
{
	$new_instance = array();
	foreach ($instance as $key => $value) {
		if (is_array($value) && count($value) == 1) {
			$new_instance[$key] = $value['0'];
		} else {
			$new_instance[$key] = $value;
		}

	}
	return $new_instance;
}

/**
 * @param $instance
 * @param $defaults
 *
 * @return array
 */
function rs_parse_options($instance, $defaults)
{
	$instance = wp_parse_args((array)$instance, $defaults);
	foreach ($instance as $variable => $value) {
		//we borrow this from the widget class
		$$variable           = rs_cleanOutputVariable($variable, $value);
		$instance[$variable] = $$variable;
	}
	return $instance;
}

/**
 * @param $variable
 * @param $value
 *
 * @return array|string
 */
function rs_cleanOutputVariable($variable, $value)
{
	if (is_string($value)) {
		if($variable == 'title') return strip_tags($value);
		return htmlspecialchars($value);
	} elseif (is_array($value)) {
		foreach ($value as $subvariable => $subvalue) {
			$value[$subvariable] = rs_cleanOutputVariable($subvariable, $subvalue);
		}
		return $value;
	}
	return $value;
}

/**
 * @param $variable
 * @param $value
 *
 * @return array|string
 */
function rs_cleanInputVariable($variable, $value)
{
	if (is_string($value)) {
		return stripslashes($value);
	} elseif (is_array($value)) {
		foreach ($value as $subvariable => $subvalue) {
			$value[$subvariable] = rs_cleanInputVariable($subvariable, $subvalue);
		}
		return $value;
	}
	return $value;
}

/**
 * @param $field
 *
 * @return string
 */
function rs_get_option_id($field)
{
	return $field;
}

/**
 * @param $field
 *
 * @return string
 */
function rs_get_option_name($field)
{
	return 'roksprocket_plugin_settings' . '[' . $field . ']';
}

/**
 * @param $field_name
 *
 * @return string
 */
function rs_get_field_id($instance, $field_name)
{
	return 'widget-' . $instance['id_base'] . '-' . $instance['number'] . '-' . $field_name;
}


/**
 * @param $field_name
 *
 * @return string
 */

function rs_get_field_name($instance, $field_name)
{
	return 'widget-' . $instance['id_base'] . '[' . $instance['number'] . '][' . $field_name . ']';
}


/**
 * @param $disabled
 * @param $current
 *
 * @return string
 */
function rs_disabled($disabled, $current, $echo = true)
{
	if (is_array($disabled)) {
		$html = (in_array($current, $disabled)) ? ' disabled="disabled"' : '';
	} else {
		$html = ($current == $disabled) ? ' disabled="disabled"' : '';
	}
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

/**
 * @param $selected
 * @param $current
 *
 * @return string
 */
function rs_selected($selected, $current, $echo = true)
{
	if (is_array($selected)) {
		$html = (in_array($current, $selected)) ? ' selected="selected"' : '';

	} else if (is_int($selected) || is_int($current)) {
		$html = ((int)$current == (int)$selected) ? ' selected="selected"' : '';
	} else {
		$html = ($current == $selected) ? ' selected="selected"' : '';
	}
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

/**
 * @param $checked
 * @param $current
 *
 * @return string
 */
function rs_checked($checked, $current, $echo = true)
{
	if (is_array($checked)) {
		$html = (in_array($current, $checked)) ? ' checked="checked"' : '';
	} else {
		$html = ($current == $checked) ? ' checked="checked"' : '';
	}
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

/**
 * @param $children
 * @param int $id
 * @param string $indent
 * @param array $list
 * @param int $maxlevel
 * @param int $level
 * @return array
 */
function treerecurse(&$children, $id = 0, $indent = '- ', $list = array(), $maxlevel = 9999, $level = 0)
{

	if (@$children[$id] && $level <= $maxlevel)
	{
		foreach ($children[$id] as $v)
		{
            $current_indent = ($v->parent_id == 0) ? '' : $indent;
			$id = $v->id;
			$list[$id] = $v;
			$list[$id]->treename = $current_indent . $v->title;
			$list[$id]->children = count(@$children[$id]);
            $list[$id]->level = $level;
			$list = treerecurse($children, $id, $current_indent . $indent, $list, $maxlevel, $level + 1);
		}
	}
	return $list;
}

/**
 * @param $domain
 * @param $path
 * @return bool
 * WP Function load_plugin_text_domain has deprecated full paths
 * so this is to allow full paths and non plugin paths
 */
function rs_load_plugin_textdomain($domain, $path) {
	$locale = get_locale();
	$locale = apply_filters( 'plugin_locale', $locale, $domain );

    //correct mixed '\', '/' for windows
    $path = str_replace(array('/', '\\'), '/', $path);

    $mofile = $path . '/' . $domain . '-' . $locale . '.mo';
	if(!file_exists($mofile)) {
		$mofile = $path . '/' . $domain . '-en_US.mo';
	}

	return load_textdomain( $domain, $mofile );
}


/**
 * Call userlist window content via admin-ajax
 * there is no iframe handler in WP so we use ajax
 * @return mixed
 */
function roksprocket_userlist_ajax()
{
	define('ROKSPROCKET_AJAX_ADMIN', true);
	$nonce = RokSprocket_Request::getString('nonce');
	if (!wp_verify_nonce($nonce, 'roksprocket-ajax-nonce')) {
		return;
	}

	$instance           = new stdClass();
	$instance->role     = RokSprocket_Request::getString('role', '');
	$instance->search   = RokSprocket_Request::getString('search', '');
	$instance->paged    = RokSprocket_Request::getInt('paged', 1);
	$instance->orderby  = RokSprocket_Request::getString('orderby', 'display_name');
	$instance->order    = RokSprocket_Request::getString('order', 'ASC');

	//get view
	$view = new RokSprocket_Views_Userlist_View($instance);
	$view->renderHeader();
	$view->renderInlines();
	$view->render();
	exit;
}


/**
 * Call postlist window content via admin-ajax
 * there is no iframe handler in WP so we use ajax
 * @return mixed
 */
function roksprocket_postlist_ajax()
{
	define('ROKSPROCKET_AJAX_ADMIN', true);
	$nonce = RokSprocket_Request::getString('nonce');
	if (!wp_verify_nonce($nonce, 'roksprocket-ajax-nonce')) {
		return;
	}

	$instance            = new stdClass();
	$instance->provider  = RokSprocket_Request::getString('provider', '');
	$instance->post_type = RokSprocket_Request::getString('post_type', '');
	$instance->pod_type  = RokSprocket_Request::getString('pod_type', '');
	$instance->category  = RokSprocket_Request::getString('category', '');
	$instance->search    = RokSprocket_Request::getString('search', '');
	$instance->paged     = RokSprocket_Request::getInt('paged', 1);
	$instance->orderby   = RokSprocket_Request::getString('orderby', 'title');
	$instance->order     = RokSprocket_Request::getString('order', 'ASC');

	//get view
	if ($instance->provider == 'pods') {
		$view = new RokSprocket_Views_Postlist_Podsview($instance);
	} else {
		$view = new RokSprocket_Views_Postlist_View($instance);
	}
	$view->renderHeader();
	$view->renderInlines();
	$view->render();
	exit;
}


/**
 * @return mixed
 * default roksprocket ajax routing function
 */
function roksprocket_admin_ajax()
{
	define('ROKSPROCKET_AJAX_ADMIN', true);
	$nonce = RokSprocket_Request::getString('nonce');
	if (!wp_verify_nonce($nonce, 'roksprocket-ajax-nonce')) {
		return;
	}

	try {

		RokCommon_Ajax::addModelPath(ROKSPROCKET_PLUGIN_PATH . '/lib/RokSprocket/Admin/Ajax/Model', 'RokSprocketAdminAjaxModel');
		$model    = RokSprocket_Request::getString('model');
		$action   = RokSprocket_Request::getString('model_action');
		$encoding = RokSprocket_Request::getString('model_encoding', RokCommon_Ajax::JSON_ENCODING);
		$params   = array();
		if ($encoding == RokCommon_Ajax::JSON_ENCODING) {
			if (isset($_REQUEST['params'])) {
				$params = rs_smartstripslashes($_REQUEST['params']);
			}
		} else if ($encoding == RokCommon_Ajax::FORM_ENCODING) {
			foreach ($_REQUEST as $key => $value) {
				if (!in_array($key, array("model", "model_action", "model_encoding", "nonce", "action"))) {
					$params[$key] = $value;
				}
			}
            if(isset($params)){
                //only for wp forms, this is a wp function
                $params = stripslashes_deep($params);
            }
		}
		echo RokCommon_Ajax::run($model, $action, $params, $encoding);
		// IMPORTANT: don't forget to "exit"
		exit;
	} catch (Exception $e) {
		$result = new RokCommon_Ajax_Result();
		$result->setAsError();
		$result->setMessage($e->getMessage());
		echo json_encode($result);
		// IMPORTANT: don't forget to "exit"
		exit;
	}
}

/**
 *
 */
function roksprocket_frontend_ajax()
{
	try {
		define('ROKSPROCKET_AJAX_ADMIN', false);
		$container = RokCommon_Service::getContainer();
		foreach ($container['roksprocket.layouts'] as $layout) {
			if (isset($layout->paths) && isset($layout->ajax->dir)) {
				$paths    = $layout->paths;
				$ajax_dir = $layout->ajax->dir;
				foreach ($paths as $priority => $path) {
					$ajax_path = $path . '/' . $ajax_dir;
					if (is_dir($ajax_path)) {
						RokCommon_Ajax::addModelPath($ajax_path, 'RokSprocketSiteLayoutAjaxModel', $priority);
					}
				}
			}
		}
		$model    = RokSprocket_Request::getString('model');
		$action   = RokSprocket_Request::getString('model_action');
		$encoding = RokSprocket_Request::getString('model_encoding', RokCommon_Ajax::JSON_ENCODING);
		$params   = array();
		if ($encoding == RokCommon_Ajax::JSON_ENCODING) {
			if (isset($_REQUEST['params'])) {
				$params = rs_smartstripslashes($_REQUEST['params']);
			}
		} else if ($encoding == RokCommon_Ajax::FORM_ENCODING) {
			foreach ($_REQUEST as $key => $value) {
				if (!in_array($key, array("model", "model_action", "model_encoding", "nonce", "action"))) {
					$params[$key] = $value;
				}
			}
		}
		echo RokCommon_Ajax::run($model, $action, $params);
		exit;
	} catch (Exception $e) {
		$result = new RokCommon_Ajax_Result();
		$result->setAsError();
		$result->setMessage($e->getMessage());
		echo json_encode($result);
		exit;
	}
}

/**
 * @static
 * @return bool
 */
function rs_roksprocket_check()
{
	//check for rokcommon
	$roksprocket = (file_exists(ROKSPROCKET_PLUGIN_PATH . '/roksprocket.php')) ? true : false;
    $activated = false;

	//check if rokcommon is activated
	$options   = get_option('active_plugins');
	foreach ($options as $k => $v) {
		if (strpos($v, 'roksprocket') !== false) {
			$activated = true;
		}
	}
    //multi-site
    if(is_multisite()){
        $wpmu_options   = get_site_option( 'active_sitewide_plugins');
        foreach ($wpmu_options as $k => $v) {
            if (strpos($k, 'roksprocket') !== false) {
                $activated = true;
            }
        }
    }
	if (($roksprocket) && ($activated)) {
		return true;
	} else if (($roksprocket) && (!$activated)) {
		return false;
	} else {
		return false;
	}
}

/**
 * @static
 * @return bool
 */
function rs_rokcommon_check()
{
	//check for rokcommon
	$rokcommon = (file_exists(ROKCOMMON_LIB_PATH . '/rokcommon.php')) ? true : false;
    $activated = false;

	//check if rokcommon is activated
	$options   = get_option('active_plugins');
	foreach ($options as $k => $v) {
		if (strpos($v, 'rokcommon') !== false) {
			$activated = true;
		}
	}
    //multi-site
    if(is_multisite()){
        $wpmu_options   = get_site_option( 'active_sitewide_plugins');
        foreach ($wpmu_options as $k => $v) {
            if (strpos($k, 'rokcommon') !== false) {
                $activated = true;
            }
        }
    }
	if (($rokcommon) && ($activated)) {
		return true;
	} elseif (($rokcommon) && (!$activated)) {
		rs_force_deactivate();
		roksprocket_set_admin_message('error', __('RokSprocket Plugin requires the RokCommon Library Plugin to be <strong>Installed</strong> and <strong>Activated</strong> before you can activate or use RokSprocket.'));
		return false;
	} else {
		rs_force_deactivate();
		roksprocket_set_admin_message('error', __('RokSprocket Plugin requires the RokCommon Library Plugin to be <strong>Activated</strong> before you can activate or use RokSprocket.'));
		return false;
	}
}

/**
 * @static
 * removes roksprocket from active_plugins options in db
 */
function rs_force_deactivate()
{
    $options = array();
    if(get_option('active_plugins'))
        $options = get_option('active_plugins');
	foreach ($options as $k => $v) {
		if (strpos($options[$k], 'roksprocket') !== false) {
			unset($options[$k]);
		}
	}
	update_option('active_plugins', $options);
	roksprocket_set_admin_message('error', __("RokSprocket Plugin has been deactivated."));
}

/**
 * @param     $type
 * @param     $message
 * @param int $timeout
 *
 * @return mixed
 */
function roksprocket_set_admin_message($type, $message, $timeout = 30)
{
	if (empty($message)) return;
	$tansitent_id = md5('roksprocket-message-' . $_COOKIE['PHPSESSID']);
	$exisisting   = get_transient($tansitent_id);
	if ($exisisting == false) {
		$exisisting = array();
	}
	$msgobject           = new stdClass();
	$msgobject->type     = $type;
	$msgobject->message  = $message;
	$chksum              = md5($type . $message);
	$exisisting[$chksum] = $msgobject;
	set_transient($tansitent_id, $exisisting, $timeout);
}

/**
 * @return mixed|null
 */
function roksprocket_get_admin_messages()
{
	$ret          = null;
	$tansitent_id = md5('roksprocket-message-' . $_COOKIE['PHPSESSID']);
	$ret          = get_transient($tansitent_id);
	if ($ret != false) delete_transient($tansitent_id);
	return $ret;
}

/**
 *
 */
function roksprocket_display_admin_notices()
{
	$buffer   = '';
	$messages = roksprocket_get_admin_messages();
	if ($messages) {
		foreach ($messages as $message) {
			$buffer .= '<div id="message" class="' . $message->type . '">' . "\n";
			$buffer .= "<p>" . $message->message . "</p>\n";
			$buffer .= "</div>";
		}
	}
	echo $buffer;
}

add_action("admin_notices", 'roksprocket_display_admin_notices', 100);

if (is_admin()) {
	add_action('wp_ajax_roksprocket', 'roksprocket_admin_ajax');
	add_action('wp_ajax_roksprocket_userlist', 'roksprocket_userlist_ajax');
	add_action('wp_ajax_roksprocket_postlist', 'roksprocket_postlist_ajax');
}
add_action('wp_ajax_roksprocket_fe', 'roksprocket_frontend_ajax');
add_action('wp_ajax_nopriv_roksprocket_fe', 'roksprocket_frontend_ajax');
