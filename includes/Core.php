<?php

namespace Tarikul\PostViewCount;

/**
 * Our Main Class 
 */
class Core
{
    /**
     * Constructor method 
     */
    public function __construct()
    {
        // activation and deactivation hook 
        register_activation_hook(__FILE__, [$this, "activate"]);
        register_deactivation_hook(__FILE__, [$this, "deactivate"]);

        // Initialize the plugin
        add_action('init', [$this, 'init']);
    }

    /**
     * Initialize the plugin.
     */
    public function init()
    {
        // assets class load 
        new Assets();

        // shortcode class load 
        new Shortcode();

        // column class load 
        new Column();

        // post view counter class load 
        new ViewCounter();
    }

    /**
     * Activation hook callback.
     */
    public function activate()
    {
        // Add activation logic here
    }

    /**
     * Deactivation hook callback.
     */
    public function deactivate()
    {
        // Add deactivation logic here
    }
}

