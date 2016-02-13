<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("users/includes/header.php"); ?>

<?php require_once("users/includes/navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to UserSpice
                            <small>An Open Source PHP User Management Framework</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<!-- Content goes here -->







<!-- Content Ends Here -->
<?php require_once("users/includes/page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once("users/includes/html_footer.php"); // currently just the closing /body and /html ?>
