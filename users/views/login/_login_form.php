<div class="form-signin">

    <div class="bg-danger"><?=$error_message;?></div>

	<form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

	<h2 class="form-signin-heading"><i class="fa fa-flask"></i> <?php echo lang("SIGNIN_TITLE","");?></h2>

	  <div class="form-group">
        <label for="username" >Username</label>
        <input  class="form-control" type="text" name="username" id="username" placeholder="Username" required autofocus>
	  </div>

	  <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control"  name="password" id="password"  placeholder="Password" required autocomplete="off">
	  </div>

	  <?php
       if($settings->recaptcha == 1){
    	?>
		<div class="form-group">
		<label>Please enter the words as they appear:</label>
		<div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
		</div>
	   <?php } ?>

	   	 <div class="form-group">
	       <label for="remember">
			<input type="checkbox" name="remember" id="remember" checked> Remember Me</label>
		</div>

  	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<button class="submit  btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> <?php echo lang("SIGNIN_BUTTONTEXT","");?></button>

	</form>

	<div class="row">
		<div class="col-xs-6">
			<a class="pull-left" href='forgot_password.php'><i class="fa fa-wrench"></i> Forgot Password</a>
		</div>
		<div class="col-xs-6">
			<a class="pull-right" href='join.php'><i class="fa fa-plus-square"></i> <?php echo lang("SIGNUP_TEXT","");?></a>
		</div>
	</div>

</div>
