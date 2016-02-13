<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Hello <?=$fname;?>,</p>
    <p>You are receiving this email because a request was made to reset your password. If this was not you, you may disgard this email.</p>
    <p>If this was you, click the link below to continue with the password reset process.</p>
    <p><a href="http://45.55.151.241/forgot_password.php?email=<?=$email;?>&vericode=<?=$vericode;?>&reset=1">Reset Password</a></p>
    <p>Sincerely,</p>
    <p>-The Mutiny Team-</p>
  </body>
</html>
