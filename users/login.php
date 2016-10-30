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
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
?>
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$error_message = '';
if (@$_REQUEST['err']) $error_message = $_REQUEST['err']; // allow redirects to display a message
$reCaptchaValid=FALSE;

if (Input::exists()) {
    $token = Input::get('csrf');
    if(!Token::check($token)){
        die('Token doesn\'t match!');
    }
    //Check to see if recaptcha is enabled
    if($settings->recaptcha == 1){
        require_once 'includes/recaptcha.config.php';

        //reCAPTCHA 2.0 check
        $response = null;

        // check secret key
        $reCaptcha = new ReCaptcha($privatekey);

        // if submitted check response
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
        }
        if ($response != null && $response->success) {
            $reCaptchaValid=TRUE;

        }else{
            $reCaptchaValid=FALSE;
            $error_message .= 'Please check the reCaptcha.';
        }
    }else{
        $reCaptchaValid=TRUE;
    }

    if($reCaptchaValid || $settings->recaptcha == 0){ //if recaptcha valid or recaptcha disabled

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('display' => 'Username','required' => true),
            'password' => array('display' => 'Password', 'required' => true)));

        if ($validation->passed()) {
            //Log user in

            $remember = (Input::get('remember') === 'on') ? true : false;
            $user = new User();
            $login = $user->loginEmail(Input::get('username'), trim(Input::get('password')), $remember);
            if ($login) {
                # if user was attempting to get to a page before login, go there
                if ($dest = sanitizedDest('dest')) {
                    Redirect::to($dest);
                } elseif (file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')) {
                    # if site has custom login script, use it
                    # Note that the custom_login_script.php normally contains a Redirect::to() call
                    require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
                } else {
                    if (($dest = Config::get('homepage')) ||
                            ($dest = 'account.php')) {
                        #echo "DEBUG: dest=$dest<br />\n";
                        #die;
                        Redirect::to($dest);
                    }
                }
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
if (!$dest = sanitizedDest('dest')) {
  $dest = '';
}

?>

<div id="page-wrapper">
<div class="container">
<div class="row">
    <div class="col-xs-12">
    <div class="bg-danger"><?=$error_message;?></div>
    <form name="login" class="form-signin" action="login.php" method="post">
    <h2 class="form-signin-heading"></i> <?=lang("SIGNIN_TITLE","");?></h2>
    <input type="hidden" name="dest" value="<?= $dest ?>" />

    <div class="form-group">
        <label for="username" >Username OR Email</label>
        <input  class="form-control" type="text" name="username" id="username" placeholder="Username/Email" required autofocus>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control"  name="password" id="password"  placeholder="Password" required autocomplete="off">
    </div>

    <?php
    if($settings->recaptcha == 1){
    ?>
    <div class="form-group">
    <label>Please check the box below to continue</label>
    <div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
    </div>
    <?php } ?>

    <div class="form-group">
    <label for="remember">
    <input type="checkbox" name="remember" id="remember" > Remember Me</label>
    </div>

    <input type="hidden" name="csrf" value="<?=Token::generate(); ?>">
    <button class="submit  btn  btn-primary" type="submit"><i class="fa fa-sign-in"></i> <?=lang("SIGNIN_BUTTONTEXT","");?></button>

    </form>
    </div>
</div>
<div class="row">
    <div class="col-xs-6"><br>
        <a class="pull-left" href='forgot_password.php'><i class="fa fa-wrench"></i> Forgot Password</a><br><br>
    </div>
    <div class="col-xs-6"><br>
        <a class="pull-right" href='join.php'><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_TEXT","");?></a><br><br>
    </div>
</div>
</div>
</div>

    <!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php   if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
