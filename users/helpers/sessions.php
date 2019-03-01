<?php //UserSpice Session Functions

if(!function_exists('UserSessionCount')) {
	function UserSessionCount() {
		global $user;
		$db=DB::getInstance();
		$q=$db->query("SELECT * FROM us_user_sessions WHERE fkUserID = ? AND UserSessionEnded=0",[$user->data()->id]);
		return $q->count();
	}
}

if(!function_exists('fetchUserSessions')) {
	function fetchUserSessions($all=false) {
		global $user;
		$db = DB::getInstance();
		if(!$all) $q = $db->query("SELECT * FROM us_user_sessions WHERE fkUserID = ? AND UserSessionEnded=0 ORDER BY UserSessionStarted",[$user->data()->id]);
		else $q = $db->query("SELECT * FROM us_user_sessions WHERE fkUserID = ? ORDER BY UserSessionStarted",[$user->data()->id]);
		if($q->count()>0) return $q->results();
		else return false;
	}
}

if(!function_exists('fetchAdminSessions')) {
	function fetchAdminSessions($all=false) {
		global $user;
		$db = DB::getInstance();
		if(!$all) $q = $db->query("SELECT * FROM us_user_sessions WHERE UserSessionEnded=0 ORDER BY UserSessionStarted");
		else $q = $db->query("SELECT * FROM us_user_sessions ORDER BY UserSessionStarted");
		if($q->count()>0) return $q->results();
		else return false;
	}
}

if(!function_exists('killSessions')) {
	function killSessions($sessions,$admin=false) {
		global $user;
		$db = DB::getInstance();
		$i=0;
		foreach($sessions as $session) {
			if(!$admin) $db->query("UPDATE us_user_sessions SET UserSessionEnded=1,UserSessionEnded_Time=NOW() WHERE kUserSessionID = ? AND fkUserId = ?",[$session,$user->data()->id]);
			else $db->query("UPDATE us_user_sessions SET UserSessionEnded=1,UserSessionEnded_Time=NOW() WHERE kUserSessionID = ?",[$session]);
			if(!$db->error()) {
				$i++;
				logger($user->data()->id,"User Tracker","Killed Session ID#$session");
			} else {
				$error=$db->errorString();
				logger($user->data()->id,"User Tracker","Error killing Session ID#$session: $error");
			}
		}
		if($i>0) return $i;
		else return false;
	}
}

if(!function_exists('passwordResetKillSessions')) {
	function passwordResetKillSessions($uid=NULL) {
		global $user;
		$db = DB::getInstance();
		if(is_null($uid)) $q = $db->query("UPDATE us_user_sessions SET UserSessionEnded=1,UserSessionEnded_Time=NOW() WHERE fkUserID = ? AND UserSessionEnded=0 AND kUserSessionID <> ?",[$user->data()->id,$_SESSION['kUserSessionID']]);
		else $q = $db->query("UPDATE us_user_sessions SET UserSessionEnded=1,UserSessionEnded_Time=NOW() WHERE fkUserID = ? AND UserSessionEnded=0",[$uid]);
		if(!$db->error()) {
			$count=$db->count();
			if(is_null($uid)) {
				if($count==1) logger($user->data()->id,"User Tracker","Killed 1 Session via Password Reset.");
				if($count >1) logger($user->data()->id,"User Tracker","Killed $count Sessions via Password Reset.");
			} else {
				if($count==1) logger($user->data()->id,"User Tracker","Killed 1 Session via Password Reset for UID $uid.");
				if($count >1) logger($user->data()->id,"User Tracker","Killed $count Sessions via Password Reset for UID $uid.");
			}
			return $count;
		} else {
			$error=$db->errorString();
			if(is_null($uid)) {
					logger($user->data()->id,"User Tracker","Password Reset Session Kill failed, Error: ".$error);
			} else {
				logger($user->data()->id,"User Tracker","Password Reset Session Kill failed for UID $uid, Error: ".$error);
			}
			return $error;
		}
	}
}

if(!function_exists('storeUser')) {
	function storeUser($api=false) {
		global $user;
		global $us_url_root;
		if(!$user->isLoggedIn()) return false;
		$db=DB::getInstance();
		if(isset($_SESSION['kUserSessionID']) && isset($_SESSION['fingerprint']) && $_SESSION['fingerprint']!='') $q=$db->query("SELECT * FROM us_user_sessions WHERE kUserSessionID = ? AND fkUserID = ? AND UserFingerprint = ?",[$_SESSION['kUserSessionID'],$user->data()->id,$_SESSION['fingerprint']]);
		if(isset($q) && $q->count()==1) {
			$result=$q->first();
			if($result->UserSessionEnded==0) {
				if(!$api) {
					$db->update('us_user_sessions',['kUserSessionID' => $result->kUserSessionID],['UserSessionLastUsed' => date("Y-m-d H:i:s"),'UserSessionLastPage' => currentPageStrict()]);
					if($db->error()) {
						logger($user->data()->id,"User Tracker","Failed to re-track User Session, Error: ".$db->errorString());
						return false;
					} else return true;
				} else return true;
			} else {
				if($api) return false;
					$user->logout();
					Redirect::to($us_url_root.'users/?msg=Your session was ended remotely');
			}
		} else {
			if(isset($_SESSION['fingerprint']) && $_SESSION['fingerprint']!='') {
				$fields = [
					'fkUserID' => $user->data()->id,
					'UserFingerprint' => $_SESSION['fingerprint'],
					'UserSessionIP' => ipCheck(),
					'UserSessionOS' => getOS(),
					'UserSessionBrowser' => getBrowser(),
					'UserSessionStarted' => date("Y-m-d H:i:s"),
					'UserSessionLastUsed' => date("Y-m-d H:i:s"),
					'UserSessionLastPage' => currentPageStrict(),
					'UserSessionEnded' => 0,
					'UserSessionEnded_Time' => NULL,
				];
				$db->insert('us_user_sessions',$fields);
				if($db->error()) {
					logger($user->data()->id,"User Tracker","Failed to track User Session, Error: ".$db->errorString());
					return true;
				} else {
					$_SESSION['kUserSessionID']=$db->lastId();
					return true;
				}
			} else return true;
		}
	}
}
