<?php

namespace Tarikul\PostViewCount;

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
        define('POST_VIEW_COUNT_PLUGIN_DIR', plugin_dir_url(__DIR__));
        define('POST_VIEW_COUNT_PLUGIN_ASSETS_URL', plugin_dir_url(__DIR__) . 'assets/');
    }
}