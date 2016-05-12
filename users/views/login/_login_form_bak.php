<div class="overlay"></div>
<div class="lightbox">
  <!-- <span id="close-lightbox"><a href="index.php">X</a></span> -->
  <h2>Login To Awesomeness!</h2>
  <form action="" method="post">
    <div class="bg-danger"><?=$error_message;?></div>
  	<div class="form-group">
  		<label for="email" class="form_control">Email:</label>
  		<input type="text" name="email" id="email" class="form-control">
  	</div>
  	<div class="form-group">
  		<label for="password" class="form_control">Password:</label>
  		<input type="password" name="password" id="password" class="form-control" autocomplete="off">
  	</div>
    <p><label>Please enter the words as they appear:</label>
    <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
    </p>
    <label for="remember">
    <input type="checkbox" name="remember" id="remember" checked> Remember Me</label>
  	<p>Forget your password? <a href="forgot_password.php">Click here</a> to retrieve it.</p>
  	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  	<input type="submit" value="Log In"  class="btn btn-primary">
  </form>
</div>
