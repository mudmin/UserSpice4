<?php require_once("install/includes/header.php"); ?>
<div class="container">
 <div class="row">
        <div class="col-xs-12">
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
                <H2>Path Settings</H2>
                <p>
It's really important for <?=$app_name?> to know where it is installed on your servers. This software has the ability to have two paths set.  One for when you are developing on localhost and another for when you are on a live server.
                </p><br><br>
                <form class="form" action="" method="post">
                  <p>
                  <strong>Current Path </strong><br>
                  Our system detects that you have installed this software in...<br>
                  <strong><?php
            $my_folder = dirname( realpath( __FILE__ ) ) . DIRECTORY_SEPARATOR;

            $my_parent_folder = preg_replace( '~[/\\\\][^/\\\\]*[/\\\\]$~' , DIRECTORY_SEPARATOR , $my_folder );

                  echo $my_parent_folder . "<br></strong>";
                  ?><br><br>
                  In general, your path should <strong>begin</strong> and <strong>end</strong> with a <strong>/</strong><br>
                  If you installed this software in the <strong>root</strong>, just put <strong>/</strong><br>
                  If you installed in a <strong>subfolder</strong>, put <strong>/subfolder/</strong> <br>
                  Don't worry, you can change this later by editing your <?=$config_file?> manually later.

                  </p>
                  <label for="local">Localhost Project Folder (Should end with a /, usually begins with one too)
                  <input required size="50" class="form-control" type="text" name="local"  value="<?php if (!empty($_POST['local'])){ print $_POST['local']; } ?>"></label><br><br>

                  <label for="live">Live Server Project Folder (Should end with a /, usually begins with one too)
                  <input required size="50" class="form-control" type="text" name="live"  value="<?php if (!empty($_POST['live'])){ print $_POST['live']; } ?>"></label><br><br>

                <input class="btn btn-danger" type="submit" name="submit" value="Save Settings">
                </form>
<?php
//If Submitted
if (!empty($_POST['submit'])) {
  $chunk1 = file_get_contents("install/chunks/chunk1.php");
  $chunk2 = file_get_contents("install/chunks/chunk2.php");
  $chunk3 = file_get_contents("install/chunks/chunk3.php");
  $chunk4 = file_get_contents("install/chunks/chunk4.php");

  $fh=fopen($config_file , "a+");
  $end = "';";

  $local=$_POST['local'];
  $live=$_POST['live'];


fwrite($fh ,
  "'".$local . $chunk1 .
  "'".$live  . $chunk2 .
  "'".$local . $chunk3 .
  "'".$live  . $chunk4
);

fclose($fh);
redirect("step3.php");
?>
<?php
}

?>


              </div>
              </div>
    	</div>
    </div>
<?php require_once("install/includes/header.php"); ?>
