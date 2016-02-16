<?php
/*
UserSpice 4
An Open Source PHP User Management System
by Curtis Parham and Dan Hoover at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
?>
<?php require_once("includes/userspice/us_header.php"); ?>

<?php require_once("includes/userspice/us_navigation.php"); ?>
<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
	if($settings->recaptcha == 1){
    require_once("includes/recaptcha.config.php"); }
//There is a lot of commented out code for a future release of sign ups with payments
  $form_method = 'POST';
  $form_action = 'joinThankYou.php';
  $csrf = Token::generate();
?>

<?php
//this is the standard, no cost register form
//If some of this code looks funny it's because it is prepared for
//an additional join form with stripe payment options.
?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
<div class="row">
  <div class="col-sm-12">
    <div class="col-sm-6 col-sm-offset-3">
<?php include 'views/join/_join_form.php'; ?>



<!-- footers -->
<?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<script>
  function validateJoin(){
		jQuery('#payment-errors').html("");
		jQuery('.has-error').removeClass("has-error");
    var data = jQuery('form[id="payment-form"]').serialize();
    jQuery.ajax({
      url : 'parsers/join_form_validate.php',
      type : 'POST',
      data : data,
      success : function(data){
        if(data == 'success'){
          jQuery('#payment-errors').html("");
          jQuery('#payment-form').submit();
        }else{
          jQuery('#payment-errors').html(data);
        }
      },
      error : function(){alert("Something has gone wrong with the Join Form")},
    });
  }

  jQuery(function($) {
  $('#payment-form').submit(function(event) {
    var $form = $(this);
    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);
  });
});



</script>
<?php 	if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
<?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>
