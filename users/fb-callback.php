<?php
require_once '../users/init.php';

$db=DB::getInstance();

$settingsQ=$db->query("SELECT * FROM settings");
$settings=$settingsQ->first();

if(!isset($_SESSION)){session_start();}

$appID=$settings->fbid;
$secret=$settings->fbsecret;
$version=$settings->graph_ver;
$whereNext=$settings->finalredir;

require_once($abs_us_root.$us_url_root."users/src/Facebook/autoload.php");
$fb = new Facebook\Facebook([
  'app_id' => $appID, // Replace {app-id} with your app id
  'app_secret' => $secret,
  'default_graph_version' => $version,
  ]);

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];

try {
  $accessToken = $helper->getAccessToken(NULL,$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$us_url_root.'users/fb-callback.php');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($appID); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,first_name,last_name,email', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$fbuser = $response->getGraphUser();

//In case you want to test what you get back from FriendFace
// var_dump($user);
// echo 'Name: ' . $fbuser['name'];
// echo '<br>email: ' . $fbuser['email'];
// echo '<br>id: ' . $fbuser['id'];

//Facebook Authenticated - Let's do something with that info

//Check to see if the user has an account
$fbEmail = $fbuser['email'];


$checkExistingQ = $db->query("SELECT * FROM users WHERE email = ?",array ($fbEmail));

$CEQCount = $checkExistingQ->count();

//Existing UserSpice User Found
if ($CEQCount>0){
$checkExisting = $checkExistingQ->first();
$newLoginCount = $checkExisting->logins+1;
$newLastLogin = date("Y-m-d H:i:s");

$fields=array('fb_uid'=>$fbuser['id'], 'logins'=>$newLoginCount, 'last_login'=>$newLastLogin);

$db->update('users',$checkExisting->id,$fields);
$_SESSION["user"] = $checkExisting->id;

$twoQ = $db->query("select twoKey from users where id = ? and twoEnabled = 1",[$checkExisting->id]);
if($twoQ->count()>0) {
  $_SESSION['twofa']=1;
    $page=encodeURIComponent(Input::get('redirect'));
    logger($user->data()->id,"Two FA","Two FA being requested.");
    Redirect::To($us_url_root.'users/twofa.php');
  }
  $ip = ipCheck();
  $q = $db->query("SELECT id FROM us_ip_list WHERE ip = ?",array($ip));
  $c = $q->count();
  if($c < 1){
    $db->insert('us_ip_list', array(
      'user_id' => $feusr->id,
      'ip' => $ip,
    ));
  }else{
    $f = $q->first();
    $db->update('us_ip_list',$f->id, array(
      'user_id' => $feusr->id,
      'ip' => $ip,
    ));
  }
Redirect::to($us_url_root.'users/account.php');
}else{
  if($settings->registration==0) {
    session_destroy();
    Redirect::to($us_url_root.'users/join.php');
    die();
  } else {
    // //No Existing UserSpice User Found
    // if ($CEQCount<0){
    //$fbpassword = password_hash(Token::generate(),PASSWORD_BCRYPT,array('cost' => 12));
    $date = date("Y-m-d H:i:s");
    $fb_fname = $fbuser['first_name'];
    $fb_lname = $fbuser['last_name'];
    $fbname=$fb_fname.' '.$fb_lname;
    if($settings->auto_assign_un==1) {
      $username=username_helper($fb_fname,$fb_lname,$fbEmail);
      if(!$username) $username=NULL;
    } else {
      $username=$fbEmail;
    }
    $fields=array('email'=>$fbEmail,'username'=>$username,'fname'=>$fb_fname,'lname'=>$fb_lname,'permissions'=>1,'logins'=>1,'company'=>'none','join_date'=>$date,'last_login'=>$date,'email_verified'=>1,'password'=>NULL,'fb_uid'=>$fbuser['id']);

    $db->insert('users',$fields);
    $lastID = $db->lastId();

    $insert2 = $db->query("INSERT INTO user_permission_matches SET user_id = $lastID, permission_id = 1");

    $theNewId=$lastID;
    include($abs_us_root.$us_url_root.'usersc/scripts/during_user_creation.php');

    $_SESSION["user"] = $lastID;
    Redirect::to($whereNext);
  }
}


?>
