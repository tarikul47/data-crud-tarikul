<?php

namespace Tarikul\DbCrud;

/**
 * Helper Class 
 */
class Helper
{
    /**
     * Constructor method 
     */
    public function __construct()
    {
        // define constant 
        $this->define_constant();
    }

    /**
     * Define all constant 
     */
    public function define_constant()
    {
        define('DB_CRUD_PLUGIN_DIR', plugin_dir_path(__DIR__));
        define('DB_CRUD_PLUGIN_FILE', plugin_dir_path(__DIR__) . '../db-crud.php');
        define('DB_CRUD_PLUGIN_ASSETS_URL', plugin_dir_url(__DIR__) . 'assets/');
    }
}