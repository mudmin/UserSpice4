<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("includes/us_header.php"); ?>

<?php require_once("includes/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$error_message = null;
$errors = array();
if(Input::get('reset') == 1){
  //display the reset form.
  $email = Input::get('email');
  $vericode = Input::get('vericode');
  $ruser = new User($email);
  if (Input::get('resetPassword')) {
    $csrf = Input::get('csrf');
      if(Token::check($csrf)){
      $validate = new Validate();
      $validation = $validate->check($_POST,array(
        'password' => array(
          'display' => 'New Password',
          'required' => true,
          'min' => 6,
        ),
        'confirm' => array(
          'display' => 'Confirm Password',
          'required' => true,
          'matches' => 'password',
        ),
      ));
      if($validation->passed()){
        //update password
        $ruser->update(array(
          'password' => password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
          'vericode' => rand(100000,999999),
        ),$ruser->data()->id);
        include 'views/forgotten_password/_success.php';
        die();
      }else{
        $errors = $validation->errors();
      }
    }
  }
  if ($ruser->exists() && $ruser->data()->vericode == $vericode) {
    include 'views/forgotten_password/_reset.php';
  }else{
    echo '<h1>Oops...something went wrong.</h1>
    <p><a href="forgot_password.php">Click Here</a> to try again.</p>
    ';
  }
}

if (Input::get('forgotten_password')) {
  if (Token::check(Input::get('csrf'))) {
    $email = Input::get('email');
    $fuser = new User($email);
    //validate the form
    $validate = new Validate();
    $validation = $validate->check($_POST,array(
      'email' => array(
        'display' => 'Email',
        'valid_email' => true,
        'required' => true,
      ),
    ));
    if($validation->errors()){
      //display the errors
      $errors = $validation->errors();
      include 'views/forgotten_password/_forgotten_password.php';
    }else{
      if($fuser->exists()){
        //send the email
        $options = array(
          'fname' => $fuser->data()->fname,
          'email' => $email,
          'vericode' => $fuser->data()->vericode,
        );
        $subject = 'Password Reset;
        $body =  email_body('forgotten_password.php',$options);
        email($email,$subject,$body);
        include 'views/forgotten_password/_sent.php';
      }else{
        $errors[] = 'That email does not exist in our database';
        include 'views/forgotten_password/_forgotten_password.php';
      }
    }
  }
}
?>

<?php
if(!Input::get('forgotten_password') && !Input::get('reset')){
 include 'views/forgotten_password/_forgotten_password.php';
}
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                  <div class="col-lg-4"></div>
                <div class="col-lg-4">
<!-- CONTENT GOES HERE -->
<?php include 'views/login/_login_form.php'; ?>

              </div>
          </div>
          <!-- /.row -->

      </div>
      <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- footer -->

                <!-- /.row -->
<!-- Content goes here -->







<!-- Content Ends Here -->
<!-- footers -->
<?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html
?>
