<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

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
$userId = Input::get('id');
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

<?=resultBlock($errors,$successes);?>
<?=$validation->display_errors();?>


<div class="row">
	<div class="col-xs-12 col-sm-2"><!--left col-->
	<?php echo $useravatar;?>
	</div><!--/col-2-->

	<div class="col-xs-12 col-sm-10">
	<form class="form" name='adminUser' action='admin_user.php?id=<?=$userId?>' method='post'>

	<h3>User Information</h3>
	<div class="panel panel-default">
	<div class="panel-heading">User ID: <?=$userdetails->id?></div>
	<div class="panel-body">

	<label>Joined: </label> <?=$userdetails->join_date?><br/>

	<label>Last seen: </label> <?=$userdetails->last_login?><br/>

	<label>Logins: </label> <?=$userdetails->logins?><br/>

	<label>Username:</label>
	<input  class='form-control' type='text' name='username' value='<?=$userdetails->username?>' />

	<label>Email:</label>
	<input class='form-control' type='text' name='email' value='<?=$userdetails->email?>' />

	<label>First Name:</label>
	<input  class='form-control' type='text' name='fname' value='<?=$userdetails->fname?>' />

	<label>Last Name:</label>
	<input  class='form-control' type='text' name='lname' value='<?=$userdetails->lname?>' />

	</div>
	</div>

	<h3>Permissions</h3>
	<div class="panel panel-default">
		<div class="panel-heading">Remove These Permission(s):</div>
		<div class="panel-body">
		<?php
		//NEW List of permission levels user is apart of

		$perm_ids = [];
		foreach($userPermission as $perm){
			$perm_ids[] = $perm->permission_id;
		}

		foreach ($permissionData as $v1){
		if(in_array($v1->id,$perm_ids)){ ?>
		  <input type='checkbox' name='removePermission[]' id='removePermission[]' value='<?=$v1->id;?>' /> <?=$v1->name;?>
		<?php
		}
		}
		?>

		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">Add These Permission(s):</div>
		<div class="panel-body">
		<?php
		foreach ($permissionData as $v1){
		if(!in_array($v1->id,$perm_ids)){ ?>
		  <input type='checkbox' name='addPermission[]' id='addPermission[]' value='<?=$v1->id;?>' /> <?=$v1->name;?>
			<?php
		}
		}
		?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">Miscellaneous:</div>
		<div class="panel-body">
		<label> Block?:</label>
		<select name="active" class="form-control">
			<option <?php if ($userdetails->permissions==1){echo "selected='selected'";} ?> value="1">No</option>
			<option <?php if ($userdetails->permissions==0){echo "selected='selected'";} ?>value="0">Yes</option>
		</select>
		</div>
	</div>

	<input type="hidden" name="csrf" value="<?=Token::generate();?>" />
	<input class='btn btn-primary' type='submit' value='Update' class='submit' />
	<a class='btn btn-warning' href="admin_users.php">Cancel</a><br><br>

	</form>

	</div><!--/col-9-->
</div><!--/row-->

</div>
</div>


<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
