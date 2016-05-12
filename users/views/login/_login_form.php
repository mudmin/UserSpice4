<div class="form-signin">

    <div class="bg-danger"><?=$error_message;?></div>

	<form name="login" action="<?=$_SERVER['PHP_SELF']; ?>" method="post">

	<h2 class="form-signin-heading"><i class="fa fa-flask"></i> <?=lang("SIGNIN_TITLE","");?></h2>

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
		<label>Please check the box below to continue</label>
		<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
		</div>
	   <?php } ?>

	   	 <div class="form-group">
	       <label for="remember">
			<input type="checkbox" name="remember" id="remember" > Remember Me</label>
		</div>

  	<input type="hidden" name="token" value="<?=Token::generate(); ?>">
	<button class="submit  btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> <?=lang("SIGNIN_BUTTONTEXT","");?></button>

	</form>

	<div class="row">
		<div class="col-xs-6">
			<a class="pull-left" href='forgot_password.php'><i class="fa fa-wrench"></i> Forgot Password</a>
		</div>
		<div class="col-xs-6">
			<a class="pull-right" href='join.php'><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_TEXT","");?></a>
		</div>
	</div>

</div>
