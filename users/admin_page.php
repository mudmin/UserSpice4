<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("includes/us_header.php"); ?>
<!-- stuff can go here -->

<?php require_once("includes/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//PHP Goes Here!
$pageId = Input::get('id');
$errors = [];
$successes = [];

//Check if selected pages exist
if(!pageIdExists($pageId)){
  Redirect::to("admin_pages.php"); die();
}

$pageDetails = fetchPageDetails($pageId); //Fetch information specific to page


//Forms posted
if(!empty($_POST)){
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    die('Token doesn\'t match!');
  }
  $update = 0;

  if(!empty($_POST['private'])){ $private = $_POST['private']; }

  //Toggle private page setting
  if (isset($private) AND $private == 'Yes'){
    if ($pageDetails->private == 0){
      if (updatePrivate($pageId, 1)){
        $successes[] = lang("PAGE_PRIVATE_TOGGLED", array("private"));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
  }
  elseif ($pageDetails->private == 1){
    if (updatePrivate($pageId, 0)){
      $successes[] = lang("PAGE_PRIVATE_TOGGLED", array("public"));
    }
    else {
      $errors[] = lang("SQL_ERROR");
    }
  }

  //Remove permission level(s) access to page
  if(!empty($_POST['removePermission'])){//dump($_POST['removePermission']);die();
    $remove = $_POST['removePermission'];
    if ($deletion_count = removePage($pageId, $remove)){
      $successes[] = lang("PAGE_ACCESS_REMOVED", array($deletion_count));
    }
    else {
      $errors[] = lang("SQL_ERROR");
    }

  }

  //Add permission level(s) access to page
  if(!empty($_POST['addPermission'])){//dump($_POST['addPermission']);die();
    $add = $_POST['addPermission'];
    $addition_count = 0;
    foreach($add as $perm_id){
      if(addPage($pageId, $perm_id)){
        $addition_count++;
      }
    }
    if ($addition_count > 0 ){
      $successes[] = lang("PAGE_ACCESS_ADDED", array($addition_count));
    }
  }

  $pageDetails = fetchPageDetails($pageId);
}

$pagePermissions = fetchPagePermissions($pageId);
$permissionData = fetchAllPermissions();
?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">

        <!-- Left Column -->
        <div class="class col-sm-3"></div>

        <!-- Main Center Column -->
        <div class="class col-sm-6">
          <!-- Content Goes Here. Class width can be adjusted -->
          <?php include("views/userspice/_admin_page.php"); ?>
        </div>

        <!-- Right Column -->
        <div class="class col-sm-1"></div>
      </div>
    </div>

    <!-- /.row -->
    <!-- footers -->
    <?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>
