<?php

/**
 * Amazon Class
 *
 * @package		Amazon
 * @category	Package
 * @author		Derek Myers
 * @link		https://github.com/dmyers/fuel-amazon
 */

namespace Amazon;

use Aws\Common\Aws;

class Amazon
{
	/**
	 * loaded amazon instance
	 * 
	 * @var Amazon
	 */
	protected static $_instance;
	
	/**
	 * loaded amazon config array
	 * 
	 * @var array
	 */
	protected static $_config = array();
	
	/**
	 * Initialize by loading config
	 */
	public static function _init()
	{
		$config = \Config::load('amazon', true);
		
		self::set_config($config);
	}
	
	/**
	 * Gets an item from config.
	 *
	 * @param string $name    The key name to get.
	 * @param string $default The default is no config found.
	 *
	 * @return mixed
	 */
	public static function config($name = null, $default = null)
	{
		if (empty($name)) {
			return self::$_config;
		}
		
		return \Arr::get(self::$_config, $name, $default);
	}
	
	/**
	 * Sets an item or array of items in config.
	 *
	 * @param array|string $name  The key name to set.
	 * @param mixed        $value The value to set config to.
	 * 
	 * @return void
	 */
	public static function set_config($name, $value = null)
	{
		if (is_array($name)) {
			self::$_config = array_merge(self::$_config, $name);
		}
		else {
			self::$_config[$name] = $value;
		}
	}
	
	/**
	 * Returns a new amazon object.
	 *
	 *     $amazon = Amazon::forge();
	 *
	 * @param	void
	 * @access	public
	 * @return  Amazon
	 */
	public static function forge()
	{
		$config = self::config();
		
		if (empty($config['key'])) {
			throw new \AmazonException('You must set the key config');
		}
		
		if (empty($config['secret'])) {
			throw new \AmazonException('You must set the secret config');
		}
		
		return Aws::factory($config);
	}
	
	/**
	 * create or return the amazon instance
	 *
	 * @param	void
	 * @access	public
	 * @return	Amazon object
	 */
	public static function instance()
	{
		if (self::$_instance === null) {
			self::$_instance = self::forge();
		}
		
		return self::$_instance;
	}
}

class AmazonException extends \FuelException {}
