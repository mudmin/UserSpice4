<?php
$responseAr = array();

require_once('../init.php');

$google2fa = new PragmaRX\Google2FA\Google2FA;

$action = "";
$responseAr['success'] = true;

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    $responseAr['error'] = false;
    $db = DB::getInstance();
}else{
    returnError('No API action specified.');
}

if(isset($user) && $user->isLoggedIn()){
    $currentUser = $user->data();
    $loggedIn = true;
}else{
    $loggedIn = false;
}

if($loggedIn===true) {
  switch($action){
      case "pingEndpoint":
          $responseAr['testResponse'] = 'testData';
          break;
      case "verify2FA":
          $requestAr = requestCheck(['twoCode']);
          $twoQ = $db->query("select twoKey, twoEnabled from users where id = ?", [$currentUser->id]);
          if($twoQ->count() > 0){
              $twoO = $twoQ->results()[0];
              $twoVal = $google2fa->verifyKey($twoO->twoKey, $requestAr['twoCode']);
              if($twoVal){
                  $responseAr['2FAValidated'] = true;
                  if($twoO->twoEnabled == 0){
                      $db->query("update users set twoEnabled = 1,twoDate=NOW() where id = ?", [$currentUser->id]);
                      logger($currentUser->id,"Two FA","Enabled Two FA");
                  }
              }else{
                  returnError('Incorrect 2FA code.');
              }
          }else{
              returnError('Invalid user or not logged in.');
          }
          break;
      case "checkSessionStatus":
        if(!storeUser(TRUE)) {
          logger($currentUser->id,"User Tracker","Logged User out due to expired session");
          returnError('Logout');
        }
      break;
      default:
          returnError('Invalid API action specified.');
          break;
  }
}
else returnError('User Not Logged In');

echo json_encode($responseAr);
