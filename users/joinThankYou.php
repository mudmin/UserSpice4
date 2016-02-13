<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
 ?>
<!-- If you want to use UserSpice's core classes and helpers, be sure to include these files. -->
<?php require_once("includes/us_header.php"); ?>

<?php require_once("includes/us_navigation.php"); ?>
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$email = Input::get('email');
$csrf = Input::get('csrf');
$vericode = rand(100000,999999);

//Decide whether or not to use email activation
$query = $db->query("SELECT * FROM email");
$results = $query->first();
$act = $results->email_act;

//Opposite Day for Pre-Activation - Basically if you say in email settings that you do NOT want email activation, this lists new users as active in the database, otherwise they will become active after verifying their email.
if($act==1){
  $pre = 0;
} else {
  $pre = 1;
}
//Logic if ReCAPTCHA is turned ON
if($settings->recaptcha == 1){
require_once("includes/recaptcha.config.php");
//reCAPTCHA 2.0 check
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($privatekey);

if(!Token::check($csrf)){
  Redirect::to('index.php');
}else{
  // if submitted check response
if ($_POST["g-recaptcha-response"]) {
  $response = $reCaptcha->verifyResponse(
  $_SERVER["REMOTE_ADDR"],
  $_POST["g-recaptcha-response"]
);
}
if ($response != null && $response->success) {
    //add user to the database
    $user = new User();
    $join_date = date("Y-m-d H:i:s");
    $params = array(
      'fname' => Input::get('fname'),
      'email' => $email,
      'vericode' => $vericode,
    );

if($act == 1) {
    //Verify email address settings
     $to = $email;
     $subject = 'Welcome to UserSpice!';
     $body = email_body('verify.php',$params);
     email($to,$subject,$body);
}
    try {
      // echo "Trying to create user";
      $user->create(array(
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
        'email_verified' => $pre,
        'active' => 1,
        'vericode' => $vericode,
      ));
    } catch (Exception $e) {
      die($e->getMessage());
    }
}
}
}else{
  //Logic if ReCAPTCHA is turned OFF
  if(!Token::check($csrf)){
    Redirect::to('index.php');
  }else{
      //add user to the database
      $user = new User();
      $join_date = date("Y-m-d H:i:s");
      $params = array(
        'fname' => Input::get('fname'),
        'email' => $email,
        'vericode' => $vericode,
      );

  if($act == 1) {
      //Verify email address settings
       $to = $email;
       $subject = 'Welcome to UserSpice!';
       $body = email_body('verify.php',$params);
       email($to,$subject,$body);
  }
      try {
        // echo "Trying to create user";
        $user->create(array(
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
          'email_verified' => $pre,
          'active' => 1,
          'vericode' => $vericode,
        ));
      } catch (Exception $e) {
        die($e->getMessage());
      }
  }

    //display thank you page
    include 'includes/us_header.php';
    include 'views/join/_joinThankYou.php';
  }

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to UserSpice
                            <small>An Open Source PHP User Management Framework</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<!-- Content goes here -->







<!-- Content Ends Here -->
<!-- footers -->
<?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>
