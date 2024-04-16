<?php

namespace Tarikul\DbCrud;

/**
 * Assets Class 
 */
class Assets extends Helper
{
    /**
     * Constructor method 
     */
    public function __construct()
    {
        parent::__construct(); // Call the constructor of the parent class
        // assets enqueue 
        add_action('admin_enqueue_scripts', [$this, 'load_assets']);
    }

    /**
     * Assets load 
     */
    public function load_assets()
    {
        wp_enqueue_style('db-crud-style', DB_CRUD_PLUGIN_ASSETS_URL . 'css/style.css', [], '1.0');
        wp_enqueue_script('dib-crud-script', DB_CRUD_PLUGIN_ASSETS_URL . 'js/script.js', [], '1.0', true);
    }
}