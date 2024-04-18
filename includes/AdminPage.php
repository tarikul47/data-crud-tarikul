<?php

namespace Tarikul\DbCrud;

/**
 * Helper Class 
 */
class AdminPage extends Helper
{
    private $table_name;
    /**
     * Constructor method 
     */
    public function __construct()
    {
        //create an admin page
        add_action('admin_menu', [$this, 'add_admin_menu']);
        // Handle form submissions
        $this->handle_form_submission();
        add_action('wp_ajax_db_crud_delete_entry', [$this, 'handle_ajax_delete_entry']);

    }
    /**
     * Admin Page Create
     */
    function add_admin_menu()
    {
        add_menu_page('DB Crud', 'DB Crud', 'manage_options', 'db-crud', [$this, 'admin_page'], 'dashicons-admin-generic', 25);
        add_submenu_page('db-crud', 'DB Crud List', 'Data List', 'manage_options', 'db-crud', [$this, 'admin_page']);
        add_submenu_page('db-crud', 'Add New Data', 'Add New Data', 'manage_options', 'db-crud&tab=add', [$this, 'admin_page']);
    }

    /**
     * Admin Page content
     */

    function admin_page()
    {
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'list';
        ?>
        <!-- Tabs -->
        <div class="mx-6 mt-6">
            <ul class="flex flex-wrap border-b border-gray-200 dark:border-gray-700">
                <li class="mr-2 <?php echo $active_tab === 'list' ? ' bg-gray-100' : '' ?>">
                    <a href="
                    <?php
                    echo add_query_arg(
                        [
                            'page' => 'db-crud',
                            'tab' => 'list'
                        ],
                        get_admin_url() . 'admin.php'
                    ) ?>
                    "
                        class="inline-block text-blue-600 hover:text-blue-700 hover:bg-gray-50 rounded-t-lg py-4 px-4 text-sm font-medium text-center">Data
                        List</a>
                </li>
                <li class="mr-2 <?php echo $active_tab === 'add' ? ' bg-gray-100' : '' ?>">
                    <a href="
                    <?php
                    echo add_query_arg(
                        [
                            'page' => 'db-crud',
                            'tab' => 'add'
                        ],
                        get_admin_url() . 'admin.php'
                    ) ?>
                    "
                        class="inline-block text-blue-600  hover:text-blue-700 hover:bg-gray-50 rounded-t-lg py-4 px-4 text-sm font-medium text-center">Add
                        New Data</a>
                </li>
            </ul>
            <div class="px-1 py-2">
                <?php
                switch ($active_tab) {
                    case 'add':
                        # code...
                        $form_file = DB_CRUD_PLUGIN_DIR . 'templates/add-form.php';
                        if (file_exists($form_file)) {
                            require_once $form_file;
                        } else {
                            esc_html_e('File Doesn\'t exist', 'db-crud');
                        }
                        break;

                    default:
                        # code...
                        $form_file = DB_CRUD_PLUGIN_DIR . 'templates/list-data.php';
                        if (file_exists($form_file)) {
                            require_once $form_file;
                        } else {
                            esc_html_e('File Doesn\'t exist', 'db-crud');
                        }
                        break;
                }
                ?>
            </div>
        </div>
        <?php
    }


    public function handle_form_submission()
    {
        // Verify nonce and user capabilities
        if (!isset($_POST['db_crud_nonce']) || !wp_verify_nonce($_POST['db_crud_nonce'], 'db_crud') || !current_user_can('manage_options')) {
            return;
        }

        // Define the fields to sanitize and validate
        $fields = array(
            'name' => 'sanitize_text_field',
            'email' => 'sanitize_email'
        );

        // Sanitize and validate the form data
        $sanitized_data = $this->sanitize_and_validate_form_data($_POST, $fields);

        // Check if form data is valid
        if ($sanitized_data === false) {
            return;
        }

        // Determine the action mode (submit or update)
        $action_mode = isset($_POST['submit']) ? 'submit' : (isset($_POST['update']) ? 'update' : '');

        switch ($action_mode) {
            case 'submit':
                // Insert data into the database
                $this->insert_data_into_database($sanitized_data);
                break;
            case 'update':
                // Update data in the database
                $this->update_data_in_database($sanitized_data);
                break;
            default:
                // Invalid action mode
                return;
        }

        // Redirect back to the admin page after form submission
        wp_redirect(admin_url('admin.php?page=db-crud'));
        exit;
    }

    function handle_ajax_delete_entry()
    {
        error_log('Delete entry callback executed'); // Debugging statement

        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            // Sanitize the ID
            $entry_id = sanitize_text_field($_POST['id']);

            // Perform the deletion here
            // Example: Delete the entry with the provided ID from the database
            global $wpdb;
            $result = $wpdb->delete(
                DB_CRUD_PLUGIN_TBALE_NAME,
                array('id' => $entry_id),
                array('%d')
            );

            // Send response back to the client-side JavaScript
            if ($result !== false) {
                // Deletion was successful
                wp_send_json_success(
                    [
                        'new_url' => admin_url('admin.php?page=db-crud&succeess=true')
                    ]
                );
            } else {
                // Deletion failed
                wp_send_json_error(array('message' => 'Failed to delete entry'));
            }
        } else {
            // Invalid request
            wp_send_json_error(array('message' => 'Invalid request'));
        }
    }


}