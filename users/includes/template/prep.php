<?php
$db = DB::getInstance();
$settings = $db->query("SELECT * FROM settings")->first();

require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/header.php'; //custom template header
require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/navigation.php'; //custom template nav
require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/container_open.php'; //custom template container