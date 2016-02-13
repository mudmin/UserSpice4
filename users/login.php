<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
?>
<?php require_once("includes/us_header.php"); ?>

<?php require_once("includes/us_navigation.php"); ?>
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$error_message = '';
if (Input::exists()) {
//Check to see if recaptcha is enabled
	if($settings->recaptcha == 1){
	require_once("includes/recaptcha.config.php");
  //reCAPTCHA 2.0 check
$response = null;
  // check secret key
$reCaptcha = new ReCaptcha($privatekey);
// if submitted check response
	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);
}

if ($response != null && $response->success) {

  if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('display' => 'Username', 'required' => true),
      'password' => array('display' => 'Password', 'required' => true)
    ));

    if ($validation->passed()) {
      //Log user in

      $remember = (Input::get('remember') === 'on') ? true : false;
      $user = new User();
      $login = $user->login(Input::get('username'), trim(Input::get('password')), $remember);
      if ($login) {
//Feel free to change where the user goes after login!
        Redirect::to('account.php');
      } else {
        $error_message .= 'Log in failed. Please check your username and password and try again.';
      }
    } else{
      $error_message .= '<ul>';
      foreach ($validation->errors() as $error) {
        $error_message .= '<li>' . $error . '</li>';
      }
      $error_message .= '</ul>';
    }
  }
}
}else{
	if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('display' => 'Username', 'required' => true),
      'password' => array('display' => 'Password', 'required' => true)
    ));

    if ($validation->passed()) {
      //Log user in

      $remember = (Input::get('remember') === 'on') ? true : false;
      $user = new User();
      $login = $user->login(Input::get('username'), trim(Input::get('password')), $remember);
      if ($login) {
//Feel free to change where the user goes after login!
        Redirect::to('account.php');
      } else {
        $error_message .= 'Log in failed. Please check your username and password and try again.';
      }
    } else{
      $error_message .= '<ul>';
      foreach ($validation->errors() as $error) {
        $error_message .= '<li>' . $error . '</li>';
      }
      $error_message .= '</ul>';
    }
  }
}
}
?>

<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">
        <div class="class col-sm-3"></div>
        <div class="class col-sm-6">
          <?php include 'views/login/_login_form.php'; ?>
        </div>
      </div>
    </div>

    <!-- /.row -->


    <!-- Content Ends Here -->
    <!-- footers -->
    <?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php 	if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
    <?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>
