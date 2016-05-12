<?php
$abs_us_root=$_SERVER['DOCUMENT_ROOT'];

$self_path=explode("/", $_SERVER['PHP_SELF']);
$self_path_length=count($self_path);
$file_found=FALSE;

for($i = 1; $i < $self_path_length; $i++){
	array_splice($self_path, $self_path_length-$i, $i);
	$us_url_root=implode("/",$self_path)."/";
	
	if (file_exists($abs_us_root.$us_url_root.'z_us_root.php')){
		$file_found=TRUE;
		break;
	}else{
		$file_found=FALSE;
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Hello <?=$fname;?>,</p>
    <p>You are receiving this email because a request was made to reset your password. If this was not you, you may disgard this email.</p>
    <p>If this was you, click the link below to continue with the password reset process.</p>
    <p><a href="<?=$_SERVER['HTTP_HOST'].$us_url_root?>users/forgot_password_reset.php?email=<?=$email;?>&vericode=<?=$vericode;?>&reset=1">Reset Password</a></p>
    <p>Sincerely,</p>
    <p>-The Team-</p>
  </body>
</html>
