<?php
namespace Tarikul\DbCrud;

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
        // Assets class load 
        new Assets();

        //  Admin Page load 
        new AdminPage();
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

