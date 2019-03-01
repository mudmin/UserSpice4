<?php //UserSpice Notifications Functions

if(!function_exists('adminNotifications')) {
function adminNotifications($type,$threads,$user_id) {
	$db = DB::getInstance();
	$i = 0;
		foreach($threads as $id){
			if($type=="read") {
				$db->query("UPDATE notifications SET is_read = 1 WHERE id = $id");
				logger($user_id,"Notifications - Admin","Marked Notification ID #$id read.");
			}
			if($type=="unread") {
				$db->query("UPDATE notifications SET is_read = 0,is_archived=0 WHERE id = $id");
				logger($user_id,"Notifications - Admin","Marked Notification ID #$id unread.");
			}
			if($type=="delete") {
				$db->query("UPDATE notifications SET is_archived = 1 WHERE id = $id");
				logger($user_id,"Notifications - Admin","Deleted Notification ID #$id.");
			}
			$i++;
		}
	return $i;
	}
}
