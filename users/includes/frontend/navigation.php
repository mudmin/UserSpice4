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
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">

    <!-- This is the hamburger menu. You may want to use it! -->
    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button> -->
  <a class="navbar-brand"href="index.php">Your Branding Here</a><img src="users/images/logo.png" alt="" />
</div>
<!-- Top Menu Items -->
<div class="nav navbar-right top-nav">

  <?php
  if($user->isLoggedIn()) {
  ?>
    <li class='dropdown'><a href='users/account.php' class='btn btn-default'>Account Info</a></li>

    <li class='dropdown'><a href='users/logout.php' class='btn btn-danger'>Sign Out</a></li>
    <?php
        if (checkMenu(2,$user->data()->id)){
    ?>
      <li class='dropdown'><a href='users/admin.php' class='btn btn-warning'>Admin Panel</a></li>

  <?php
}}else {
  ?>
    <p> <li class='dropdown'><a href='users/login.php' class='btn btn-info'>Sign In</a> </li>

    <li class='dropdown'><a href='users/join.php' class='btn btn-danger'>Sign Up</a></p></li>
  <?php
  }
  ?>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php 				//Links for logged in user
    if($user->isLoggedIn()) {
      echo $user->data()->username;
    }
    //Links for users not logged in
    else {
      echo "Account";
    }
    ?>
    <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <?php

      //Links for logged in user
      if($user->isLoggedIn()) {
        ?>

        <li>
          <a href='#'><i class='fa fa-fw fa-dashboard'></i> Logged in Link 1</a>
        </li>
        <li>
          <a href='#'><i class='fa fa-fw fa-pencil-square-o'></i> Logged in Link 2</a>
        </li>
        <?php    }
        //Links for users not logged in
        else {
          ?>
          <li>
            <a href='#'><i class='fa fa-fw fa-wrench'></i> Other Link 1</a>
          </li>
          <li>
            <a href='#'><i class='fa fa-fw fa-wrench'></i> Other Link 2</a>
          </li>

        </ul>
      </li>
<?php } ?>
      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    </div>

  </nav>
