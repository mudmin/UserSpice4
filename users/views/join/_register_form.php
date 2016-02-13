<form action="<?=$form_action;?>" method="<?=$form_method;?>" id="payment-form" name="register">
  <input type="hidden" value="<?=$csrf;?>" name="csrf">
  <span id="payment-errors" class="bg-danger payment-errors"></span>
  <div id="step1">
  <div class="form-group col-md-3"></div>
<!-- Left Column -->
    <div class="form-group col-md-6">
      <legend>Sign Up for Awesomeness!</legend>

      <label for="username">Userame:</label>
      <input type="text" class="form-control" id="username" name="username">

      <label for="fname">First Name:</label>
      <input type="text" class="form-control" id="fname" name="fname">

      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" id="lname" name="lname">

      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" name="email">

      <!-- Company is here if you want it -->
      <label for="company">Company Name:</label>
      <input type="text" class="form-control" id="company" name="company">

      <label for="password">Choose Password:</label>
      <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordhelp">

      <span class="help-block" id="passwordhelp">Must be atleast 6 characters</span>

       <label for="confirm">Confirm Password:</label>
       <input type="password" id="confirm" name="confirm" class="form-control">
      <br>
      <?php
      if($settings->recaptcha == 1){
      	?>
      <p><label>Please enter the words as they appear:</label>
      <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
      </p>
      <?php } ?>
      <button type="submit" class="btn btn-primary pull-right" name="submit">Register</button>


     </div>
   </div>

</form>
