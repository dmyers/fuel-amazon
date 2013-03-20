<?php

return array(
	/**
	 * access_key_id - The identifier for your access key.
	 *
	 * You will find this in your amazon web services account
	 */
	'access_key_id' => 'your_access_id',
	
	/**
	 * secret_access_key - The secret for your access key.
	 *
	 * You will find this in your amazon web services account
	 */
	'secret_access_key' => 'your_secret_key',
	
	/**
	 * use_ssl - Whether to use secure connections.
	 */
	'use_ssl' => false,
	
	/**
	 * default_bucket - The bucket to use as default.
	 */
	'default_bucket' => 'your_bucket',
	
	/**
	 * default_acl - The ACL option to use as default.
	 */
	'default_acl' => AmazonS3::ACL_PRIVATE,
	
	/**
	 * host_url - The URL to the amazon s3 host.
	 */
	'host_url' => 's3.amazonaws.com',
);
