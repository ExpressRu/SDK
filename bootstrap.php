<?php
require_once('src/Psr4Autoloader.php');
// instantiate the loader
$loader = new \ExpressRuSDK\Psr4Autoloader();
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('ExpressRuSDK\\', __DIR__.'/src');