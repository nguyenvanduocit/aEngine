<?php

/*
Plugin Name: aEngine
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Heart of all SenViet's product.
Version: 1.0
Author: nguyenvanduocit
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

define('AENGINE_VERSION', '1.0.1');
define('AENGINE_FILE', __FILE__);
define('AENGINE_DIR', __DIR__);
define('AENGINE_DOMAIN', 'aEngine');

require_once AENGINE_DIR.'/vendor/autoload.php';

global $aEngine;
$aEngine = new AEngine\AEngine();
$aEngine->run();