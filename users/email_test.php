<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("includes/us_header.php"); ?>

<?php require_once("includes/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php if($user->data()->id != 1){
  Redirect::to('account.php');
}
  ?>
<?php
//PHP Goes Here!

$query = $db->query("SELECT * FROM email");
$results = $query->first();

if(!empty($_POST)){
  $to = $_POST['test_acct'];
  $subject = 'Testing Your Email Settings!';
  $body = 'This is the body of your test email';
  email($to,$subject,$body);
}

?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">

        <!-- Left Column -->
        <div class="class col-sm-4"></div>

        <!-- Main Center Column -->
        <div class="class col-sm-3">
          <!-- Content Goes Here. Class width can be adjusted -->
          <h1>
            Test your email settings.
          </h1><br>
          It's a good idea to test to make sure you can actually receive system emails before forcing your users to verify theirs. <br><br>
          <form class="" name="test_email" action="email_test.php" method="post">
            <label>Send test to (Ideally different than your from address):
              <input required size='50' class='form-control' type='text' name='test_acct' value='' /></label>

              <label>&nbsp;</label>
              <input class='btn btn-primary' type='submit' value='Send A Test Email' class='submit' />
          </form>

          <!-- End of main content section
        </div>


        <div class="class col-sm-1"></div>
      </div>
    </div>

    <!-- /.row -->

    <!-- footers -->
    <?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>
