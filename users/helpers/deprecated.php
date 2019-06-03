<?php //these are old UserCake and UserSpice functions that are not used  in our system by default
//However, if you found some use for them and your code stopped working, please copy the function(s)
//that you are missing into usersc/custom_functions.php and you'll be back to normal.


//Retrive a list of all .php files in users/ folder
if(!function_exists('getUSPageFiles')) {
	function getUSPageFiles() {
		$directory = "../users/";
		$pages = glob($directory . "*.php");
		foreach ($pages as $page){
			$fixed = str_replace('../users/','/'.$us_url_root.'users/',$page);
			$row[$fixed] = $fixed;
		}
		return $row;
	}
}

//Retrieve a list of all .php files in root files folder
if(!function_exists('getPageFiles')) {
	function getPageFiles() {
		$directory = "../";
		$pages = glob($directory . "*.php");
		foreach ($pages as $page){
			$fixed = str_replace('../','/'.$us_url_root,$page);
			$row[$fixed] = $fixed;
		}
		return $row;
	}
}


//Check if a permission level name exists in the DB
if(!function_exists('permissionNameExists')) {
	function permissionNameExists($permission) {
		$db = DB::getInstance();
		$query = $db->query("SELECT id FROM permissions WHERE
			name = ?",array($permission));
		$results = $query->results();
		if($results) return true;
		else return false;
	}
}

if(!function_exists('stripPagePermissions')) {
	function stripPagePermissions($id) {
		$db = DB::getInstance();
		$result = $db->query("DELETE from permission_page_matches WHERE page_id = ?",array($id));
		return $result;
	}
}

if(!function_exists('userHasPermission')) {
function userHasPermission($userID,$permissionID) {
    $permissionsAr = fetchUserPermissions($userID);
    //if($permissions[0])
    foreach($permissionsAr as $perm)
    {
        if($perm->permission_id == $permissionID)
        {
            return TRUE;
        }
    }
    return FALSE;
}
}

//Checks if a username exists in the DB
if(!function_exists('usernameExists')) {
	function usernameExists($username)   {
		$db = DB::getInstance();
		$query = $db->query("SELECT * FROM users WHERE username = ?",array($username));
		$results = $query->results();
		return ($results);
	}
}

if(!function_exists('emailExists')) {
	//Check if an email exists in the DB
	function emailExists($email) {
		$db = DB::getInstance();
		$query = $db->query("SELECT email FROM users WHERE email = ?",array($email));
		$num_returns = $query->count();
		if ($num_returns > 0){
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('updateEmail')) {
	//Update a user's email
	function updateEmail($id, $email) {
		$db = DB::getInstance();
		$fields=array('email'=>$email);
		$db->update('users',$id,$fields);

		return true;
	}
}

if(!function_exists('echoId')) {
	function echoId($id,$table,$column){
		$db = DB::getInstance();
		$query = $db->query("SELECT $column FROM $table WHERE id = $id LIMIT 1");
		$count=$query->count();

		if ($count > 0) {
			$results=$query->first();
			foreach ($results as $result){
				echo $result;
			}
		} else {
			echo "Not in database";
			Return false;
		}
	}
}
