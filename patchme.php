<?php
//This patch will patch your database from UserSpice 4.1.2 to 4.1.3
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';

$updateQ = $db->query("alter table users_online change username user_id  int(10)");
bold ("<br><br>You're good to go.  Delete this file and bask in the glory that is UserSpice 4.1.3");
?>
