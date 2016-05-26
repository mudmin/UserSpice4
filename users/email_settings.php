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
$query = $db->query("SELECT * FROM email");
$results = $query->first();

$urlProtocol=isset($_SERVER['HTTPS']) ? 'https://' : 'http://';


if(!empty($_POST)){
  $token = $_POST['csrf'];
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}

    if($results->smtp_server != $_POST['smtp_server']) {
      $smtp_server = Input::get('smtp_server');
      $fields=array('smtp_server'=>$smtp_server);
      $db->update('email',1,$fields);

    }
    else{
        }
    if($results->website_name != $_POST['website_name']) {
      $website_name = Input::get('website_name');
      $fields=array('website_name'=>$website_name);
      $db->update('email',1,$fields);

    }
    else{
        }
    if($results->smtp_port != $_POST['smtp_port']) {
      $smtp_port = Input::get('smtp_port');
      $fields=array('smtp_port'=>$smtp_port);
      $db->update('email',1,$fields);

    }else{
        }
        if($results->email_login != $_POST['email_login']) {
          $email_login = Input::get('email_login');
          $fields=array('email_login'=>$email_login);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->email_pass != $_POST['email_pass']) {
          $email_pass = Input::get('email_pass');
          $fields=array('email_pass'=>$email_pass);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->from_name != $_POST['from_name']) {
          $from_name = Input::get('from_name');
          $fields=array('from_name'=>$from_name);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->from_email != $_POST['from_email']) {
          $from_email = Input::get('from_email');
          $fields=array('from_email'=>$from_email);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->transport != $_POST['transport']) {
          $transport = Input::get('transport');
          $fields=array('transport'=>$transport);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->verify_url != $_POST['verify_url']) {
          $verify_url = Input::get('verify_url');
          $fields=array('verify_url'=>$verify_url);
          $db->update('email',1,$fields);

        }else{
          }
          if($results->email_act != $_POST['email_act']) {
          $email_act = Input::get('email_act');
          $fields=array('email_act'=>$email_act);
          $db->update('email',1,$fields);

        }else{
            }
            Redirect::to("email_settings.php");

  }

?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">

          <!-- Content Goes Here. Class width can be adjusted -->

<h1>Setup your email server</h1>
<p>
  These settings control all things email-related for the server including emailing your users and verifying the user's email address. 
  You must obtain and verify all settings below for YOUR email server or hosting provider. Encryption with TLS is STRONGLY recommended, 
  followed by SSL. No encryption is like shouting your login credentials out into a crowded field and is not supported for now.
</p>
</p>It is <strong>HIGHLY</strong> recommended that you test your email settings before turning on the feature to require new users to verify their email<br>
  <a href="email_test.php" class="btn btn-danger">Test Your Settings</a><br><br>
<form name='update' action='email_settings.php' method='post'>

<label>Website Name:</label>
  <input required size='50' class='form-control' type='text' name='website_name' value='<?=$results->website_name?>' />

<label>SMTP Server:</label>
  <input required size='50' class='form-control' type='text' name='smtp_server' value='<?=$results->smtp_server?>' />

<label>SMTP Port:</label>
  <input required size='50' class='form-control' type='text' name='smtp_port' value='<?=$results->smtp_port?>' />

<label>Email Login/Username:</label>
  <input required size='50' class='form-control' type='text' name='email_login' value='<?=$results->email_login?>' />

<label>Email Password:</label>
  <input required size='50' class='form-control' type='password' name='email_pass' value='<?=$results->email_pass?>' />

<label>From Name (For Sent Emails):</label>
  <input required size='50' class='form-control' type='text' name='from_name' value='<?=$results->from_name?>' />

<label>From Email (For Sent Emails):</label>
  <input required size='50' class='form-control' type='text' name='from_email' value='<?=$results->from_email?>' />

<label>Transport (Experimental):</label>
<select class="form-control" name="transport">
	<option value="tls" <?php if($results->transport=='tls') echo 'selected="selected"'; ?> >TLS (encrypted)</option>
	<option value="ssl" <?php if($results->transport=='ssl') echo 'selected="selected"'; ?> >SSL (encrypted, but weak)</option>
</select>  

<label>Root URL of your UserSpice install including http or https protocol (VERY Important) <br/><div class="text-muted"> <?="Default location would be: ".$urlProtocol.$_SERVER['HTTP_HOST'].$us_url_root?></div></label>
  <input required  size='50' class='form-control' type='text' name='verify_url' value='<?=$results->verify_url?>' />

<label>Require User to Verify Their Email?:</label>
<input type="radio" name="email_act" value="1" <?php echo ($results->email_act==1)?'checked':''; ?> size="25">Yes</input>
<input type="radio" name="email_act" value="0" <?php echo ($results->email_act==0)?'checked':''; ?> size="25">No</input>

<input type="hidden" name="csrf" value="<?=Token::generate();?>" />
<input class='btn btn-primary' type='submit' value='Update Email Settings' class='submit' /><br><br>
</form>

</div>    <!-- /.row -->
</div>
</div>
</div>
    <!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
