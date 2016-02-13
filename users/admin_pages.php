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

$errors = [];
$successes = [];
$rootpages = getPageFiles();  //retreives php files in root
$uspages = getUSPageFiles(); //retrieves core UserSpice pages
$pages = array_merge($rootpages, $uspages); //feel free to add more folders

$dbpages = fetchAllPages(); //Retrieve list of pages in pages table

$count = 0;
$dbcount = count($dbpages);
$creations = array();
$deletions = array();

foreach ($pages as $page) {
    $page_exists = false;
    foreach ($dbpages as $k => $dbpage) {
        if ($dbpage->page === $page) {
            unset($dbpages[$k]);
            $page_exists = true;
            break;
        }
    }
    if (!$page_exists) {
        $creations[] = $page;
    }
}

// /*
//  * Remaining DB pages (not found) are to be deleted.
//  * This function turns the remaining objects in the $dbpages
//  * array into the $deletions array using the 'id' key.
//  */
$deletions = array_column(array_map(function ($o) {
    return (array)$o;
}, $dbpages), 'id');

$deletes = '';
for($i = 0; $i < count($deletions);$i++) {
  $deletes .= $deletions[$i] . ',';
}
$deletes = rtrim($deletes,',');
//Enter new pages in DB if found
if (count($creations) > 0) {
    createPages($creations);
}
// //Delete pages from DB if not found
if (count($deletions) > 0) {
    deletePages($deletes);
}

//Update DB pages
$dbpages = fetchAllPages();

?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <h1>
            Administer Page Access
          </h1>

          <!-- Content goes here -->
          <?php include("views/userspice/_admin_pages.php"); ?>

        </table>
      </div>
    </div>
    <!-- /.row -->
  </div>
</div>






<!-- Content Ends Here -->
<!-- footers -->
<?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>
