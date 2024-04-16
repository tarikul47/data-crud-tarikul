<?php
/**
 * Plugin Name: DB Crud
 * Plugin URI: https://onlytarikul.com/project/post-view-count
 * Description: Showing Post View Number by Specific Post shortcode. 
 * Author: Tarikul Islam
 * Version: 1.0.0
 * Author URI: https://onlytarikul.com
 * Text Domain: db-crud
 *
 * @since      1.0.0
 * @package    DB Crud
 * @author     Tarikul Islam
 */

/*
 * If this file is called directly, abort.
 */
if (!defined('ABSPATH')) {
    exit;
}

require "vendor/autoload.php";

use Tarikul\DbCrud\Core;

/**
 * Main class Initialize 
 */
if (!class_exists('Core')) {
    new Core();
}
