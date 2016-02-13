<?php
/*
UserSpice 43
by Curtis Parham and Dan Hoover at http://UserSpice.com
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
    <div class="class col-sm-3"></div>
    <div class="class col-sm-6">
<?php include 'views/join/_join_form.php'; ?>



<!-- footers -->
<?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<script>
//Nothing is actually being sent to stripe at this time.
  function validateJoin(){
    var data = jQuery('form[id="payment-form"]').serialize();
    jQuery.ajax({
      url : 'parsers/join_form_validate.php',
      type : 'POST',
      data : data,
      success : function(data){
        if(data == 'success'){
          // jQuery('#payment-errors').html("");
          // jQuery('#step1').css("display","none");
          // jQuery('#step2').css("display","block");
          // jQuery('#next_button').css("display","none");
          // jQuery('#back_button').css("display","inline-block");
          // jQuery('#pay_submit').css("display","inline-block");
        }else{
          jQuery('#payment-errors').html(data);
        }
      },
      error : function(){alert("Something has gone wrong with the Join Form")},
    });
  }

  Stripe.setPublishableKey('<?=STRIPE_PUBLIC;?>');

  function stripeResponseHandler(status, response) {
    var $form = $('#payment-form');

    if (response.error) {
      // Show the errors on the form
      $form.find('.payment-errors').text(response.error.message);
      $form.find('button').prop('disabled', false);
    } else {
      // response contains id and card, which contains additional card details
      var token = response.id;
      // Insert the token into the form so it gets submitted to the server
      $form.append($('<input type="hidden" name="stripeToken" />').val(token));
      // and submit
      $form.get(0).submit();
    }
  };

  jQuery(function($) {
  $('#payment-form').submit(function(event) {
    var $form = $(this);

    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);

    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});



</script>
<?php 	if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
<?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>
