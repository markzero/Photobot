<?php
/*
Plugin Name: Photobot
Version: 0.1-alpha
Description: Manipulate & add effects to your uploaded images. Optionally upload images directly to your or our S3 bucket.
Author: Marko Jakic
Author URI: http://devcanyon.com/
Plugin URI: PLUGIN SITE HERE
Text Domain: photobot
Domain Path: /languages
*/


if (!function_exists('add_filter')) {
  return;
}


define('PHBOT_LANG', 'photobot');
define('PHBOT_VERSION', '1.0.0');
define('PHBOT_PATH', trailingslashit(dirname(__FILE__)));
define('PHBOT_URL', plugins_url('', __FILE__));
define('PHBOT_ASSETS_DIR', PHBOT_PATH. '/assets/');
define('PHBOT_ASSETS_URL', PHBOT_URL . '/assets/');


if (version_compare(PHP_VERSION, "5.3", "<")) {
    require_once(PHBOT_PATH . '/admin/notices.php');
    add_action('admin_notices', 'phbot_phpversion');
    return;
}


require_once 'boot.php';


if (defined('ABSPATH') && defined('WPINC')) {
  phbot_init();
}