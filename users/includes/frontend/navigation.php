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

// Signup
$lang = array_merge($lang,array(
	"SIGNUP_TEXT"				=> "Create Account",
	"SIGNUP_BUTTONTEXT"				=> "Register Me",
	"SIGNUP_AUDITTEXT"				=> "Registered",
	));

// Signin
$lang = array_merge($lang,array(
	"SIGNIN_FAIL"				=> "** FAILED LOGIN **",
	"SIGNIN_TITLE"				=> "Please Log In",
	"SIGNIN_TEXT"				=> "Not Logged In",
	"SIGNOUT_TEXT"				=> "Log Out",
	"SIGNIN_BUTTONTEXT"				=> "Log In",
	"SIGNIN_AUDITTEXT"				=> "Logged In",
	"SIGNOUT_AUDITTEXT"				=> "Logged Out",
	));	

	
//Navigation
$lang = array_merge($lang,array(
	"NAVTOP_HELPTEXT"				=> "Help",
	));


	
?>
<!-- Navigation -->
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
<div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header ">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-top-menu-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  
		  <a class="navbar-brand" href="/"><img class="img-responsive" src="users/images/logo.png" alt="" /></a>
		
	</div>

    <div class="collapse navbar-collapse navbar-top-menu-collapse navbar-right">
    <ul class="nav navbar-nav ">

	   	<?php if($user->isLoggedIn()) 
			{ ?> 
        <li><a href="users/account.php"><i class="fa fa-fw fa-user text-success"></i> <?php echo $user->data()->username;?></a></li>
      <!--  <li class="hidden-sm hidden-md hidden-lg"><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li> -->
               <li class="hidden-sm hidden-md hidden-lg"><a href="users/profile.php?id=<?php echo $user->data()->id;?>"><i class="fa fa-fw fa-users"></i> Public Profile</a></li>      
	  <li class="hidden-sm hidden-md hidden-lg"><a href="users/account.php"><i class="fa fa-fw fa-user"></i> User Account</a></li>
        <li class="hidden-sm hidden-md hidden-lg"><a href="users/user_settings.php"><i class="fa fa-fw fa-pencil-square-o"></i> User Settings</a></li>
	
		<?php //Links for permission level 2 (default admin)
			if (checkMenu(2,$user->data()->id)){   ?>
				<li class="hidden-sm hidden-md hidden-lg"><a href="users/admin_users.php"><i class="fa fa-fw fa-users"></i> Manage Users</a></li>
				<li class="hidden-sm hidden-md hidden-lg"><a href="users/admin.php"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li>
				<li class="hidden-sm hidden-md hidden-lg divider"></li>
			<?php } // is user an admin ?>

		<li class="dropdown hidden-xs">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-fw fa-cog"></i> </a>
            <ul class="dropdown-menu">
			
			 <?php //Links for permission level 2 (default admin)
			if (checkMenu(2,$user->data()->id)){   ?>
				<li class=""><a href="users/admin_users.php"><i class="fa fa-fw fa-users"></i> Manage Users</a></li>
				<li class=""><a href="users/admin.php"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li>
				<li class="divider"></li>
			<?php } // is user an admin ?>
			 <!--  <li><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
			   <li class="divider"></li> -->
               <li><a href="users/profile.php?id=<?php echo $user->data()->id;?>"><i class="fa fa-fw fa-users"></i> Public Profile</a></li>
               <li><a href="users/account.php"><i class="fa fa-fw fa-user"></i> User Account</a></li>
               <li><a href="users/user_settings.php"><i class="fa fa-fw fa-pencil-square-o"></i> User Settings</a></li>
			<li><a href="users/logout.php"><i class="fa fa-fw fa-sign-out"></i> <?php echo lang("SIGNOUT_TEXT","");?></a></li>
            </ul>
        </li> 
		  <?php //Links for permission level 2 (default admin)
			if (checkMenu(2,$user->data()->id)){   ?> <!--

			<li class="hidden-sm hidden-md hidden-lg"><a href="admin_users.php"><i class="fa fa-fw fa-users"></i> Manage Users</a></li>
			<li class="hidden-sm hidden-md hidden-lg"><a href="admin.php"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li>

			<li class="hidden-xs"><a href="admin.php"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li>
			
			<li class="dropdown hidden-xs">
				<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-flask"></i> Admin Menu <b class="caret"></b></a>
				<ul class="dropdown-menu ">
					<li><a href="admin_users.php"><i class="fa fa-fw fa-users"></i> Manage Users</a></li>
					<li class="divider"></li>
					<li><a href="admin.php"><i class="fa fa-fw fa-cogs"></i> Admin Dashboard</a></li>
					<li><a href="admin.php"><i class="fa fa-fw fa-wrench"></i> Admin Configuration</a></li>
					<li><a href="admin_permissions.php"><i class="fa fa-fw fa-code"></i> Admin Permissions</a></li>
					<li><a href="admin_pages.php"><i class="fa fa-fw fa-newspaper-o"></i> Admin Pages</a></li>
					<li><a href="logout.php"><i class="fa fa-fw fa-sign-out"></i> <?php //echo lang("SIGNOUT_TEXT","");?></a></li>
				</ul>
			</li> -->
			<?php } // is user an admin ?>

		<li class="hidden-sm hidden-md hidden-lg"><a href="users/logout.php"><i class="fa fa-fw fa-sign-out"></i> <?php echo lang("SIGNOUT_TEXT","");?></a></li>

		<?php }
		else	{ // user is not and admin OR logged in
		?>
		<li class="disabled" ><a href="#" class=" text-muted"><i class="fa fa-user text-danger"></i> <?php echo lang("SIGNIN_TEXT","");?></a></li>
		<li><a href="users/join.php" class=""> <?php echo lang("SIGNUP_TEXT","");?></a></li>
		<li><a href="users/login.php" class=""><i class="fa fa-sign-in"></i> <?php echo lang("SIGNIN_BUTTONTEXT","");?></a></li>
		<!--<li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-life-ring"></i> <?php //echo lang("NAVTOP_HELPTEXT","");?></a>
            <ul class="dropdown-menu">
				<li><a href="users/forgot-password.php"><i class="fa fa-wrench"></i> Forgot Password</a></li>
				<li><a href="users/resend-activation.php"><i class="fa fa-exclamation-triangle"></i> Resend Activation Email</a></li>
            </ul>
        </li> -->
		<?php } ?>

    </ul>
    </div>



</div>
</div>
<?php
	
	

/*
<!-- Navigation -->
<div class="navbar navbar-fixed-top navbar-default" role="navigation">
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
  
  */
  ?>
