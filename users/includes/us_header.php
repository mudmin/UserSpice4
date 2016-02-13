<?php
ob_start();
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("../core/init.php"); ?>
<?php require_once("helpers/helpers.php"); ?>
<?php $db = DB::getInstance(); ?>
<?php
$settingsQ = $db->query("Select * FROM settings");
$settings = $settingsQ->first();
//dnd($settings);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to UserSpice</title>

    <!-- Bootstrap Core CSS -->
    <!-- AKA Primary CSS -->
    <link href="<?=$settings->us_css1?>" rel="stylesheet">

    <!-- Template CSS -->
    <!-- AKA Secondary CSS -->
    <link href="<?=$settings->us_css2;?>" rel="stylesheet">

    <!-- Your Custom CSS Goes Here!-->
    <link href="<?=$settings->us_css3;?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
