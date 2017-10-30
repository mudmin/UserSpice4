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
If your system acts weird after installation, you may need to edit the file users/init.php to update your path.

                  </p>

                <input class="btn btn-danger" type="submit" name="submit" value="Save Settings">
                </form>
<?php
//If Submitted
if (!empty($_POST['submit'])) {

	$fh=fopen($config_file , "a+");

	fwrite($fh ,"");

	fclose($fh);
	redirect("step3.php");
}

?>


              </div>
              </div>
    	</div>
    </div>
<?php require_once("install/includes/header.php"); ?>
