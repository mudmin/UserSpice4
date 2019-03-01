<?php
require_once '../init.php';
$db = DB::getInstance();
if(hasPerm([2],$user->data()->id)){
$formName = Input::get('formname');
$id = Input::get('row');
$requested = $_POST['validation'];
if(!isValidValidation($requested)){
  //Check to make sure unsanitized validation option is legit
  die("This is not a valid validation type. Something is fishy");
}
$valID = Input::get('valID');
// dnd($_POST);
// dump($_POST);
//check for a valid form
$formQ = $db->query("SELECT * FROM $formName WHERE id = ?",array($id));
$formC = $formQ->count();
if($formC < 1){
  $response = ['success'=>false];
  die("Form not found");
}else{
  $form = $formQ->first();
  $reqQ = $db->query("SELECT * FROM us_form_validation WHERE id = ?",array($valID));
  $reqC = $reqQ->count();
  if($reqC < 1){
    $response = ['success'=>false];
    die("Validation type not found");
  }else{
    $req = $reqQ->first();
  if($req->params == 'number'){
    $value = Input::get("numberInput");
    if(!is_numeric($value)){
      $response = ['success'=>false];
      die("Input was not numeric");
    }
  }elseif($req->params == 'text'){
    $value = Input::get("textInput");
    if($value == ""){
      $response = ['success'=>false];
      die("Value cannot be blank");
    }
  }elseif($req->params == 'true'){
    $value = Input::get("trueInput");
    if($value == ""){
      $response = ['success'=>false];
      die("Value cannot be blank");
    }
  }else{
    $response = ['success'=>false];
    die("Something is fishy");
  }
}

$existing = json_decode($form->validation,true);
$existing[$requested] = $value;
$existing = json_encode($existing);
$db->update($formName,$id,['validation'=>$existing]);

$response = ['success'=>true,'option'=>$requested,'value'=>$value];
echo json_encode($response);
die;
}
} //end of admin check
