<?php

namespace Tarikul\DbCrud;

/**
 * Helper Class 
 */
class AdminPage
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
        add_submenu_page('db-crud', 'DB Crud List', 'List', 'manage_options', 'db-crud&tab=list', [$this, 'admin_page']);
    }

    /**
     * Admin Page content
     */

    function admin_page()
    {
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'list';
        var_dump($active_tab);
        ?>
        <!-- Tabs -->
        <div class="mx-6 mt-6">
            <ul class="flex flex-wrap border-b border-gray-200 dark:border-gray-700">
                <li class="mr-2 bg-gray-100">
                    <a href="#"
                        class="inline-block text-blue-600 hover:text-blue-700 hover:bg-gray-50 rounded-t-lg py-4 px-4 text-sm font-medium text-center">Data
                        List</a>
                </li>
                <li class="mr-2 inactive">
                    <a href="#"
                        class="inline-block text-blue-600  hover:text-blue-700 hover:bg-gray-50 rounded-t-lg py-4 px-4 text-sm font-medium text-center">Add
                        New Data</a>
                </li>
            </ul>
            <div class="px-1 py-2">
                <h3 class="text-lg font-semibold">Data List</h3>
            </div>
            <div class="hidden px-1 py-2">
                <h3 class="text-lg font-semibold">Add New Data</h3>
            </div>
        </div>
        <?php
    }
}