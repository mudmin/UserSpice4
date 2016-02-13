<div class="jumbotron container-fluid">
  <h1 class="text-center">Reset your password.</h1>
  <div class="col-md-4 col-md-offset-4">
    <ol class="text-centera">
      <li>Enter your email address and click Reset</li>
      <li>Check your email and click the link that is sent to you.</li>
      <li>Follow the on screen instructions</li>
    </ol>
    <form action="forgot_password.php" method="post" class="form-inline text-center">
      <span class="bg-danger"><?=display_errors($errors);?></span>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" value="" class="form-control">
      </div>
      <input type="hidden" name="csrf" value="<?=Token::generate();?>">
      <input type="submit" name="forgotten_password" value="Reset" class="btn btn-primary">
    </form>
  </div>
</div>
