<?php //UserSpice Software-as-a-Service (SAAS) functions

if(!function_exists('getSaasLevel')) {
	function saasLevelDetails($org) {
    $db = DB::getInstance();
    $row  = $db->query("SELECT level FROM us_saas_orgs WHERE id = ?",array($org))->first();
    $level = $db->query("SELECT * FROM us_saas_levels WHERE id = ?",array($row->level))->first();
    return $level;
  }
}

if(!function_exists('saasUserCount')) {
	function saasUserCount($org) {
    $db = DB::getInstance();
    $count = $db->query("SELECT * FROM users WHERE org = ?",array($org))->count();
    return $count;
  }
}

if(!function_exists('saasFull')) {
	function saasFull($org) {
    $level = saasLevelDetails($org);
    $count = saasUserCount($org);
    if($count >= $level->users){
      return true;
    }else{
      return false;
    }
  }
}

if(!function_exists('isOrgUser')) {
	function isOrgUser($user,$admin) {
    $db = DB::getInstance();
    $usercheck = $db->query("SELECT org FROM users WHERE id = ?",array($user))->first();
    $admincheck = $db->query("SELECT org FROM users WHERE id = ?",array($admin))->first();
    if($usercheck->org == 0 || $admincheck->org == 0){
      return false;
      die();
    }

    if($usercheck->org == $admincheck->org){
      return true;
    }else{
      return false;
    }
  }
}
