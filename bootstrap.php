<?php

Autoloader::add_core_namespace('AmazonS3');

Autoloader::add_classes(array(
	'AmazonS3\\AmazonS3' => __DIR__.'/classes/amazons3.php',
));
