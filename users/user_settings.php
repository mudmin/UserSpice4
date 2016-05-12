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
<?php require_once("includes/userspice/us_header.php"); ?>
<!-- stuff can go here -->

<?php require_once("includes/userspice/us_navigation.php"); ?>

<?php
if (!securePage($_SERVER['PHP_SELF'])){die();}

if ($settings->site_offline==1){die("The site is currently offline.");}?>
<?php
//Temporary Success Message
$holdover = Input::get('success');
if($holdover == 'true'){
  bold("Account Updated");
}
//PHP Goes Here!
$errors=[];
$successes=[];
$userId = $user->data()->id;
$grav = get_gravatar(strtolower(trim($user->data()->email)));
// dnd($user->data());
$validation = new Validate();
$userdetails=$user->data();
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
      echo "Username Updated";
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
      echo "First Name Updated";
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
      echo "Last Name Updated";
    }else{
          ?><div id="form-errors">
            <?=$validation->display_errors();?></div>
            <?php
      }
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
      echo "Email Updated";
    }else{
          ?><div id="form-errors">
            <?=$validation->display_errors();?></div>
            <?php
      }

    }

    if(!empty($_POST['password'])) {
      $validation->check($_POST,array(
        'old' => array(
          'display' => 'Old Password',
          'required' => true,
        ),
        'password' => array(
          'display' => 'New Password',
          'required' => true,
          'min' => 6,
        ),
        'confirm' => array(
          'display' => 'Confirm New Password',
          'required' => true,
          'matches' => 'password',
        ),
      ));
      $errors = $validation->errors();
      if (!password_verify(Input::get('old'),$user->data()->password)) {
        $errors[] = 'Your password does not match our records.';
      }
      if (empty($errors)) {
        //process
        $new_password_hash = password_hash(Input::get('password'),PASSWORD_BCRYPT,array('cost' => 12));
        $user->update(array(
          'password' => $new_password_hash,
        ),$user->data()->id);


        // die();
      }
    }
    }
    Redirect::to('user_settings.php?success=true');
}

?>
 <div id="page-wrapper">
		 <div class="container">


		 
		 <div class="well">
					<div class="row">
						<div class="col-xs-12 col-md-2">
							<p><img src="<?=$grav; ?>" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
							</div>
						<div class="col-xs-12 col-md-10">
							<div id="form-errors"><?=$validation->display_errors();?></div>
						          <h1>Update your user settings</h1>
					<?php include("views/userspice/_user_settings.php"); ?>
						
	
					</div>
					</div>
				</div>


    </div> <!-- /container -->

</div> <!-- /#page-wrapper -->


    <!-- footers -->
    <?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>
