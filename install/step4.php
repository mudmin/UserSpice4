<?php require_once("install/includes/header.php"); ?>
<div class="container">
 <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text"><?=$step1?></p>
                </a></li>
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text"><?=$step2?></p>
                </a></li>
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text"><?=$step3?></p>
                </a></li>
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text"><?=$step4?></p>
                </a></li>
                <li ><a href="#">
                    <h4 class="list-group-item-heading">Step 5</h4>
                    <p class="list-group-item-text"><?=$step5?></p>
                </a></li>
              </ul>
          </div>
          <div class="row">
              <div class="col-xs-3"></div>
              <div class="col-xs-6">
                <H2>Please fill in your ReCaptcha Keys</H2>
                <p>
                  If you do not have recaptcha keys, you can get them from Google in the link provided when you hit the "test settings" button.  We are offering "test" keys if you would like to put ReCaptcha into test mode, but we strongly suggest you take the time to get real keys from Google.
                </p><br><br>
                <form class="form" action="" method="post">

                  <p>
                  <strong>Test Public Key:  </strong>6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
                  </p>
                  <label for="public">Public Key
                  <input required size="50" class="form-control" type="text" name="public"  value="<?php if (!empty($_POST['public'])){ print $_POST['public']; } ?>"></label><br><br>

                  <p>
                  <strong>Test Private Key:  </strong>6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
                  </p>
                  <label for="private">Private Key
                  <input required size="50" class="form-control" type="text" name="private"  value="<?php if (!empty($_POST['private'])){ print $_POST['private']; } ?>"></label><br><br>

                  <H2>Please fill in your copyright message</H2>
                  <label for="copyright">Copyright Message
                  <input required size="50" class="form-control" type="text" name="copyright"  value="<?php if (!empty($_POST['copyright'])){ print $_POST['copyright']; } ?>"></label><br><br>

                <input class="btn btn-success" type="submit" name="test" value="Test Settings">

                <input class="btn btn-danger" type="submit" name="submit" value="Save Settings">
                </form>
<?php
//PHP Logic Goes Here
if (!empty($_POST)){
  $publickey = $_POST['public'];
  $privatekey = $_POST['private'];

//If Testing
if (!empty($_POST['test'])) {
  include("install/includes/recaptcha.php");
//reCAPTCHA 2.0 check
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($privatekey);

if ($response != null && $response->success) {
$errors = array();
} ?>
<label>If you can see the ReCaptcha, you have entered your keys correctly.</label>
	<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
}
//If Submitted
if (!empty($_POST['submit'])) {
  $chunk6 = file_get_contents("install/chunks/chunk6.php");
  $fh=fopen($config_file , "a+");
  $end = "';";

  $copyright_syn='$copyright_message = \'';
  $copyright=$_POST['copyright'];

  $private_syn='$your_private_key = \'';
  $public_syn='$your_public_key = \'';

fwrite($fh ,
  $copyright_syn . $copyright . $end . PHP_EOL .
  $private_syn   . $privatekey . $end . PHP_EOL .
  $public_syn    . $publickey . $end . PHP_EOL
);

file_put_contents($config_file, $chunk6, FILE_APPEND);

fclose($fh);
redirect("step5.php");
?>
<?php
}

}
?>


              </div>
              </div>
    	</div>
    </div>
<?php require_once("install/includes/header.php"); ?>
