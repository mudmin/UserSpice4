<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">

    <!-- This is the hamburger menu. You may want to use it! -->
    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button> -->
  <a class="navbar-brand"href="account.php">Version 4.0a</a><img src="images/logo.png" alt="" />
</div>
<!-- Top Menu Items -->
<div class="nav navbar-right top-nav">

  <?php
  if($user->isLoggedIn()) {
  ?>
    <li class='dropdown'><a href='account.php' class='btn btn-primary'>Account Info</a></li>

    <li class='dropdown'><a href='logout.php' class='btn btn-danger'>Sign Out</a></li>

  <?php
      if (checkMenu(2,$user->data()->id)){
  ?>
    <li class='dropdown'><a href='admin.php' class='btn btn-warning'>Admin Panel</a></li>
<?php
  }}else {
  ?>
    <p> <li class='dropdown'><a href='login.php' class='btn btn-success'>Sign In</a> </li>

    <li class='dropdown'><a href='join.php' class='btn btn-danger'>Sign Up</a></p></li>
  <?php
  }
  ?>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php
    //Links for logged in user
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
          <a href='account.php'><i class='fa fa-fw fa-dashboard'></i> Account Home</a>
        </li>
        <li>
          <a href='user_settings.php'><i class='fa fa-fw fa-pencil-square-o'></i> User Settings</a>
        </li>
        <!-- <li>
        <a href='logout.php'><i class='fa fa-fw fa-angellist'></i> Logout</a>
      </li> -->


      <?php
      //Links for permission level 2 (default admin)
      //if ($loggedInUser->checkPermission(array(2))){
      ?>
      <li>
        <a href='admin_users.php'><i class='fa fa-fw fa-users'></i> Admin Users</a>
      </li>
      <li>
        <a href='admin_permissions.php'><i class='fa fa-fw fa-code'></i> Admin Permissions</a>
      </li>
      <li>
        <a href='admin_pages.php'><i class='fa fa-fw fa-newspaper-o'></i> Admin Pages</a>
      </li>
      <?php
    }
    // }
    //Links for users not logged in
    else {
      ?>

      <!-- <li>
      <a href='login.php'><i class='fa fa-fw fa-wrench'></i> Login</a>
    </li>
    <li>
    <a href='register.php'><i class='fa fa-fw fa-desktop'></i> Register</a>
  </li> -->
  <li>
    <a href='forgot-password.php'><i class='fa fa-fw fa-wrench'></i> Forgot Password</a>
  </li>
  <?php
  //   if ($emailActivation)
  //   {
  //   echo "
  //   <li class='divider'></li>
  //   <li><a href='resend-activation.php'>Resend Activation Email</a></li>";
  //   }
  //   echo "</ul>";
}

?>
  </ul>
</li>

<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
</div>

</nav>
