<?php
function usersOnline () {
  $timestamp = time();
  $ip = ipCheck();
}

function ipCheck() {
  if (getenv('HTTP_CLIENT_IP')) {
    $ip = getenv('HTTP_CLIENT_IP');
  }
  elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
  }
  elseif (getenv('HTTP_X_FORWARDED')) {
    $ip = getenv('HTTP_X_FORWARDED');
  }
  elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ip = getenv('HTTP_FORWARDED_FOR');
  }
  elseif (getenv('HTTP_FORWARDED')) {
    $ip = getenv('HTTP_FORWARDED');
  }
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function new_user_online() {
  $db = DB::getInstance();
  $ip = ipCheck();
  $timestamp = time();
  $checkFirst = $db->query("SELECT * FROM users_online WHERE ip = ?",array($ip));
  $count = $checkFirst->count();

  if($count == 0){
  $fields =array('timestamp'=>$timestamp, 'ip'=>$ip);
  $db->insert('users_online',$fields);
}else{
  $fields =array('timestamp'=>$timestamp);
  $checkQ = $db->query("SELECT id FROM users_online WHERE ip = ?",array($ip));
  $to_update = $checkQ->first();
  $db->update('users_online',$to_update->id,$fields);
}
}

function delete_user_online() {
  $db = DB::getInstance();
  $timeout = 1800; //30 minutes - This can be changed
  $timestamp = time();
  $delete = $db->query("DELETE FROM useronline WHERE timestamp < ($timestamp - $timeout)");
}

function count_users() {
    $db = DB::getInstance();
    $selectAll = $db->query("SELECT DISTINCT ip FROM useronline");
    $count = $selectAll->count();
    return $count;
}
