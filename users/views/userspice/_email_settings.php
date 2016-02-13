<h1>
  Setup your email server
</h1>
<p>
  These settings control all things email-related for the server including emailing your users and verifying the user's email address.
</p>
</p>It is <strong>HIGHLY</strong> recommended that you test your email settings before turning on the feature to require new users to verify their email<p><br>
  <a href="email_test.php" class="btn btn-danger">Test Your Settings</a><br><br>
<form name='update' action='email_settings.php' method='post'>
<p>
<label>Website Name:
  <input required size='50' class='form-control' type='text' name='website_name' value='<?=$results->website_name?>' /></label>
</p>
<p>
<label>SMTP Server:
  <input required size='50' class='form-control' type='text' name='smtp_server' value='<?=$results->smtp_server?>' /></label>
</p>
<p>
<label>SMTP Port:
  <input required size='50' class='form-control' type='text' name='smtp_port' value='<?=$results->smtp_port?>' /></label>
</p>
<p>
<label>Email Login/Username:
  <input required size='50' class='form-control' type='text' name='email_login' value='<?=$results->email_login?>' /></label>
</p>
<p>
<label>Email Password:
  <input required size='50' class='form-control' type='password' name='email_pass' value='<?=$results->email_pass?>' /></label>
</p>
<p>
<label>From Name (For Sent Emails):
  <input required size='50' class='form-control' type='text' name='from_name' value='<?=$results->from_name?>' /></label>
</p>
<p>
<label>From Email (For Sent Emails):
  <input required size='50' class='form-control' type='text' name='from_email' value='<?=$results->from_email?>' /></label>
</p>
<p>
<label>Transport (Experimental):
  <input required size='50' class='form-control' type='text' name='transport' value='<?=$results->transport?>' /></label>
</p>
<p>
<label>URL of YOUR verify.php file: (VERY Important)
  <input required  size='50' class='form-control' type='text' name='verify_url' value='<?=$results->verify_url?>' /></label>
</p>
<p>
<label>Require User to Verify Their Email?:
<input type="radio" name="email_act" value="1" <?php echo ($results->email_act==1)?'checked':''; ?> size="25">Yes</input></label>
<input type="radio" name="email_act" value="0" <?php echo ($results->email_act==0)?'checked':''; ?> size="25">No</input></label>
</p>
<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
        <p>
<label>&nbsp;</label>
<input class='btn btn-primary' type='submit' value='Update Email Settings' class='submit' />
</p>

</form>




<!-- End of main content section -->
</div>

<!-- Right Column -->
<div class="class col-sm-1"></div>
</div>
</div>
