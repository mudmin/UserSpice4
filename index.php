<?php ob_start(); if(!file_exists("core/index.php")){require_once("users/includes/frontend/header.php");
}else{
header("Location: core/index.php");
}

require_once("users/includes/frontend/navigation.php"); ?>

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
<!-- footers -->
<?php require_once("users/includes/frontend/page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once("users/includes/frontend/html_footer.php"); // currently just the closing /body and /html ?>
