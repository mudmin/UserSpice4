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
                                <form class="form" action="" method="post">
                <h2>Please select your region/timezone</h2>
                
                  <?php
  $regions = array(
      'Africa' => DateTimeZone::AFRICA,
      'America' => DateTimeZone::AMERICA,
      'Antarctica' => DateTimeZone::ANTARCTICA,
      'Asia' => DateTimeZone::ASIA,
      'Atlantic' => DateTimeZone::ATLANTIC,
      'Europe' => DateTimeZone::EUROPE,
      'Indian' => DateTimeZone::INDIAN,
      'Pacific' => DateTimeZone::PACIFIC
  );
  $timezones = array();
  foreach ($regions as $name => $mask)
  {
      $zones = DateTimeZone::listIdentifiers($mask);
      foreach($zones as $timezone)
      {
  		// Lets sample the time there right now
  		$time = new DateTime(NULL, new DateTimeZone($timezone));
  		// Us dumb Americans can't handle millitary time
  		$ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
  		// Remove region name and add a sample time
  		$timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ' - ' . $time->format('H:i') . $ampm;
  	}
  }
  // View
  print '<label>Select Your Timezone</label><select id="timezone" name="timezone">';

  foreach($timezones as $region => $list)
  {
  	print '<optgroup label="' . $region . '">' . "\n";
  	foreach($list as $timezone => $name)
  	{
  		print '<option value="' . $timezone . '"name="' . $timezone . '">' . $name . '</option>' . "\n";
  	}
  	print '<optgroup>' . "\n";
  }
  print '</select>';?>
                <H2>Please fill in your ReCaptcha Keys</H2>
                <p>
                  If you do not have recaptcha keys, you can get them from Google in the link provided when you hit the "test settings" button.  We are offering "test" keys if you would like to put ReCaptcha into test mode, but we strongly suggest you take the time to get real keys from Google.
                </p><br><br>


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

  $timezone_syn='$timezone_string = \'';
  $tz=$_POST['timezone'];

  $copyright_syn='$copyright_message = \'';
  $copyright=$_POST['copyright'];

  $private_syn='$your_private_key = \'';
  $public_syn='$your_public_key = \'';

fwrite($fh ,
  $timezone_syn . $tz . $end . PHP_EOL .
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
