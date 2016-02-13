<div class="jumbotron container-fluid">
  <h2 class="text-center">Hello <?=$ruser->data()->fname;?>,</h2>
  <p class="text-center">Please reset your password.</p>
  <div class="col-md-8 col-md-offset-2">
    <form action="forgot_password.php?reset=1" method="post">
      <span class="bg-danger"><?=display_errors($errors);?></span>
      <div class="form-group">
        <label for="password">New Password:</label>
        <input type="password" name="password" value="" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="confirm">Confirm Password:</label>
        <input type="password" name="confirm" value="" id="confirm" class="form-control">
      </div>
      <input type="hidden" name="csrf" value="<?=Token::generate();?>">
      <input type="hidden" name="email" value="<?=$email;?>">
      <input type="hidden" name="vericode" value="<?=$vericode;?>">
      <input type="submit" name="resetPassword" value="Reset" class="btn btn-primary pull-right">
    </form>
  </div>
</div>
