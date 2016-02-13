<?php
include("install/includes/install_settings.php");
foreach ($files as $file) {

if (!unlink($file))
  {
  echo ("Error deleting $file<br>");
  }
else
  {
  echo ("Deleted $file<br>");
  }
}

rrmdir("install");
?>
Everything SHOULD be installed properly.  If you get an error when you visit the homepage, take a good look at the error. You will most likely have an extra / or be missing a / from the path shown in the error message. Just edit /core/init.ini to reflect the proper path and you should be good to go.<br><br>

<h3 align="center"><a class="button" href="../index.php">Visit UserSpice Homepage</a></h3>
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
