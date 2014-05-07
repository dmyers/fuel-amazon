<?php

Autoloader::add_core_namespace('Amazon');

Autoloader::add_classes(array(
	'Amazon\\Amazon'          => __DIR__.'/classes/amazon.php',
	'Amazon\\AmazonException' => __DIR__.'/classes/amazon.php',
));
