<?php
//UserSpice Messaging System Functions
if(!function_exists('fetchMessageUsers')) {
	function fetchMessageUsers() {
		$db = DB::getInstance();
		$settingsQ = $db->query("SELECT msg_blocked_users FROM settings");
		$settings = $settingsQ->first();
		if($settings->msg_blocked_users==0) $queryUser = $db->query("SELECT * FROM users WHERE msg_exempt = 0 AND permissions = 1");
		if($settings->msg_blocked_users==1) $queryUser = $db->query("SELECT * FROM users WHERE msg_exempt = 0");
		$resultsUser = $queryUser->results();
		return ($resultsUser);
	}
}

if(!function_exists('archiveThreads')) {
	function archiveThreads($threads,$user_id,$status) {
		$db = DB::getInstance();
		$i = 0;
		foreach($threads as $id){
			$query = $db->query("SELECT msg_from,msg_to FROM message_threads WHERE id = ?",array($id));
			$results = $query->first();
			if($results->msg_from == $user_id) {
				$db->query("UPDATE message_threads SET archive_from = ? WHERE id = ?",array($status,$id));
				if($status == 1) $db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_to = ?",array(1,$id,$user_id));
			}
			if($results->msg_to == $user_id) {
				$db->query("UPDATE message_threads SET archive_to = ? WHERE id = ?",array($status,$id));
				if($status == 1) $db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_to = ?",array(1,$id,$user_id));
			}
			$i++;
			logger($user_id,"Messaging","Archived Thread $id.");
		}
		return $i;
	}
}

if(!function_exists('deleteMessages')) {
	function deleteMessages($threads,$status,$user_id) {
		$db = DB::getInstance();
		$i = 0;
		foreach($threads as $id){
				$db->query("UPDATE messages SET deleted = ?,msg_read = 1 WHERE id = ?",array($status,$id));
			$i++;
			logger($user_id,"Messaging - Admin","Deleted Message ID $id.");
		}
		return $i;
	}
}

if(!function_exists('deleteThread')) {
	function deleteThread($threads,$user_id,$status) {
		$db = DB::getInstance();
		$i = 0;
		foreach($threads as $id){
			$query = $db->query("SELECT msg_from,msg_to FROM message_threads WHERE id = ?",array($id));
			$results = $query->first();
			if($results->msg_from == $user_id) {
				$db->query("UPDATE message_threads SET hidden_from = ? WHERE id = ?",array($status,$id));
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_to = ?",array(1,$id,$user_id));
			}
			if($results->msg_to == $user_id) {
				$db->query("UPDATE message_threads SET hidden_to = ? WHERE id = ?",array($status,$id));
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_from = ?",array(1,$id,$user_id));
			}
			$i++;
			logger($user_id,"Messaging","Deleted Thread $id.");
		}
		return $i;
	}
}

if(!function_exists('adminArchiveThread')) {
	function adminArchiveThread($threads,$type,$user_id) {
		$db = DB::getInstance();
		$i = 0;
		foreach($threads as $id){
			if($type=="both") {
				$db->query("UPDATE message_threads SET archive_from = ?,archive_to = ? WHERE id = ?",array(1,1,$id));
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ?",array(1,$id));
				logger($user_id,"Messaging - Admin","Archived both for $id.");
			}
			if($type=="msg_to") {
				$db->query("UPDATE message_threads SET archive_to = ? WHERE id = ?",array(1,$id));
				$user = $db->query("SELECT msg_to FROM message_threads WHERE id = ?",array($id))->first()->msg_to;
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_to = ?",array(1,$id,$user));
				logger($user_id,"Messaging - Admin","Archived to for $id.");
			}
			if($type=="msg_from") {
				$db->query("UPDATE message_threads SET archive_from = ? WHERE id = ?",array(1,$id));
				$user = $db->query("SELECT msg_from FROM message_threads WHERE id = ?",array($id))->first()->msg_from;
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_from = ?",array(1,$id,$user));
				logger($user_id,"Messaging - Admin","Archived from for $id.");
			}
			$i++;
		}
		return $i;
	}
}

if(!function_exists('adminUnarchiveThread')) {
	function adminUnarchiveThread($threads,$type,$user_id) {
		$db = DB::getInstance();
		$i = 0;
		foreach($threads as $id){
			if($type=="both") {
				$db->query("UPDATE message_threads SET archive_from = ?,archive_to = ?,hidden_from = ?,hidden_to = ? WHERE id = ?",array(0,0,0,0,$id));
				logger($user_id,"Messaging - Admin","Unarchived and Undeleted both for $id.");
			}
			if($type=="msg_to") {
				$db->query("UPDATE message_threads SET archive_to = ?,hidden_to = ? WHERE id = ?",array(0,0,$id));
				logger($user_id,"Messaging - Admin","Unarchived and Undeleted to for $id.");
			}
			if($type=="msg_from") {
				$db->query("UPDATE message_threads SET archive_from = ?,hidden_from = ? WHERE id = ?",array(0,0,$id));
				logger($user_id,"Messaging - Admin","Unarchived and Undeleted from for $id.");
			}
			$i++;
		}
		return $i;
	}
}

if(!function_exists('adminDeleteThread')) {
	function adminDeleteThread($threads,$type,$user_id) {
		$db = DB::getInstance();
		$i = 0;
		foreach($threads as $id){
			if($type=="both") {
				$db->query("UPDATE message_threads SET hidden_from = ?,hidden_to = ?,archive_to = ?,archive_from = ? WHERE id = ?",array(1,1,1,1,$id));
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ?",array(1,$id));
				logger($user_id,"Messaging - Admin","Deleted both for $id.");
			}
			if($type=="msg_to") {
				$db->query("UPDATE message_threads SET hidden_to = ?,archive_from = ? WHERE id = ?",array(1,1,$id));
				$user = $db->query("SELECT msg_to FROM message_threads WHERE id = ?",array($id))->first()->msg_to;
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_to = ?",array(1,$id,$user));
				logger($user_id,"Messaging - Admin","Deleted to for $id.");
			}
			if($type=="msg_from") {
				$db->query("UPDATE message_threads SET hidden_from = ?,archive_from = ? WHERE id = ?",array(1,1,$id));
				$user = $db->query("SELECT msg_from FROM message_threads WHERE id = ?",array($id))->first()->msg_from;
				$db->query("UPDATE messages SET msg_read = ? WHERE msg_thread = ? AND msg_from = ?",array(1,$id,$user));
				logger($user_id,"Messaging - Admin","Deleted from for $id.");
			}
			$i++;
		}
		return $i;
	}
}

if(!function_exists('messageUser')) {
	function messageUser($user_id,$request_user,$subject,$body) {
		$db = DB::getInstance();
		$settingsQ = $db->QUERY("SELECT * FROM settings");
		$settings = $settingsQ->first();
		$userData = $db->query("SELECT fname FROM users WHERE id = ?",array($user_id))->first();
		$date = date("Y-m-d H:i:s");

		$thread = array(
			'msg_from'    => $user_id,
			'msg_to'      => $request_user,
			'msg_subject' => $subject,
			'last_update' => $date,
			'last_update_by' => $user_id,
			'hidden_from' => $settings->msg_default_to,
		);
		$db->insert('message_threads',$thread);
		$newThread = $db->lastId();


		$fields = array(
			'msg_from'    => $user_id,
			'msg_to'      => $request_user,
			'msg_body'    => $body,
			'msg_thread'  => $newThread,
			'sent_on'     => $date,
		);

		$db->insert('messages',$fields);
		$email = $db->query("SELECT fname,email,msg_notification FROM users WHERE id = ?",array($request_user))->first();
		if($settings->msg_notification == 1 && $email->msg_notification == 1) {
			$to = rawurlencode($email->email);
			$params = array(
				'fname' => $email->fname,
				'sendfname' => $userData->fname,
				'body' => $body,
				'msg_thread' => $newThread,
			);
			$to = rawurlencode($email->email);
			$emailbody = email_body('_email_msg_template.php',$params);
			email($to,$subject,$emailbody);
		}
		logger($user_id,"Messaging","Sent a message to $email->fname.");
	}
}
