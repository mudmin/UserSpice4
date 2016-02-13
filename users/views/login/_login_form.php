  <h2>Login To Awesomeness!</h2>
  <form action="" method="post">
    <div class="bg-danger"><?=$error_message;?></div>
  	<div class="form-group">
  		<label for="username" class="form_control">Username:</label>
  		<input type="text" name="username" id="username" class="form-control">
  	</div>
  	<div class="form-group">
  		<label for="password" class="form_control">Password:</label>
  		<input type="password" name="password" id="password" class="form-control" autocomplete="off">
  	</div>
    <?php
    if($settings->recaptcha == 1){
    	?>
    <p><label>Please enter the words as they appear:</label>
    <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
    </p>
    <?php } ?>
    <label for="remember">
    <input type="checkbox" name="remember" id="remember" checked> Remember Me</label>
  	<p>Forget your password? <a href="forgot_password.php">Click here</a> to retrieve it.</p>
  	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  	<input type="submit" value="Log In"  class="btn btn-primary">
  </form>
</div>
