<?php
include("install/includes/install_settings.php");
foreach ($files as $file) {
	if (!unlink($file)) {
		echo ("Error deleting $file<br>");
	}else{
		echo ("Deleted $file<br>");
	}
} 

rrmdir("install");

?>
<p align="center">Everything SHOULD be installed properly. If you get an error when you visit the homepage,<br> take a good look at the error. You will most likely have an <strong>extra / </strong><br> or be <strong>missing a /</strong> from the path shown in the error message. <br>Just <strong>edit /core/init.ini</strong> to reflect the proper path and you should be good to go.</p>

<p align="center">If you had <strong>errors</strong> at the top of this page, you MUST go into the /core folder and <strong>delete everything except init.php.</strong><br> Leaving these files present is a security vulnerability.</p>


<h3 align="center"><a class="button" href="../index.php">Check Out UserSpice!</a></h3>
<?php
function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (is_dir($dir."/".$object))
          rrmdir($dir."/".$object);
        else
          unlink($dir."/".$object);
      }
    }
    rmdir($dir);
  }
}
?>
