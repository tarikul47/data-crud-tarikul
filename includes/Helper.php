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
     * Check if data is empty.
     *
     * @param mixed $data The data to check.
     * @return bool True if the data is empty, false otherwise.
     */
    public function is_empty($data)
    {
        return empty($data);
    }
    /**
     * Define all constant 
     */
    public function define_constant()
    {
        global $wpdb;
        define('DB_CRUD_PLUGIN_TBALE_NAME', $wpdb->prefix . 'db_crud');
        define('DB_CRUD_PLUGIN_DIR', plugin_dir_path(__DIR__));
        define('DB_CRUD_PLUGIN_FILE', plugin_dir_path(__DIR__) . '../db-crud.php');
        define('DB_CRUD_PLUGIN_ASSETS_URL', plugin_dir_url(__DIR__) . 'assets/');
    }

    /**
     * Sanitize and validate form data
     *
     * @param array $data The form data to sanitize and validate
     * @param array $fields An array mapping form field names to their respective sanitization/validation functions
     * @return array|false Sanitized and validated form data, or false if validation fails
     */
    public function sanitize_and_validate_form_data($data, $fields)
    {
        $sanitized_data = array();

        foreach ($fields as $field_name => $sanitize_callback) {
            if (isset($data[$field_name])) {
                $sanitized_value = call_user_func($sanitize_callback, $data[$field_name]);
                // Check if the sanitized value is empty after sanitization
                if ($sanitized_value === '') {
                    return false;
                }
                $sanitized_data[$field_name] = $sanitized_value;
            } else {
                // Field is missing
                return false;
            }
        }

        return $sanitized_data;
    }


    /**
     * Get a row by id 
     */
    public function get_data_into_database($id)
    {
        global $wpdb;
        $prepared_statement = $wpdb->prepare("SELECT * FROM " . DB_CRUD_PLUGIN_TBALE_NAME . " WHERE id = %d", $id);
        $row = $wpdb->get_row($prepared_statement, ARRAY_A);
        return $row;
    }

    /**
     * Insert data into the database
     */
    public function insert_data_into_database($data)
    {
        global $wpdb;
        $wpdb->insert(DB_CRUD_PLUGIN_TBALE_NAME, $data, array('%s', '%s'));
    }

    /**
     * Update data in the database
     */
    public function update_data_in_database($data)
    {
        // Check if ID is set and numeric
        $id = isset($_POST['id']) ? absint($_POST['id']) : 0;
        if ($id > 0) {
            global $wpdb;
            $wpdb->update(DB_CRUD_PLUGIN_TBALE_NAME, $data, array('id' => $id), array('%s', '%s'), array('%d'));
        }
    }
}