<?php
/**
 * @version   $Id: request.php 21664 2014-06-19 19:53:13Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Request
{
    /**
     *
     */
    function __construct()
    {
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getString($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'string');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getBool($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'bool');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getInt($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'int');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getFloat($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'float');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getArray($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'array');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getObject($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'object');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getEmail($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'email');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getUrl($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'url');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     */
    public static function getIP($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'ip');
    }

    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     * @return mixed|string
     */
    public static function getRaw($name, $default = null, $hash = 'default')
    {
        return self::getVar($name, $default, $hash, 'raw');
    }


    /**
     * @static
     * @param $name
     * @param null $default
     * @param string $hash
     * @param string $type
     * @return mixed|string
     */
    protected static function getVar($name, $default = null, $hash = 'default', $type = 'default')
    {
        // Get the input hash
        switch (strtoupper($hash))
        {
            case 'GET':
                $var = $_GET;
                break;
            case 'POST':
                $var = $_POST;
                break;
            case 'FILES':
                $var = $_FILES;
                break;
            case 'COOKIE':
                $var = $_COOKIE;
                break;
            case 'ENV':
                $var = $_ENV;
                break;
            case 'SERVER':
                $var = $_SERVER;
                break;
            default:
                $var = $_REQUEST;
                break;
        }
        if (isset($var[$name]) && (!is_null($var[$name]))) {
            $var = $var[$name];
        }
        elseif (!isset($var[$name]) && (!is_null($default))) {
            $var = $default;
        }
        else {
            $var = null;
        }

        if ($var!==null){
            switch ($type) {

                case 'string':
                    $var = (is_string((string)$var)) ? $var : null;
                    $var = filter_var($var, FILTER_SANITIZE_STRING);
                    $var = self::sanitize($var);
                    $var = (string)$var;
                    break;

                case 'bool';
                    $var = (is_bool((boolean)$var)) ? $var : null;
                    $var = filter_var($var, FILTER_VALIDATE_BOOLEAN);
                    $var = (boolean)$var;
                    break;

                case 'int':
                    $var = (is_int((int)$var)) ? $var : null;
                    $var = filter_var($var, FILTER_VALIDATE_INT);
                    $var = filter_var($var, FILTER_SANITIZE_NUMBER_INT);
                    break;

                case 'float':
                    $var = (is_float((float)$var)) ? $var : null;
                    $var = filter_var($var, FILTER_VALIDATE_FLOAT);
                    $var = (float)$var;
                    break;

                case 'array':
                    $var = (is_array($var)) ? $var : null;
                    $var = RokSprocket_Request::_cleanArray($var);
                    break;

                case 'object':
                    $var = (is_object($var)) ? $var : null;
                    break;

                case 'email':
                    $var = (is_email($var)) ? $var : null;
                    $var = filter_var($var, FILTER_VALIDATE_EMAIL);
                    $var = filter_var($var, FILTER_SANITIZE_EMAIL);
                    break;

                case 'url':
                    $var = filter_var($var, FILTER_VALIDATE_URL);
                    $var = filter_var($var, FILTER_SANITIZE_URL);
                    break;

                case 'ip':
                    $var = filter_var($var, FILTER_VALIDATE_IP);
                    break;

                case 'raw':
                    break;

                default:
                    $var = (is_string((string)$var)) ? $var : null;
                    $var = filter_var($var, FILTER_SANITIZE_STRING);
                    $var = self::sanitize($var);
                    $var = (string)$var;
                    break;
            }
        }
        return $var;
    }

    /**
     * @static
     * @param $value
     * @return array|string
     */
    protected static function _stripSlashesRecursive($value)
    {
        $value = is_array($value) ? array_map(array('RokSprocket_Request', '_stripSlashesRecursive'), $value) : stripslashes($value);
        return $value;
    }

    /**
     * @static
     * @param $array
     */
    protected static function _cleanArray(&$array)
   	{
   		static $banned = array('_files', '_env', '_get', '_post', '_cookie', '_server', '_session', 'globals');

   		foreach ($array as $key => $value)
   		{
   			// PHP GLOBALS injection bug
   			$failed = in_array(strtolower($key), $banned);

   			// PHP Zend_Hash_Del_Key_Or_Index bug
   			$failed |= is_numeric($key);
   			if ($failed) {
                   add_action('admin_notices', create_function('', 'echo \'<div id="message" class="updated highlight"><p>Illegal variable <b>' . implode('</b> or <b>', $banned) . '</b> passed to script.</p></div>\';'));
                exit;
   			} else {
               return $array;
            }
   		}
   	}

    /**
     * @static
     * @param $var
     * @return mixed
     */
    protected static function cleanInput($var)
    {
      $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
      );

        $output = preg_replace($search, '', $var);
        return $output;
      }

    /**
     * @static
     * @param $var
     * @return array|string
     */
    protected static function sanitize($var)
    {

        if(is_null($var)) return;

        if (is_array($var)) {
            foreach($var as $var=>$val) {
                $output[$var] = self::sanitize($val);
            }
        }
        else {
            if (get_magic_quotes_gpc()) {
                $var = stripslashes($var);
            }
            $var  = self::cleanInput($var);
            $output = self::escapeString($var);
        }
        return $output;
    }

    protected static function escapeString($inp) {
        if(is_array($inp))
            return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

        return $inp;
    }
}