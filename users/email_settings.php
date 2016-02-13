<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("includes/us_header.php"); ?>

<?php require_once("includes/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php

//PHP Goes Here!
$query = $db->query("SELECT * FROM email");
$results = $query->first();

if(!empty($_POST)){
  $token = $_POST['csrf'];
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}

    if($results->smtp_server != $_POST['smtp_server']) {
      $smtp_server = Input::get('smtp_server');
      $fields=array('smtp_server'=>$smtp_server);
      $db->update('email',1,$fields);

    }
    else{
        }
    if($results->website_name != $_POST['website_name']) {
      $website_name = Input::get('website_name');
      $fields=array('website_name'=>$website_name);
      $db->update('email',1,$fields);

    }
    else{
        }
    if($results->smtp_port != $_POST['smtp_port']) {
      $smtp_port = Input::get('smtp_port');
      $fields=array('smtp_port'=>$smtp_port);
      $db->update('email',1,$fields);

    }else{
        }
        if($results->email_login != $_POST['email_login']) {
          $email_login = Input::get('email_login');
          $fields=array('email_login'=>$email_login);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->email_pass != $_POST['email_pass']) {
          $email_pass = Input::get('email_pass');
          $fields=array('email_pass'=>$email_pass);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->from_name != $_POST['from_name']) {
          $from_name = Input::get('from_name');
          $fields=array('from_name'=>$from_name);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->from_email != $_POST['from_email']) {
          $from_email = Input::get('from_email');
          $fields=array('from_email'=>$from_email);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->transport != $_POST['transport']) {
          $transport = Input::get('transport');
          $fields=array('transport'=>$transport);
          $db->update('email',1,$fields);

        }else{
            }
        if($results->verify_url != $_POST['verify_url']) {
          $verify_url = Input::get('verify_url');
          $fields=array('verify_url'=>$verify_url);
          $db->update('email',1,$fields);

        }else{
          }
          if($results->email_act != $_POST['email_act']) {
          $email_act = Input::get('email_act');
          $fields=array('email_act'=>$email_act);
          $db->update('email',1,$fields);

        }else{
            }
            Redirect::to("email_settings.php");

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
        <div class="class col-sm-3" align="center">
          <!-- Content Goes Here. Class width can be adjusted -->

<?php include("views/userspice/_email_settings.php") ?>

    <!-- /.row -->

    <!-- footers -->
    <?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>
