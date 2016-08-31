<?php
define('WEBROOT', ROOT.'/public');
define('APPROOT', ROOT.'/app');
define('VARROOT', ROOT.'/var');
define('VIEWS', APPROOT.'/views/');

// Composer
require_once VENDOR.'/autoload.php';

// Core
require_once ERDIKO.'/Toro.php';
require_once ERDIKO.'/autoload.php'; // auto loading for the app

// Core framework functions (static functions)
require_once ROOT.'/Erdiko.php';

// Set a default context if none specified
if(empty(getenv('ERDIKO_CONTEXT')))
	putenv("ERDIKO_CONTEXT=default");