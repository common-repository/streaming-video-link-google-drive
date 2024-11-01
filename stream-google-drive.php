<?php
/**
 * Plugin Name: Streaming Video Link Google Drive
 * Plugin URI: https://stream3s.com
 * Description: Streaming video google drive link easy and unlimited. Get link stream for google drive link unlimited views with Stream3s api. Embed or get direct link video and play in your website.
 * Version: 1.0
 * Author: Stream3s Team
 * Author URI: https://stream3s.com/
 * License: GPLv2 or later
 */

define('STREAM3S_DIRECTORY', __DIR__);
define('STREAM3S_CORE_DIRECTORY', __DIR__ . '/Stream3s');

require_once (__DIR__ . '/Stream3s/Helpers/helpers.php');
require_once (__DIR__ . '/Stream3s/Helpers/Request.php');
require_once (__DIR__ . '/Stream3s/Helpers/Stream3sApi.php');

stream3s_load_php(__DIR__ . '/Stream3s/Core');
stream3s_load_php(__DIR__ . '/Stream3s/Controllers');

$stream3s = new Stream3s\Core\Stream3s();
$stream3s->init();