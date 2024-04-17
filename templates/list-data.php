<?php
global $wpdb;
$data = $wpdb->get_results(
    "SELECT * FROM wp_db_crud",
    ARRAY_A
);

if (empty($data)) {
    ?>
    <h3 class="text-lg font-semibold"><?php esc_html_e('There is no data', 'db-crud'); ?></h3>
    <?php
    return;
}
?>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) { ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $row['id']; ?>
                    </th>
                    <td class="px-6 py-4">
                        <?php echo $row['name']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $row['email']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <a href="<?php
                        echo add_query_arg(
                            [
                                'page' => 'db-crud',
                                'tab' => 'add',
                                'id' => $row['id']
                            ],
                            get_admin_url() . 'admin.php'
                        ) ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="" class="delete-entry" data-id="<?php echo $row['id']; ?>"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>