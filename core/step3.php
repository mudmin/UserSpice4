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
                <li class="active"><a href="#">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text"><?=$step3?></p>
                </a></li>
                <li><a href="#">
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
                <H2>Please fill in your database credentials</H2>
                <form class="form" action="" method="post">
                  <label for="dbh">Database Host (required)
                  <input required class="form-control" type="text" name="dbh"  value="<?php if (!empty($_POST['dbh'])){ print $_POST['dbh']; } ?>"></label><br><br>

                  <label for="dbu">Database User (required)
                  <input required class="form-control" type="text" name="dbu"  value="<?php if (!empty($_POST['dbu'])){ print $_POST['dbu']; } ?>"></label><br><br>

                  <label for="dbp">Database Password (usually required)
                  <input class="form-control" type="text" name="dbp"  value="<?php if (!empty($_POST['dbp'])){ print $_POST['dbp']; } ?>"></label><br><br>

                  <label required for="dbn">Database Name (required)
                <input class="form-control" type="text" name="dbn"  value="<?php if (!empty($_POST['dbn'])){ print $_POST['dbn']; } ?>"></label><br><br>


                <input class="btn btn-success" type="submit" name="test" value="Test Settings"><br><br>

<?php
//PHP Logic Goes Here
if (!empty($_POST)){
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
//If Testing
if (!empty($_POST['test'])) {
    $success = true;
try {
    $dsn = "mysql:host=$dbh;dbname=$dbn;charset=utf8";
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
    exit;
    }


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
     echo "Tables imported successfully<br>";

    ?>
<input class="btn btn-danger" type="submit" name="submit" value="Save Settings >>">
<?php
}
}

//If Submitted
if (!empty($_POST['submit'])) {
fwrite($fh ,
  $dbh_syn . $dbh . $end . PHP_EOL .
  $dbu_syn . $dbu . $end . PHP_EOL .
  $dbp_syn . $dbp . $end . PHP_EOL .
  $dbn_syn . $dbn . $end . PHP_EOL
);
$chunk5 = file_get_contents("install/chunks/chunk5.php");
file_put_contents($config_file, $chunk5, FILE_APPEND);

fclose($fh);
redirect("step4.php")
?>
<?php
}
}
?>
</form>

              </div>
              </div>
    	</div>
    </div>
<?php require_once("install/includes/header.php"); ?>
