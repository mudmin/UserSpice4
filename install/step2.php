<?php require_once("install/includes/header.php");

$go = 0; ?>
<div class="container">

  <div class="row">
      <div class="col-sm-5">

      </div> <!-- / panel preview -->
      </div>


 <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text"><?=$step1?></p>
                </a></li>
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text"><?=$step2?></p>
                </a></li>
                <li><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text"><?=$step3?></p>
                </a></li>
              </ul>
          </div>
          <div class="row">
              <div class="col-sm-12">
              <?php  if (!empty($_POST)){
                  echo "We are importing the tables...one moment please!"; } ?>
                <H2>Please fill in your information</H2>
                <form class="form" action="" method="post">
                  <div class="panel panel-default">
                      <div class="panel-body form-horizontal payment-form">
                          <div class="form-group">
                              <label for="timezone" class="col-sm-4 control-label">Region/Timezone (required)</label>
                              <div class="col-sm-8">
                                <?php
                                    $regions = array(
                                        'Africa' => DateTimeZone::AFRICA,
                                        'America' => DateTimeZone::AMERICA,
                                        'Antarctica' => DateTimeZone::ANTARCTICA,
                                        'Asia' => DateTimeZone::ASIA,
                                        'Atlantic' => DateTimeZone::ATLANTIC,
                                        'Australia' => DateTimeZone::AUSTRALIA,
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
                                    print '<select class="form-control" id="timezone" name="timezone" required>';

                                    foreach($timezones as $region => $list)
                                    {
                                      print '<optgroup label="' . $region . '">' . "\n";
                                      if(!empty($_POST['timezone'])){?>
                                      <option value="<?=$_POST['timezone']?>" selected="selected"><?=$_POST['timezone']?></option>
                                      <?php
                                      }
                                      foreach($list as $timezone => $name)
                                      {
                                        print '<option value="' . $timezone . '"name="' . $timezone . '">' . $name . '</option>' . "\n";
                                      }
                                      print '<optgroup>' . "\n";
                                    }
                                    print '</select>';?>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="dbh" class="col-sm-4 control-label">Database Host (required)</label>
                              <div class="col-sm-8">
                                <input required class="form-control" type="text" name="dbh"  value="<?php if (!empty($_POST['dbh'])){ print $_POST['dbh']; } ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="dbu" class="col-sm-4 control-label">Database User (required)</label>
                              <div class="col-sm-8">
                                  <input required class="form-control" type="text" name="dbu"  value="<?php if (!empty($_POST['dbu'])){ print $_POST['dbu']; } ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="dbp" class="col-sm-4 control-label">Database Password (usually required)</label>
                              <div class="col-sm-8">
                                <input class="form-control" type="text" name="dbp"  value="<?php if (!empty($_POST['dbp'])){ print $_POST['dbp']; } ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="dbn" class="col-sm-4 control-label">Database Name (required)</label>
                              <div class="col-sm-8">
                                  <input class="form-control" type="text" name="dbn"  value="<?php if (!empty($_POST['dbn'])){ print $_POST['dbn']; } ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-12 text-right">
                                <input class="btn btn-primary" type="submit" name="test" value="Try These Settings (This will take a moment)">
                              </div>
                          </div>
                      </div>
                  </div>
<?php
//PHP Logic Goes Here
if (!empty($_POST)){
  $fh=fopen($config_file , "a+");

	fwrite($fh ,"");

	fclose($fh);
$fh=fopen($config_file , "a+");
$end = "',";

$dbh_syn="'host'         => '";
$dbh=$_POST['dbh'];

$dbu_syn="'username'     => '";
$dbu=$_POST['dbu'];

$dbp_syn="'password'     => '";
$dbp=$_POST['dbp'];

$dbn_syn="'db'           => '";
$dbn=$_POST['dbn'];
//attempt manual db creation
$dbFail = 0;
//If Submitted
if (!empty($_POST['submit'])) {
  $timezone_syn='$timezone_string = \'';
  $tz=$_POST['timezone'];
fwrite($fh ,
  $dbh_syn . $dbh . $end . PHP_EOL .
  $dbu_syn . $dbu . $end . PHP_EOL .
  $dbp_syn . $dbp . $end . PHP_EOL .
  $dbn_syn . $dbn . $end . PHP_EOL
);
$chunk1 = file_get_contents("install/chunks/chunk1.php");
file_put_contents($config_file, $chunk1, FILE_APPEND);
fclose($fh);
$fh=fopen($config_file , "a+");
$end = "';";
fwrite($fh , $timezone_syn . $tz . $end . PHP_EOL);
fclose($fh);
$chunk2 = file_get_contents("install/chunks/chunk2.php");
file_put_contents($config_file, $chunk2, FILE_APPEND);
fclose($fh);
redirect("step3.php");
}

if(!empty($_POST['tryToCreate'])){
  try {
      $dsn = "mysql:host=$dbh;charset=utf8";
      $opt = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $pdo = new PDO($dsn, $dbu, $dbp, $opt) or die('could not connect');
  $pdo->exec("CREATE DATABASE `$dbn`;
                CREATE USER '$dbu'@'$dbh' IDENTIFIED BY '$dbp';
                GRANT ALL ON `$dbn`.* TO '$dbu'@'$dbh';
                FLUSH PRIVILEGES;")
        or die(print_r($pdo->errorInfo(), true));

  } catch (PDOException $e) {
      $success = false;
      echo "Database connection <font color='red'><strong>unsuccessful</font></strong>! Please try again.";
  }
}
//If Testing
if (!empty($_POST['test'])) {
    $success = true;
try {
    $dsn = "mysql:host=$dbh;charset=utf8";
    $opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $dbu, $dbp, $opt) or die('could not connect');
} catch (PDOException $e) {
    $success = false;
    echo "Database connection <font color='red'><strong>unsuccessful</font></strong>! Please try again.";
}

if ($success) {
    echo "Database connection <font color='green'><strong>successful</font></strong>!<br><br>";
    $link = mysqli_connect($dbh, $dbu, $dbp, $dbn);
    if (!$link) {

    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    $dbError =  mysqli_connect_errno();
    if($dbError == '1049'){?>
      <form class="" action="" method="post">
        <input type="hidden" name="test" value="1">
        <input type="hidden" name="dbh" value="<?=$dbh?>">
        <input type="hidden" name="dbu" value="<?=$dbu?>">
        <input type="hidden" name="dbp" value="<?=$dbp?>">
        <input type="hidden" name="dbn" value="<?=$dbn?>">
        <strong>
        <br>Your credentials appear to be correct but the database name is not found.<br> If you would like to attempt to create it, please hit "Yes". Otherwise, edit your information and try again.<br>
        <input type="submit" name="tryToCreate" value="Yes" class='btn btn-success'>
      <?php }

  }else{
    $go = 1;
  }
if($go === 1){
    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($sqlfile);
    // Loop through each line
    foreach ($lines as $line)
    {
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        mysqli_query($link,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_connect_error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
    }
     echo "If you do not see a bunch of errors above this line, your tables imported successfully<br>";
    ?>

<input class="btn btn-danger" type="submit" name="submit" value="Finalize Install >>">
</form>
<?php
}
}

}
} // if go =1
?>
</form>

              </div>
              </div>
    	</div>
    </div>
<?php require_once("install/includes/header.php"); ?>
