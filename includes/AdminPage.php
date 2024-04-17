<?php

namespace Tarikul\DbCrud;

/**
 * Helper Class 
 */
class AdminPage extends Helper
{
    /**
     * Constructor method 
     */
    public function __construct()
    {
        //create an admin page
        add_action('admin_menu', [$this, 'add_admin_menu']);

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
        //   var_dump(get_admin_url() . 'admin.php');
        //  var_dump(add_query_arg('tab', 'list', get_admin_url('admin')));
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
}