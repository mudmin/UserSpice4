<div class="jumbotron container-fluid">
  <div class="col-md-8 col-md-offset-2 col-sm-12">
  <form action="change_password.php" method="post">
    <legend>Change Your Password</legend>
    <span class="bg-danger"><?=display_errors($errors);?></span>
    <div class="form-group">
      <label for="old">Old Password</label>
        <input type="password" name="old" id="old" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
      <label for="confirm">Confirm New Password</label>
        <input type="password" name="confirm" id="confirm" class="form-control">
    </div>
    <input type="hidden" name="csrf" value="<?=Token::generate();?>">
    <input type="submit" value="Change Password" class="btn btn-primary pull-right">
  </form>
</div>
