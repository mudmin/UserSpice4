<?php require_once '../users/init.php'; ?>
<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php  //You can use this file to add a "System Settings" button to the user administration page and add any settings you want in there. Run our HTML from here and put your PHP/Post in the _POST file. ?>
<?php //If you edit directly from this file don't forget  to rename it to remove the "example_" so it will be detected. ?>

<?php /*Your HTML here! No need to make a form, just make your inputs, for example:
   <label>Exempt Messages?</label>
   <input type="checkbox" name="msg_exempt" value="1" <?php if($userdetails->msg_exempt==1){?>checked<?php } ?>/> <br /> */?>

   <label>What Is My Name?</label>
   <input type="text" name="whatismyname" class="form-control" value="<?=$userdetails->whatismyname?>" /> <br />
