<?php
namespace Tarikul\DbCrud;

/**
 * Our Main Class 
 */
class Core extends Helper
{
    private $plugin_file;
    private $plugin_version;
    //   private $table_name;
    /**
     * Constructor method 
     */
    public function __construct($plugin_file)
    {
        global $wpdb;
        $this->plugin_file = $plugin_file;
        $this->plugin_version = '1.0.0';
        // activation and deactivation hook 
        register_activation_hook($this->plugin_file, [$this, "activate"]);
        register_deactivation_hook($this->plugin_file, [$this, "deactivate"]);

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

        $get_version = get_option('db_curd_version');

        if ($get_version != $this->plugin_version) {
            $this->create_database_tables();
            update_option('db_curd_version', $this->plugin_version);
        }
    }

    /**
     * Deactivation hook callback.
     */
    public function deactivate()
    {
        // Add deactivation logic here
    }

    /**
     * Database table create 
     */
    public function create_database_tables()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        // SQL query to create the table
        $sql = "CREATE TABLE DB_CRUD_PLUGIN_TBALE_NAME (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        // Include WordPress upgrade.php for dbDelta function
        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

        // Execute the SQL query to create the table
        dbDelta($sql);

        // Check if the table was created successfully
        if ($wpdb->get_var("SHOW TABLES LIKE DB_CRUD_PLUGIN_TBALE_NAME") != DB_CRUD_PLUGIN_TBALE_NAME) {
            error_log("Error creating database table - Table DB_CRUD_PLUGIN_TBALE_NAME not created.");
        } else {
            // Insert demo data into the table
            $wpdb->insert(
                DB_CRUD_PLUGIN_TBALE_NAME,
                array(
                    'name' => 'John Doe',
                    'email' => 'john@example.com'
                )
            );

            $wpdb->insert(
                DB_CRUD_PLUGIN_TBALE_NAME,
                array(
                    'name' => 'Jane Smith',
                    'email' => 'jane@example.com'
                )
            );
        }
    }
}

