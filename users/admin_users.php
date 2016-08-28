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
//PHP Goes Here!
$errors = [];
$successes = [];
$form_valid=FALSE;
$permOpsQ = $db->query("SELECT * FROM permissions");
$permOps = $permOpsQ->results();
// dnd($permOps);

//Forms posted
if (!empty($_POST)){
  //Delete User Checkboxes
  if (!empty($_POST['delete'])){
    $deletions = $_POST['delete'];
    if ($deletion_count = deleteUsers($deletions)){
      $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
    }
    else {
      $errors[] = lang("SQL_ERROR");
    }
  }
  //Manually Add User
  if(!empty($_POST['addUser']))
  {
    $join_date = date("Y-m-d H:i:s");
    $username = Input::get('username');
  	$fname = Input::get('fname');
  	$lname = Input::get('lname');
  	$email = Input::get('email');
    $perm = Input::get('perm');
    $token = $_POST['csrf'];

  if(!Token::check($token)){
    die('Token doesn\'t match!');
  }

  $validation = new Validate();
  $validation->check($_POST,array(
    'username' => array(
    'display' => 'Username',
    'required' => true,
    'min' => 5,
    'max' => 35,
    'unique' => 'users',
    ),
    'fname' => array(
    'display' => 'First Name',
    'required' => true,
    'min' => 2,
    'max' => 35,
    ),
    'lname' => array(
    'display' => 'Last Name',
    'required' => true,
    'min' => 2,
    'max' => 35,
    ),
    'email' => array(
    'display' => 'Email',
    'required' => true,
    'valid_email' => true,
    'unique' => 'users',
    ),
    'password' => array(
    'display' => 'Password',
    'required' => true,
    'min' => 6,
    'max' => 25,
    ),
    'confirm' => array(
    'display' => 'Confirm Password',
    'required' => true,
    'matches' => 'password',
    ),
  ));
  	if($validation->passed()) {
		$form_valid=TRUE;
      try {
        // echo "Trying to create user";
        $fields=array(
          'username' => Input::get('username'),
          'fname' => Input::get('fname'),
          'lname' => Input::get('lname'),
          'email' => Input::get('email'),
          'password' =>
          password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
          'permissions' => 1,
          'account_owner' => 1,
          'stripe_cust_id' => '',
          'join_date' => $join_date,
          'company' => Input::get('company'),
          'email_verified' => 1,
          'active' => 1,
          'vericode' => 111111,
        );
        $db->insert('users',$fields);
        $theNewId=$db->lastId();
        // bold($theNewId);
        $addNewPermission = array('user_id' => $theNewId, 'permission_id' => $perm);
        $db->insert('user_permission_matches',$addNewPermission);

      } catch (Exception $e) {
        die($e->getMessage());
      }

    }
}

}

$userData = fetchAllUsers(); //Fetch information for all users


?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">

	    <div class="col-xs-12 col-md-6">
		<h1>Manage Users</h1>
	  </div>

	  <div class="col-xs-12 col-md-6">
			<form class="">
				<label for="system-search">Search:</label>
				<div class="input-group">
                    <input class="form-control" id="system-search" name="q" placeholder="Search Users..." type="text">
                    <span class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-times"></i></button>
                    </span>
                </div>
			</form>
		  </div>

        </div>


				 <div class="row">
		     <div class="col-md-12">
          <?php echo resultBlock($errors,$successes);
				?>

							 <hr />
               <div class="row">
               <div class="col-xs-12">
               <?php
               if (!$form_valid && Input::exists()){
               	echo display_errors($validation->errors());
               }
               ?>

               <form class="form-signup" action="admin_users.php" method="POST" id="payment-form">

               	<h3 class="form-signin-heading"> Manually Add a New
                <select name="perm">
                  <?php

                  foreach ($permOps as $permOp){
                    echo "<option value='$permOp->id'>$permOp->name</option>";
                  }
                  ?>
                  </select>
                  </h3>

               	<div class="form-group">
                  <div class="col-xs-2">
               		<input  class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required autofocus>
</div>
                  <div class="col-xs-2">
               		<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required>
</div>
                  <div class="col-xs-2">
               		<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required>
</div>
                  <div class="col-xs-2">
               		<input  class="form-control" type="text" name="email" id="email" placeholder="Email Address" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required >
</div>
                  <div class="col-xs-2">
               		<input  class="form-control" type="password" name="password" id="password" placeholder="Password" required aria-describedby="passwordhelp">
</div>
                  <div class="col-xs-2">
               		<input  type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirm Password" required >
</div>
               	</div>


               	<input type="hidden" value="<?=Token::generate();?>" name="csrf">
	            <input class='btn btn-primary' type='submit' name='addUser' value='Manually Add User' />
               </form>
               </div>
               </div>
        <div class="row">
        <div class="col-xs-12">
				 <div class="alluinfo">&nbsp;</div>
				<form name="adminUsers" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				 <div class="allutable table-responsive">
					<table class='table table-hover table-list-search'>
					<thead>
					<tr>
						<th>Delete</th><th>Username</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Join Date</th><th>Last Sign In</th><th>Logins</th>
					 </tr>
					</thead>
				 <tbody>
					<?php
					//Cycle through users
					foreach ($userData as $v1) {
							?>
					<tr>
					<td><div class="form-group"><input type="checkbox" name="delete[<?=$v1->id?>]" value="<?=$v1->id?>" /></div></td>
					<td><a href='admin_user.php?id=<?=$v1->id?>'><?=$v1->username?></a></td>
					<td><?=$v1->email?></td>
					<td><?=$v1->fname?></td>
					<td><?=$v1->lname?></td>
					<td><?=$v1->join_date?></td>
					<td><?=$v1->last_login?></td>
					<td><?=$v1->logins?></td>
					</tr>
							<?php } ?>

				  </tbody>
				</table>
				</div>


				<input class='btn btn-danger' type='submit' name='Submit' value='Delete' /><br><br>
				</form>

		  </div>
		</div>


  </div>
</div>


	<!-- End of main content section -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
