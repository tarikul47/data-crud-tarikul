<?php
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
global $wpdb;
$row = [];
if ($id > 0) {
    // Example query to fetch one row from the table
    $row = $this->get_data_into_database($id);
}
?>

<h3 class=" py-4 text-lg text-center font-semibold"><?php echo $id ? 'Update Data' : 'Add New Data'; ?></h3>
<form class="max-w-md mx-auto" method="post">
    <?php wp_nonce_field('db_crud', 'db_crud_nonce');
    ?>
    <input type="hidden" name="action" value="db_crud">
    <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="name" id="floating_first_name"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" />
        <label for="floating_first_name"
            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="email" name="email" id="floating_email"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" />
        <label for="floating_email"
            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
            address</label>
    </div>
    <input type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        value="<?php echo $id ? 'Update' : 'Submit'; ?>" name="<?php echo $id ? 'update' : 'submit'; ?>" />
</form>