<?php
require_once("init.php");

//For security purposes, it is MANDATORY that this page be wrapped in the following
//if statement. This prevents remote execution of this code.
if (in_array($user->data()->id, $master_account)){
$db = DB::getInstance();
include "plugin_info.php";

    err($plugin_name.' uninstalled');
    logger($user->data()->id,"USPlugins", $plugin_name. " uninstalled");

} //do not perform actions outside of this statement
