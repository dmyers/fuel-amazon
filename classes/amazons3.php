<?php

/**
 * Amazon S3 Class
 *
 * @package		AmazonS3
 * @category	Package
 * @author		Derek Myers
 * @link		https://github.com/dmyers/fuel-amazons3
 */

namespace AmazonS3;

require_once PKGPATH.'amazons3'.DS.'vendor'.DS.'amazons3'.DS.'S3.php';

class AmazonS3 extends \S3
{
	/**
	 * loaded amazon s3 instance
	 * 
	 * @var AmazonS3
	 */
	protected static $_instance;
	
	/**
	 * loaded amazon s3 config array
	 * 
	 * @var array
	 */
	protected static $_config = array();
	
	/**
	 * Initialize by loading config
	 */
	public static function _init()
	{
		$config = \Config::load('amazons3', true);
		
		self::set_config($config);
		
		self::$useExceptions = true;
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
	 * Returns a new amazon s3 object.
	 *
	 *     $amazons3 = AmazonS3::forge();
	 *
	 * @param	void
	 * @access	public
	 * @return  AmazonS3
	 */
	public static function forge()
	{
		$config = self::config();
		
		if (empty($config['access_key_id'])) {
			throw new \AmazonS3Exception('You must set the access_key_id config');
		}
		
		if (empty($config['secret_access_key'])) {
			throw new \AmazonS3Exception('You must set the secret_access_key config');
		}
		
		return new static($config['access_key_id'], $config['secret_access_key'], $config['use_ssl']);
	}
	
	/**
	 * create or return the amazons3 instance
	 *
	 * @param	void
	 * @access	public
	 * @return	AmazonS3 object
	 */
	public static function instance()
	{
		if (self::$_instance === null) {
			self::$_instance = self::forge();
		}
		
		return self::$_instance;
	}
	
	/**
	 * Gets the url to the object uri.
	 *
	 * @param string $bucket The bucket name to use.
	 * @param string $uri    The URI to the object.
	 *
	 * @return string
	 */
	public static function url($bucket = null, $uri)
	{
		if (empty($bucket)) {
			$bucket = self::config('default_bucket');
		}
		
		return \Input::protocol() . '://' . self::config('host_url') . '/' . $bucket . '/' . $uri;
	}
	
	public static function putObject($input, $bucket = null, $uri, $acl = null, $metaHeaders = array(), $requestHeaders = array(), $storageClass = self::STORAGE_CLASS_STANDARD)
	{
		if (empty($bucket)) {
			$bucket = self::config('default_bucket');
		}
		
		if (empty($acl)) {
			$acl = self::config('default_acl', self::ACL_PRIVATE);
		}
		
		return parent::putObject($input, $bucket, $uri, $acl, $metaHeaders, $requestHeaders, $storageClass);
	}
	
	public static function putObjectFile($file, $bucket = null, $uri, $acl = null, $metaHeaders = array(), $contentType = null)
	{
		return self::putObject(self::inputFile($file), $bucket, $uri, $acl, $metaHeaders, $contentType);
	}
	
	public static function putObjectString($string, $bucket = null, $uri, $acl = null, $metaHeaders = array(), $contentType = 'text/plain')
	{
		return self::putObject($string, $bucket, $uri, $acl, $metaHeaders, $contentType);
	}
	
	public static function getObject($bucket = null, $uri, $saveTo = false)
	{
		if (empty($bucket)) {
			$bucket = self::config('default_bucket');
		}
		
		return parent::getObject($bucket, $uri, $saveTo);
	}
	
	public static function deleteObject($bucket = null, $uri)
	{
		if (empty($bucket)) {
			$bucket = self::config('default_bucket');
		}
		
		return parent::deleteObject($bucket, $uri);
	}
}

class AmazonS3Exception extends \FuelException {}
