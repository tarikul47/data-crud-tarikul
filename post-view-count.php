<?php
/**
 * Plugin Name: Post View Count
 * Plugin URI: https://onlytarikul.com/project/post-view-count
 * Description: Showing Post View Number by Specific Post shortcode. 
 * Author: Tarikul Islam
 * Version: 1.0.0
 * Author URI: https://onlytarikul.com
 * Text Domain: post-view-count
 *
 * @since      1.0.0
 * @package    Post View Count
 * @author     Tarikul Islam
 */

/*
 * If this file is called directly, abort.
 */
if (!defined('ABSPATH')) {
    exit;
}

require "vendor/autoload.php";

use Tarikul\PostViewCount\Core;

/**
 * Main class Initialize 
 */
if (!class_exists('Core')) {
    new Core();
}
