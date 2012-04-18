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
	 */
	protected static $_instance = null;

	/**
	 * Initialize by loading config
	 */
	public static function _init()
	{
		\Config::load('amazons3', true);
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
		$config = \Config::get('amazons3');
		
		if (empty($config['access_key_id'])) {
			throw new AmazonS3_Exception('You must set the access_key_id config');
		}

		if (empty($config['secret_access_key'])) {
			throw new AmazonS3_Exception('You must set the secret_access_key config');
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

}

class AmazonS3_Exception extends \Fuel_Exception {
}