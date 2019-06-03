<?php

if (!$_POST) {
    die();
}
require_once '../users/init.php';
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}
if ($user->isLoggedIn()) {


    /*
     * DataTables server-side processing script.
     *
     * Please note that this script is intentionally extremely simply to show how
     * server-side processing can be implemented, and probably shouldn't be used as
     * the basis for a large complex system. It is suitable for simple use cases as
     * for learning.
     *
     * See http://datatables.net/usage/server-side for full details on the server-
     * side processing requirements of DataTables.
     *
     * @license MIT - http://datatables.net/license_mit
     */

// DB table to use
    $table = input::get("table");

// Table's primary key
    $primaryKey = input::get("primary_key");

// Array of database columns which should be read and sent back to DataTables.
    $columns = $_POST['columns'];
// joins
    require( $abs_us_root . $us_url_root . 'users/SSP.php' );
    if ($_POST['extra'] == "admin_logs") {

        // Basic Join example, you can do this type of work using another query quite easily.
        $joinQuery = "FROM logs LEFT JOIN users on (users.id = logs.user_id)";
        $extraWhere = "logtype not in(select name from logs_exempt)";
        $group_by = "";
        
        echo json_encode(
                SSP::simple($_POST, $config['mysql'], $table, $primaryKey, $columns, $joinQuery, $extraWhere, $group_by));
    } else {
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        
        echo json_encode(
                SSP::simple($_POST, $config['mysql'], $table, $primaryKey, $columns));
    }
}
