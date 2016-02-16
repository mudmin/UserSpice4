<?php
/*
UserSpice 4
An Open Source PHP User Management System
by Curtis Parham and Dan Hoover at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
 ?>
 <?php require_once("core/init.php"); ?>
 <?php require_once("users/helpers/helpers.php"); ?>
 <?php $db = DB::getInstance(); ?>
 <?php
 $settingsQ = $db->query("Select * FROM settings");
 $settings = $settingsQ->first();
 if ($settings->site_offline==1){die("The site is currently offline.");}

 if ($settings->force_ssl==1){
   if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
     // if request is not secure, redirect to secure url
     $url = 'https://' . $_SERVER['HTTP_HOST']
                       . $_SERVER['REQUEST_URI'];
     Redirect::to($url);
     exit;
 }
 }

 if($settings->track_guest == 1){
 new_user_online();
 }
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
    <link href="users/<?=$settings->css1?>" rel="stylesheet">

    <!-- Template CSS -->
    <!-- AKA Secondary CSS -->
    <link href="users/<?=$settings->css2;?>" rel="stylesheet">

    <!-- Your Custom CSS Goes Here!-->
    <link href="users/<?=$settings->css3;?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="users/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
