<form action="<?=$form_action;?>" method="<?=$form_method;?>" id="payment-form">
  <input type="hidden" value="<?=$csrf;?>" name="csrf">
  <span id="payment-errors" class="bg-danger payment-errors"></span>
  <div id="step1">
  <div class="form-group col-md-3"></div>
<!-- Left Column -->
    <div class="col-md-6">
      <legend>Sign Up for Awesomeness!</legend>
      <div class="form-group">
        <label for="username">Userame:</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="fname">First Name:</label>
        <input type="text" class="form-control" id="fname" name="fname">
      </div>
      <div class="form-group">
        <label for="lname">Last Name:</label>
        <input type="text" class="form-control" id="lname" name="lname">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>
      <!-- Company is here if you want it -->

      <div class="form-group">
        <label for="company">Company Name:</label>
        <input type="text" class="form-control" id="company" name="company">
      </div>
      <div class="form-group">
        <label for="password">Choose Password:</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordhelp">
        <span class="help-block" id="passwordhelp">Must be atleast 6 characters</span>
    </div>
    <div class="form-group">
       <label for="confirm">Confirm Password:</label>
       <input type="password" id="confirm" name="confirm" class="form-control">
     </div>
      <br>
      <?php
      if($settings->recaptcha == 1){
      	?>
      <p><label>Please enter the words as they appear:</label>
      <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
      </p>
      <?php } ?>
      <button class="btn btn-primary pull-right" onclick="validateJoin();return false;" id="next_button">Register</button>

     </div>
   </div>

</form>
