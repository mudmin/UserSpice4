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
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$validation = new Validate();
//PHP Goes Here!
$errors = [];
$successes = [];
$userId = $_GET['id'];
//Check if selected user exists
if(!userIdExists($userId)){
  Redirect::to("admin_users.php"); die();
}

$userdetails = fetchUserDetails(NULL, NULL, $userId); //Fetch user details

//Forms posted
if(!empty($_POST)) {
    $token = $_POST['csrf'];
    if(!Token::check($token)){
      die('Token doesn\'t match!');
    }else {

    //Update display name

    if ($userdetails->username != $_POST['username']){
      $displayname = Input::get("username");

      $fields=array('username'=>$displayname);
      $validation->check($_POST,array(
        'username' => array(
          'display' => 'Username',
          'required' => true,
          'unique_update' => 'users,'.$userId,
          'min' => 1,
          'max' => 25
        )
      ));
    if($validation->passed()){
      $db->update('users',$userId,$fields);
     $successes[] = "Username Updated";
    }else{

      }
    }

    //Update first name

    if ($userdetails->fname != $_POST['fname']){
       $fname = Input::get("fname");

      $fields=array('fname'=>$fname);
      $validation->check($_POST,array(
        'fname' => array(
          'display' => 'First Name',
          'required' => true,
          'min' => 1,
          'max' => 25
        )
      ));
    if($validation->passed()){
      $db->update('users',$userId,$fields);
      $successes[] = "First Name Updated";
    }else{
          ?><div id="form-errors">
            <?=$validation->display_errors();?></div>
            <?php
      }
    }

    //Update last name

    if ($userdetails->lname != $_POST['lname']){
      $lname = Input::get("lname");

      $fields=array('lname'=>$lname);
      $validation->check($_POST,array(
        'lname' => array(
          'display' => 'Last Name',
          'required' => true,
          'min' => 1,
          'max' => 25
        )
      ));
    if($validation->passed()){
      $db->update('users',$userId,$fields);
      $successes[] = "Last Name Updated";
    }else{
          ?><div id="form-errors">
            <?=$validation->display_errors();?></div>
            <?php
      }
    }

    //Block User
    if ($userdetails->permissions != $_POST['active']){
      $active = Input::get("active");
      $fields=array('permissions'=>$active);
      $db->update('users',$userId,$fields);
    }

    //Update email
    if ($userdetails->email != $_POST['email']){
      $email = Input::get("email");
      $fields=array('email'=>$email);
      $validation->check($_POST,array(
        'email' => array(
          'display' => 'Email',
          'required' => true,
          'valid_email' => true,
          'unique_update' => 'users,'.$userId,
          'min' => 3,
          'max' => 75
        )
      ));
    if($validation->passed()){
      $db->update('users',$userId,$fields);
      $successes[] = "Email Updated";
    }else{
          ?><div id="form-errors">
            <?=$validation->display_errors();?></div>
            <?php
      }

    }

    //Remove permission level
    if(!empty($_POST['removePermission'])){
      $remove = $_POST['removePermission'];
      if ($deletion_count = removePermission($remove, $userId)){
        $successes[] = lang("ACCOUNT_PERMISSION_REMOVED", array ($deletion_count));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }

    if(!empty($_POST['addPermission'])){
      $add = $_POST['addPermission'];
      if ($addition_count = addPermission($add, $userId,'user')){
        $successes[] = lang("ACCOUNT_PERMISSION_ADDED", array ($addition_count));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
  }
    $userdetails = fetchUserDetails(NULL, NULL, $userId);
  }


$userPermission = fetchUserPermissions($userId);
$permissionData = fetchAllPermissions();

$grav = get_gravatar(strtolower(trim($userdetails->email)));
$useravatar = '<img src="'.$grav.'" class="img-responsive img-thumbnail" alt="">';
//
?>
<div id="page-wrapper">

  <div class="container">

       <?php    echo resultBlock($errors,$successes); ?>
      <?=$validation->display_errors();?>
  	<h1><?=$userdetails->username?></h1>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->

			  <div class="well text-center hidden-xs"><?php echo $useravatar;?></div>

          <div class="panel panel-default hidden-xs">
            <div class="panel-heading">User Info <i class="fa fa-link fa-1x"></i></div>
				 <ul class="list-group">
					<li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span> <?=$userdetails->join_date?></li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Last seen</strong></span> <?=$userdetails->last_login?></li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Full name</strong></span> <?=$userdetails->fname?> <?=$userdetails->lname?></li>
				  </ul>
          </div>

          <div class="panel panel-default hidden-xs">
            <div class="panel-heading">Email <i class="fa fa-link fa-1x"></i></div>
			 <ul class="list-group">
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?=$userdetails->email?></li>
			</ul>
          </div>


          <div class="panel panel-default hidden-xs">
            <div class="panel-heading">Activity <i class="fa fa-link fa-1x"></i></div>
				 <ul class="list-group">
            <li class="list-group-item text-right"><span class="pull-left"><strong>Logins</strong></span> <?=$userdetails->logins?></li>
          </ul>
           </div>

        </div><!--/col-3-->

    	<div class="col-sm-9">

          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#perms" data-toggle="tab">Permissions</a></li>
            <li><a href="#info" data-toggle="tab">User Info</a></li>
          </ul>
     		<form class="form-inline" name='adminUser' action='<?=$_SERVER['PHP_SELF']?>?id=<?=$userId?>' method='post'>
          <div class="tab-content">


		 <div class="tab-pane active" id="perms">
		   <?php include("views/userspice/_admin_user2.php");
          ?>
			</div>

		 <div class="tab-pane" id="info">
		   <?php include("views/userspice/_admin_user.php");
          ?>
			</div>
		    <input type="hidden" name="csrf" value="<?=Token::generate();?>" >
			<label>&nbsp;</label>
			<input class='btn btn-primary' type='submit' value='Update' class='submit' />
			<a class='btn btn-warning' href="admin_users.php">Cancel</a>
		</form>
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

  </div>
  </div>


<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
