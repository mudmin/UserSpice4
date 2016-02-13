<?php
//Your Application Details
$app_name = "InstallSpice";
$app_ver = "0.1a"; //Feel free to leave this as an empty string.

//The name of your configuration file
$config_file = "init.php";

$sqlfile = "install/includes/sql.sql";

//Navigation Settings
$step1 = "Welcome";
$step2 = "Path Setup";
$step3 = "Database Settings";
$step4 = "ReCAPTCHA Settings";
$step5 = "Cleanup";

//System Requirements
$php_ver = "5.5.0";

//Cleanup Files
$files = array (
"index.php",
"recovery.php",
"step2.php",
"step3.php",
"step4.php",
"step5.php"
);

//Where do you want to redirect after cleanup?
$redirect = "../index.php";


 ?>
