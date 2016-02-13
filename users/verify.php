<?php
/*
UserSpice 43
by Curtis Parham and Dan Hoover at http://UserSpice.com
*/ ?><?php require_once("includes/us_header.php");
  //require_once("includes/us_navigation.php");
  if($user->isLoggedIn()){
    $user->logout();
    Redirect::to('verify.php');
  }
  $email = (isset($_GET['email']))?sanitize($_GET['email']):'';
  $vericode = Input::get('vericode');
  $verify = new User($email);
  $errors = array();
  if(Input::exists()){
    if(Token::check(Input::get('csrf'))){
      $validate = new Validate();
      $validation = $validate->check($_POST,array(
        'email' => array(
          'display' => 'Email',
          'valid_email' => true,
          'required' => true,
        ),
      ));
      if($validation->passed()){
        $verify = new User(Input::get('email'));
        $vericode = $verify->data()->vericode;
        $subject = 'Verify Your Email';
        $body = email_body('verify.php',array('fname'=>$verify->data()->fname));
        //send email
        if($verify->data()->email_verified == 0){
          email(Input::get('email'),$subject,$body);
        }
        include 'views/verify/_thankyou.php';
        // include 'views/layouts/footer.php';
        die();
      }else{
        $errors = $validation->errors();
      }
    }
  }
  if($verify->exists()):
    if($verify->data()->vericode == $vericode || $verify->data()->email_verified == 1):
      if($verify->data()->email_verified == 0 && !$user->isLoggedIn()){
        $verify->update(array('email_verified' => 1),$verify->data()->id);
      }
       ?>
       <?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
      <div class="jumbotron text-center">
        <h1>Your Email has been verified!</h1>
        <a href="login.php" class="btn btn-large btn-primary">Log In</a>
      </div>
    <?php endif; ?>
  <?php else:?>
    <div class="well container-fluid">
      <h1 class="text-center">Oops...you must verify your email address.</h1>
      <p class="text-center">After registration, you should have received a verification email. Sometimes these emails end up in your spam folder.
        Please be sure to check there. If you did not recieve an email you can resend it by entering your email address below, and then click resend.
      </p>
      <div class="col-md-8 col-md-offset-2">
        <form class="" action="verify.php" method="post">
          <span class="bg-danger"><?=display_errors($errors);?></span>
          <div class="form-group">
            <label for="email">Enter Your Email:</label>
            <input type="text" id="email" name="email" class="form-control">
          </div>
          <input type="hidden" name="csrf" value="<?=Token::generate();?>">
          <input type="submit" value="Resend" class="btn btn-primary pull-right">
        </form>
      </div>
    </div>
  <?php endif;?>


  <?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

  <!-- Place any per-page javascript here -->

  <?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>
