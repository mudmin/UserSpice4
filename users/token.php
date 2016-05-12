<?php require_once("includes/userspice/us_header.php"); ?>

<?php require_once("includes/userspice/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//PHP Goes Here!
if(!empty($_POST)) {
  $token = $_POST['csrf'];
  echo "The token received was..." . $token;
  if(Token::check($token)){
    bold('The token matches');
  }else {
    bold('Wrong token');
}
}
?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">

        <!-- Left Column -->
        <div class="class col-sm-1"></div>

        <!-- Main Center Column -->
        <div class="class col-sm-10">
          <!-- Content Goes Here. Class width can be adjusted -->
          <h1>
            Token Test
          </h1>

<form class="" action="token.php" method="post">
  <input type="text" class = "form-control" name="csrf" value="<?=Token::generate();?>" >
<?php dump($_SESSION); ?>
  <input type="submit" name="submit" value="submit">
</form>


          <!-- End of main content section -->
        </div>

        <!-- Right Column -->
        <div class="class col-sm-1"></div>
      </div>
    </div>

    <!-- /.row -->

    <!-- footers -->
    <?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>
